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
    	$this->dropTable('core_product_eav_attributes');
    	$table = $this->table('core_product_eav_attributes');
    	$table
	    	->addColumn('core_seller_id', 'integer', [
    			'default' => null,
    			'limit' => 11,
    			'null' => false,
	    	])
	    	->addColumn('code', 'string', [
    			'default' => null,
    			'limit' => 128,
    			'null' => false,
	    	])
	    	->addColumn('name', 'string', [
    			'default' => null,
    			'limit' => 256,
    			'null' => true,
	    	])
	    	->addColumn('data_type', 'string', [
    			'default' => null,
    			'limit' => 32,
    			'null' => false,
	    	])
	    	->addColumn('is_required', 'boolean', [
    			'default' => 0,
    			'limit' => null,
    			'null' => false,
	    	])
	    	->addColumn('multiple_values', 'boolean', [
    			'default' => 0,
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
	    	->addIndex(['core_seller_id', 'code', 'data_type', 'is_required', 'multiple_values'])
	    	->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
	    	->create();    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}