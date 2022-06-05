<?php

use Phinx\Migration\AbstractMigration;

class CoreProductEavAttributes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     */
    public function change() {
    	if($this->hasTable('core_product_eav_attributes')) {
    		$this->execute("ALTER TABLE `core_product_eav_attributes` DROP `core_product_eav_attribute_group_id`;");
    	}
    	
    	if(!$this->hasTable('core_product_eav_attribute_core_product_eav_attribute_groups')) {
    		
    	}
    	
    	
    }
}