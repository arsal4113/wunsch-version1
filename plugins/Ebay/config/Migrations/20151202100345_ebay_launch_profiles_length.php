<?php

use Phinx\Migration\AbstractMigration;

class EbayLaunchProfilesLength extends AbstractMigration
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
        $this->execute("ALTER TABLE `ebay_launch_profiles` CHANGE `max_quantity` `max_quantity` INT(10) NULL;");
        $this->execute("ALTER TABLE `ebay_launch_profiles` CHANGE `ebay_shipping_profile_name` `ebay_shipping_profile_name` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");
        $this->execute("ALTER TABLE `ebay_launch_profiles` CHANGE `ebay_return_profile_name` `ebay_return_profile_name` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");
        $this->execute("ALTER TABLE `ebay_launch_profiles` CHANGE `ebay_payment_profile_name` `ebay_payment_profile_name` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");
    }
}
