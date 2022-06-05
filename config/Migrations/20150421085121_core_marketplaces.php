<?php

use Phinx\Migration\AbstractMigration;

class CoreMarketplaces extends AbstractMigration
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
    	$this->dropTable('core_marketplaces');
    	$table = $this->table('core_marketplaces');
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
	    	->addColumn('is_active', 'boolean', [
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
	    	->addIndex(['code'])
	    	->addIndex(['is_active'])
	    	->create();
	    	
	   	$this->execute("
	   		INSERT INTO `core_marketplaces` (`id`, `code`, `name`, `is_active`, `created`, `modified`) VALUES
			(NULL, 'EBAY-DE', 'eBay Germany', 1, NOW(), NOW());
	   	");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}