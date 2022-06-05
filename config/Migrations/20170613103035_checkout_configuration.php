<?php

use Phinx\Migration\AbstractMigration;

class CheckoutConfiguration extends AbstractMigration
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
          INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_path`, `configuration_value`, `created`, `modified`) VALUES (NULL, NULL, 'EbayFashion', 'Checkout/active', '1', NOW(), NOW());        
        ");
    }
}
