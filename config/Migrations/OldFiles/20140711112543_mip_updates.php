<?php

use Phinx\Migration\AbstractMigration;

class MipUpdates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     */
    public function change() {
    	// CoreConfigurations
    	if($this->hasTable('core_configurations')) {
    		$this->execute("ALTER TABLE `core_configurations` CHANGE `configuration_value` `configuration_value` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
    		$this->execute("INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_key`, `configuration_value`, `created`, `modified`) VALUES
				(NULL, '2', 'Mip', 'mip_new_product_feed_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/product/new/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, '2', 'Mip', 'mip_new_inventory_feed_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/inventory/new/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, '2', 'Mip', 'mip_new_product_response_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/product/new/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, '2', 'Mip', 'mip_new_inventory_response_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/inventory/new/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, '2', 'Mip', 'mip_processed_product_response_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/product/processed/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, '2', 'Mip', 'mip_processed_inventory_response_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/inventory/processed/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
	    	");
    	}
    	
    	// CoreProductEavAttributeGroups
    	if(!$this->hasTable('core_product_eav_attribute_groups')) {
    		$table = $this->table('core_product_eav_attribute_groups');
    		$table
    			->addColumn('code', 'string', array('limit' => '100'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('code')
    			->create();
    		
    		$this->execute("INSERT INTO `core_product_eav_attribute_groups` (`id`, `code`, `created`, `modified`) VALUES
    			(NULL, 'DESCRIPTION', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, 'IMAGE', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, 'PRICE', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, 'ATTRIBUTES', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, 'PERMISSION', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);"
    		);
    	}
    	
    	// CoreProductEavAttributes
    	if($this->hasTable('core_product_eav_attributes')) {
    		$this->execute("ALTER TABLE `core_product_eav_attributes` ADD `core_product_eav_attribute_group_id` INT(10) NULL AFTER `id`;");
    		$this->execute("INSERT INTO `core_product_eav_attributes` (`id`, `core_product_eav_attribute_group_id`, `code`, `core_seller_id`, `is_required`, `data_type`, `multiple_values`, `created`, `modified`) VALUES
	    		(NULL, NULL, 'active', '1', '1', 'int', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, NULL, 'active', '2', '1', 'int', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
    		");
    	}
    	
    	// CoreProductEavAttributeNames
    	if($this->hasTable('core_product_eav_attribute_names')) {
    		$this->execute("INSERT INTO `core_product_eav_attribute_names` (`id`, `core_product_eav_attribute_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
				(NULL, 20, 1, 'Active', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 20, 2, 'Aktiv', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 21, 1, 'Active', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 21, 2, 'Aktiv', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);	
    		");
    	}
    	
    	
    	// CoreProductUpdateHistories
    	if($this->hasTable('core_product_update_histories')) {
    		$this->execute("ALTER TABLE `core_product_update_histories` CHANGE `core_product_id` `core_product_id` INT(10) NOT NULL AFTER `core_seller_id`;");
    		$this->execute("ALTER TABLE `core_product_update_histories` CHANGE `core_marketplace_id` `core_marketplace_id` INT(10) NULL;");
    		$this->execute("ALTER TABLE `core_product_update_histories` CHANGE `core_language_id` `core_language_id` INT(10) NULL;");
    	}
    	
    	// CoreProductUpdateTypes
    	if($this->hasTable('core_product_update_types')) {
	    	$this->execute("INSERT INTO `core_product_update_types` (`id`, `name`, `code`, `created`, `modified`) VALUES
				(NULL, 'Product Price', 'PRICE', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 'Product Quantity', 'QUANTITY', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 'Product Category', 'CATEGORY', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 'Product Image', 'IMAGE', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 'Product Description', 'DESCRIPTION', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 'Product Attributes', 'ATTRIBUTES', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 'Product Permission', 'PERMISSION', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
	    	");
    	}
    	
    	// EbayLaunchProfiles
    	if(!$this->hasTable('ebay_launch_profiles')) {
    		$table = $this->table('ebay_launch_profiles');
    		$table
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_account_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_site_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '100'))
    			->addColumn('duration', 'string', array('limit' => '45'))
    			->addColumn('ebay_lister_type_id', 'integer', array('limit' => '10'))
    			->addColumn('auction_type', 'string', array('limit' => '45'))
    			->addColumn('launch_quantity', 'integer', array('limit' => '10'))
    			->addColumn('min_quantity', 'integer', array('limit' => '10'))
    			->addColumn('quantity_restriction_per_buyer', 'integer', array('limit' => '10', 'null' => true))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('ebay_account_id')
    			->addIndex('ebay_site_id')
    			->addIndex('ebay_lister_type_id')
    			->addIndex('auction_type')
    			->create();
    		
    		$this->execute("INSERT INTO `ebay_launch_profiles` (`id`, `core_seller_id`, `ebay_account_id`, `ebay_site_id`, `name`, `duration`, `ebay_lister_type_id`, `auction_type`, `launch_quantity`, `min_quantity`, `quantity_restriction_per_buyer`, `created`, `modified`) VALUES
				(NULL, 2, 2, 1, 'Good ''Til Cancelled (GTC)', 'GTC', 1, 'FixedPriceItem', 1, 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
			");
    	}
    	
    	// EbayListerTypes
    	if(!$this->hasTable('ebay_lister_types')) {
    		$table = $this->table('ebay_lister_types');
    		$table
    			->addColumn('name', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->create();
    		
    		$this->execute("INSERT INTO `ebay_lister_types` (`id`, `name`, `created`, `modified`) VALUES
				(NULL, 'MIP', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
				(NULL, 'Trading API', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);"
    		);
    	}
    	
    	// EbayListings
    	if($this->hasTable('ebay_listings')) {
    		$this->execute("ALTER TABLE `ebay_listings` CHANGE `sku` `sku` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
    		$this->execute("ALTER TABLE `ebay_listings` ADD `ean` VARCHAR(45) NULL AFTER `sku`;");
    		$this->execute("ALTER TABLE `ebay_listings` CHANGE `item_title` `item_title` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
    		$this->execute("ALTER TABLE `ebay_listings` CHANGE `item_condition` `item_condition` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
    		$this->execute("ALTER TABLE `ebay_listings` CHANGE `ebay_category_id` `ebay_category_id` INT(10) NULL;");
    		$this->execute("ALTER TABLE `ebay_listings` CHANGE `start_price` `start_price` DECIMAL(14,4) NULL;");
    		$this->execute("ALTER TABLE `ebay_listings` CHANGE `quantity` `quantity` INT(10) NULL;");
    		$this->execute("ALTER TABLE `ebay_listings` CHANGE `quantity_sold` `quantity_sold` INT(10) NULL;");
    		$this->execute("ALTER TABLE `ebay_listings` CHANGE `lister_type` `ebay_lister_type_id` INT(11) NOT NULL;");
    		$this->execute("ALTER TABLE `ebay_listings` DROP `to_be_updated`;");
    		$this->execute("ALTER TABLE `ebay_listings` DROP `warnings`;");
    		$this->execute("ALTER TABLE `ebay_listings` DROP `error_messages`;");
    		$this->execute("ALTER TABLE `ebay_listings` DROP `xml_feed_name`;");
    	}
    	
    	// EbayListingErrors
    	if(!$this->hasTable('ebay_listing_errors')) {
    		$table = $this->table('ebay_listing_errors');
    		$table
    			->addColumn('ebay_listing_id', 'integer', array('limit' => '10'))
    			->addColumn('action', 'string', array('limit' => '45'))
    			->addColumn('type', 'string', array('limit' => '45'))
    			->addColumn('message', 'string', array('limit' => '1024'))
    			->addColumn('code', 'string', array('limit' => '45', 'null' => true))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('ebay_listing_id')
    			->addIndex('action')
    			->addIndex('type')
    			->addIndex('code')
    			->create();
    	}
    	
    	// FeedImportFieldMappings
    	if($this->hasTable('feed_import_field_mappings')) {
    		$this->execute("ALTER TABLE `feed_import_field_mappings` CHANGE `itool_field_name` `itool_field_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
    		$this->execute("ALTER TABLE `feed_import_field_mappings` CHANGE `search_value_in_database` `search_value_in_database` INT(1) NOT NULL DEFAULT '0';");
    	}
    	
    	// MipJobs
    	if($this->hasTable('mip_jobs')) {
    		$this->execute("ALTER TABLE `mip_jobs` ADD `ebay_account_id` INT(10) NOT NULL AFTER `core_seller_id`;");
    		$this->execute("ALTER TABLE `mip_jobs` ADD `ebay_site_id` INT(10) NOT NULL AFTER `ebay_account_id`;");
    		$this->execute("ALTER TABLE `mip_jobs` CHANGE `mip_account_name` `type` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
    	}
    }
}