<?php

use Phinx\Migration\AbstractMigration;

class CoreProducts extends AbstractMigration
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
    	$this->dropTable('core_products');
    	$table = $this->table('core_products');
    	$table
	    	->addColumn('core_seller_id', 'integer', [
	    		'default' => null,
	    		'limit' => 11,
	    		'null' => false,
	    	])
	    	->addColumn('core_product_type_id', 'integer', [
	    		'default' => null,
	    		'limit' => 11,
	    		'null' => false,
	    	])
	    	->addColumn('parent_id', 'integer', [
	    		'default' => null,
	    		'limit' => 11,
	   			'null' => true,
	    	])
	    	->addColumn('sku', 'string', [
	    		'default' => null,
	    		'limit' => 128,
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
    		->addIndex(['core_seller_id', 'core_product_type_id', 'parent_id', 'sku'])
    		->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
    		->addForeignKey('core_product_type_id', 'core_product_types', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
    		->addForeignKey('parent_id', 'core_products', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
    		->create();    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}