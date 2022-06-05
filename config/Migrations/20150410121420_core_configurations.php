<?php

use Phinx\Migration\AbstractMigration;

class CoreConfigurations extends AbstractMigration
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
    	$this->dropTable('core_configurations');
    	$table = $this->table('core_configurations');
    	$table
	    	->addColumn('core_seller_id', 'integer', [
	    		'default' => null,
	    		'limit' => 11,
	    		'null' => false,
	    	])
	    	->addColumn('configuration_group', 'string', [
	    			'default' => null,
	    			'limit' => 64,
	    			'null' => false,
	    	])
	    	->addColumn('configuration_path', 'string', [
	    			'default' => null,
	    			'limit' => 256,
	    			'null' => false,
	    	])
	    	->addColumn('configuration_value', 'string', [
	    			'default' => null,
	    			'limit' => 256,
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
	    	->addIndex(['core_seller_id', 'configuration_group', 'configuration_path'])
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