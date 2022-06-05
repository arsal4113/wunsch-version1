<?php

use Phinx\Migration\AbstractMigration;

class DashboardConfigurations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('dashboard_configurations')
            ->addColumn('core_seller_id', 'integer', ['limit' => 11, 'null' => false])
            ->addColumn('core_user_id', 'integer', ['limit' => 11, 'null' => true, 'default' => null])
            ->addColumn('cell_name', 'string', ['limit' => 256, 'null' => false])
            ->addColumn('cell_configuration', 'string', ['limit' => 512, 'null' => true])
            ->addColumn('sort_order', 'integer', ['limit' => 11, 'null' => true])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_seller_id'])
            ->addIndex(['core_user_id'])
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('core_user_id', 'core_users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
