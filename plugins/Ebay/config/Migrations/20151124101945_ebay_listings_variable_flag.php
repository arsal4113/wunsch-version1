<?php

use Phinx\Migration\AbstractMigration;

class EbayListingsVariableFlag extends AbstractMigration
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
        $table = $this->table('ebay_listings');
        $table->addColumn('has_variations', 'boolean', ['default' => 0, 'null' => false, 'after' => 'watch_count']);
        $table->addIndex(['has_variations']);
        $table->update();
    }
}
