<?php

use Phinx\Migration\AbstractMigration;

class CoreUsersCoreOrders extends AbstractMigration
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
        $this->table('core_orders')
            ->addColumn('core_user_id', 'integer', ['limit' => 11, 'null' => true, 'default' => null, 'after' => 'core_seller_id'])
            ->addIndex(['core_user_id'])
            ->addForeignKey('core_user_id', 'core_users', 'id', array('delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'))
            ->update();
    }
}
