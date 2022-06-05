<?php

use Phinx\Migration\AbstractMigration;

class CoreErrorsNullableForeignKey extends AbstractMigration
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
        $this->execute("ALTER TABLE `core_errors` CHANGE `core_seller_id` `core_seller_id` INT(10) NULL;");
        $this->execute("ALTER TABLE `core_errors` CHANGE `foreign_key` `foreign_key` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
        $this->execute("ALTER TABLE `core_errors` CHANGE `foreign_model` `foreign_model` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
    }
}
