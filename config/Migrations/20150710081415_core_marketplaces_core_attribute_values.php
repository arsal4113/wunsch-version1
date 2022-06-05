<?php

use Phinx\Migration\AbstractMigration;

class CoreMarketplacesCoreAttributeValues extends AbstractMigration
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
        
        $this->execute("DELETE FROM core_product_eav_attribute_groups_core_product_eav_attributes");
        $table = $this->table('core_product_eav_attribute_groups_core_product_eav_attributes');
        $table->addColumn('core_marketplace_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'id'])
            ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();
        
        $this->execute("DELETE FROM core_product_attribute_value_datetimes");
        $table = $this->table('core_product_attribute_value_datetimes');
        $table->addColumn('core_marketplace_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'core_product_eav_attribute_id'])
            ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();

        $this->execute("DELETE FROM core_product_attribute_value_decimals");
        $table = $this->table('core_product_attribute_value_decimals');
        $table->addColumn('core_marketplace_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'core_product_eav_attribute_id'])
            ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();

        $this->execute("DELETE FROM core_product_attribute_value_images");
        $table = $this->table('core_product_attribute_value_images');
        $table->addColumn('core_marketplace_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'core_product_eav_attribute_id'])
            ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();

        $this->execute("DELETE FROM core_product_attribute_value_ints");
        $table = $this->table('core_product_attribute_value_ints');
        $table->addColumn('core_marketplace_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'core_product_eav_attribute_id'])
            ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();

        $this->execute("DELETE FROM core_product_attribute_value_texts");
        $table = $this->table('core_product_attribute_value_texts');
        $table->addColumn('core_marketplace_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'core_product_eav_attribute_id'])
            ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();

        $this->execute("DELETE FROM core_product_attribute_value_varchars");
        $table = $this->table('core_product_attribute_value_varchars');
        $table->addColumn('core_marketplace_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'core_product_eav_attribute_id'])
            ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();   
    }
}
