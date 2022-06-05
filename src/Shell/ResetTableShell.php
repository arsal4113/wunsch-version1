<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Utility\Inflector;
use Cake\Datasource\ConnectionManager;

/**
 * RefillTable shell command.
 */
class ResetTableShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addArgument('target_table', [
            'help' => 'A valid source table.',
            'required' => true
        ])->addArgument('data_аgе', [
            'help' => 'A valid data age in days.',
            'required' => true
        ])->description('<info>' . __('Shell to reset auto increment ids of a table.') . '</info>');
        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $targetTableName = $this->args[0];
        $tmpTargetTableName = 'tmp_' . $targetTableName;
        $dataAge = $this->args[1];

        $targetTable = Inflector::camelize($targetTableName);
        $this->loadModel($targetTable);

        $connection = ConnectionManager::get('default');

        $columns = $this->$targetTable->schema()->columns();
        $columns = array_diff($columns, ['id']);
        $columns = implode(',', $columns);

        $connection->execute(sprintf('CREATE TABLE %s SELECT ' . $columns . ' FROM %s WHERE %s',
            $tmpTargetTableName,
            $targetTableName,
            $targetTableName . '.created >= "' . date('Y-m-d H:i:s', strtotime('-' . $dataAge . 'days')) . '";'
        ));

        $connection->execute('LOCK TABLES ' . $targetTableName . ' WRITE, ' . $tmpTargetTableName . ' WRITE');
        $connection->execute('TRUNCATE TABLE ' . $targetTableName);
        $connection->execute('INSERT INTO ' . $targetTableName . ' (' . $columns . ') SELECT ' . $columns . ' FROM ' . $tmpTargetTableName);
        $connection->execute('DROP TABLE ' . $tmpTargetTableName);
        $connection->execute('UNLOCK TABLES');
    }
}
