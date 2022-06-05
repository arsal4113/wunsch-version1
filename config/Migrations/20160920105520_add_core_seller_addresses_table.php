<?php

use Phinx\Migration\AbstractMigration;

class AddCoreSellerAddressesTable extends AbstractMigration
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
        $this->execute("
            CREATE TABLE `core_seller_addresses` (
              id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              core_seller_id VARCHAR(250) NOT NULL,
              first_name VARCHAR(100),
              last_name VARCHAR(100),
              street_name VARCHAR(250),
              street_number VARCHAR(10),
              city VARCHAR (100),
              zip_code INT,
              phone_number VARCHAR(100),
              company_name VARCHAR(100),
              created DATETIME DEFAULT NULL,
              modified DATETIME DEFAULT NULL
            );
        ");
    }
}
