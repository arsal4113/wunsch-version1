<?php

use Phinx\Migration\AbstractMigration;

class CoreProductTypes extends AbstractMigration
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
    	$this->dropTable('core_product_types');
    	$table = $this->table('core_product_types');
    	$table
    	->addColumn('code', 'string', [
    		'default' => null,
    		'limit' => 64,
    		'null' => false,
    	])
    	->addColumn('name', 'string', [
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
    	->addIndex(['code', 'name'])
    	->create();    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}