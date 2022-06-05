<?php

use Phinx\Migration\AbstractMigration;

class UpdateDashboardConfigurations extends AbstractMigration
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
        $this->execute("ALTER TABLE `dashboard_configurations` CHANGE `core_seller_id` `core_seller_id` INT(11) NULL;");
    
        $this->table('dashboard_configurations')
            ->addColumn('core_seller_type_id', 'integer', ['limit' => 11 ,'after' => 'id', 'null' => true])
            ->addIndex(['core_seller_type_id'])
            ->addForeignKey('core_seller_type_id', 'core_seller_types', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->update();
    }
}
