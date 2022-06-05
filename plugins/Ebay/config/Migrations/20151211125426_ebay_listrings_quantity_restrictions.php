<?php

use Phinx\Migration\AbstractMigration;

class EbayListringsQuantityRestrictions extends AbstractMigration
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
        $this->execute("ALTER TABLE `ebay_listings` CHANGE `quantity_restriction_per_buyer` `quantity_restriction_per_buyer` INT(10) NULL DEFAULT NULL;");
        $this->execute("ALTER TABLE `ebay_auto_lister_configurations` CHANGE `quantity_restriction_per_buyer` `quantity_restriction_per_buyer` INT(11) NULL DEFAULT NULL;");
    }
}
