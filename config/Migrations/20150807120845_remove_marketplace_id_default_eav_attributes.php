<?php

use Phinx\Migration\AbstractMigration;

class RemoveMarketplaceIdDefaultEavAttributes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table('core_product_default_eav_attributes');
        $table
            ->dropForeignKey('core_marketplace_id')
            ->removeIndexByName('core_marketplace_id')
            ->removeColumn('core_marketplace_id')
            ->update();
        
        $this->execute("ALTER TABLE `core_product_eav_attributes` CHANGE `core_seller_id` `core_seller_id` INT(11) NULL;");
    }
}
