<?php

use Phinx\Migration\AbstractMigration;

class CoreProductUpdates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $tableName = 'core_product_update_histories';
        if($this->hasTable($tableName)) {
            $this->dropTable($tableName);
        }
        
        $tableName = 'core_product_update_types';
        if($this->hasTable($tableName)) {
            $this->dropTable($tableName);
        }        
        
        $this->table('core_product_updates')
            ->addColumn('core_product_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('type', 'string', ['default' => null, 'limit' => 128, 'null' => true])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_product_id'])
            ->addForeignKey('core_product_id', 'core_products', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
