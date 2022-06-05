<?php

use Phinx\Migration\AbstractMigration;

class CoreProductAttributeValueDatetimes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    	$this->dropTable('core_product_attribute_value_datetimes');
    	$table = $this->table('core_product_attribute_value_datetimes');
    	$table
	    	->addColumn('core_product_id', 'integer', [
    			'default' => null,
    			'limit' => 11,
    			'null' => false,
	    	])
	    	->addColumn('core_product_eav_attribute_id', 'integer', [
    			'default' => null,
    			'limit' => 11,
    			'null' => false,
	    	])
	    	->addColumn('value', 'datetime', [
    			'default' => null,
    			'limit' => null,
    			'null' => false,
	    	])
	    	->addColumn('created', 'datetime', [
    			'default' => null,
    			'limit' => null,
    			'null' => false,
	    	])
	    	->addColumn('modified', 'datetime', [
    			'default' => null,
    			'limit' => null,
    			'null' => false,
	    	])
	    	->addIndex(['core_product_id', 'core_product_eav_attribute_id'])
	    	->addForeignKey('core_product_id', 'core_products', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
	    	->addForeignKey('core_product_eav_attribute_id', 'core_product_eav_attributes', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
	    	->create();    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}