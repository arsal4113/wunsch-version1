<?php

use Phinx\Migration\AbstractMigration;

class EbayAutoListerConditions extends AbstractMigration
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
        $table = $this->table('ebay_auto_lister_configurations');
        $table->addColumn('ebay_condition_id', 'integer', ['limit' => 11, 'default' => 1, 'null' => false, 'after' => 'ebay_auction_type_id']);
        $table->addIndex(['ebay_condition_id']);
        $table->addForeignKey('ebay_condition_id', 'ebay_conditions', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION']);
        $table->update();
    }
}
