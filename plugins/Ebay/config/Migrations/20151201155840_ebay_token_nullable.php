<?php

use Phinx\Migration\AbstractMigration;

class EbayTokenNullable extends AbstractMigration
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
        $this->execute("ALTER TABLE `ebay_accounts` CHANGE `token` `token` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
        $this->execute("ALTER TABLE `ebay_accounts` CHANGE `token_expiration_time` `token_expiration_time` DATETIME NULL;");
    }
}
