<?php

use Phinx\Migration\AbstractMigration;

class RenameTables extends AbstractMigration
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
    	if($this->hasTable('core_product_categories')) {
    		$this->execute('RENAME TABLE `core_product_categories` TO `core_categories_core_products`');
    	}
    	
    	if($this->hasTable('core_product_types')) {
    		$this->execute('TRUNCATE TABLE `core_product_types`');
    		$this->execute("INSERT INTO `core_product_types` (`id`, `code`, `created`, `modified`) VALUES
    			(NULL, 'SIMPLE', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, 'CONFIGURABLE', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    		");
    	}
    	
    	if($this->hasTable('core_product_type_names')) {
    		$this->execute('TRUNCATE TABLE `core_product_type_names`');
    		$this->execute("INSERT INTO `core_product_type_names` (`id`, `core_product_type_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    			(NULL, '1', '1', 'Simple Product', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, '1', '2', 'Einfaches Produkt', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, '2', '1', 'Configurable Product', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, '2', '2', 'Konfigurierbares Produkt', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    		");
    	}
    	
    	if($this->hasTable('core_seller_marketplaces')) {
    		$this->execute('RENAME TABLE `core_seller_marketplaces` TO `core_marketplaces_core_sellers`;');
    		$this->execute('ALTER TABLE `core_marketplaces_core_sellers` CHANGE `core_marketplace_id` `core_marketplace_id` INT(10) NOT NULL AFTER `id`;');
    	}
    	
    	if(!$this->hasTable('core_users')) {
    		$table = $this->table('core_users')
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('core_user_role_id', 'integer', array('limit' => '10'))
    			->addColumn('email', 'string', array('limit' => '512'))
    			->addColumn('password', 'string', array('limit' => '512'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('core_user_role_id')
    			->create();
    	}
    	
    	if(!$this->hasTable('core_user_roles')) {
    		$table = $this->table('core_user_roles')
    			->addColumn('code', 'string', array('limit' => '64'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('code')
    			->create();
    		
    		$this->execute("INSERT INTO `core_user_roles` (`id`, `code`, `created`, `modified`) VALUES
				(NULL, 'ADMINISTRATORS', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 'USERS', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);"
    		);
    	}
    	
    	if(!$this->hasTable('core_user_role_names')) {
    		$table = $this->table('core_user_role_names')
    			->addColumn('core_user_role_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '128'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_user_role_id')
    			->addIndex('core_language_id')
    			->create();
    		
    		$this->execute("INSERT INTO `core_user_role_names` (`id`, `core_user_role_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
				(NULL, 1, 1, 'Administrators', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 1, 2, 'Administratoren', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 2, 1, 'Users', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 2, 2, 'Benutzer', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);"
    		);
    	}
    	
    	if($this->hasTable('ebay_account_sites')) {
    		$this->execute("RENAME TABLE `ebay_account_sites` TO `ebay_accounts_ebay_sites`;");
    	}
    	
    	if($this->hasTable('feed_import_accounts_to_types')) {
    		$this->execute("RENAME TABLE `feed_import_accounts_to_types` TO `feed_import_accounts_feed_import_types`;");
    	}
    	
    	if(!$this->hasTable('mip_updater_configurations')) {
    		$table = $this->table('mip_updater_configurations')
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_account_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_site_id', 'integer', array('limit' => '10'))
    			->addColumn('time_interval', 'integer', array('limit' => '10'))
    			->addColumn('last_start', 'datetime')
    			->addColumn('next_start', 'datetime')
    			->addColumn('last_execution_time', 'datetime')
    			->addColumn('active', 'datetime', 'integer', array('limit' => '1', 'default' => 0))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('ebay_account_id')
    			->addIndex('ebay_site_id')
    			->create();    
    		
    		$this->execute("INSERT INTO `mip_updater_configurations` (`id`, `core_seller_id`, `ebay_account_id`, `ebay_site_id`, `time_interval`, `last_start`, `next_start`, `last_execution_time`, `active`, `created`, `modified`) VALUES
				(NULL, 2, 2, 1, 10, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
			");
    	}
    }
    
}