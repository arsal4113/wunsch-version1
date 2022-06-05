<?php

use Phinx\Migration\AbstractMigration;

class CoreProductEavAttributeSets extends AbstractMigration
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
    	if(!$this->hasTable('core_product_eav_attribute_sets')) {
    		$table = $this->table('core_product_eav_attribute_sets')
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('code', 'string', array('limit' => '80'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('code')
    			->create();
    	}
    	
    	if(!$this->hasTable('core_product_eav_attribute_set_names')) {
    		$table = $this->table('core_product_eav_attribute_set_names')
    			->addColumn('core_product_eav_attribute_set_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '120'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_eav_attribute_set_id')
    			->addIndex('core_language_id')
    			->create();
    	}
    }
}