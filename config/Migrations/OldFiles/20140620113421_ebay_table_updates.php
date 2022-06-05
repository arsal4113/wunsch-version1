<?php

use Phinx\Migration\AbstractMigration;

class EbayTableUpdates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     */
    public function change() {
    	if($this->hasTable('core_categories')) {
    		$this->execute("ALTER TABLE `core_categories` CHANGE `parent_id` `parent_id` INT(10) NOT NULL DEFAULT '0';");
    	}    	
    	
    	if($this->hasTable('core_category_eav_attributes')) {
    		$this->execute("INSERT INTO `core_category_eav_attributes` (`id`, `code`, `core_seller_id`, `is_required`, `data_type`, `multiple_values`, `created`, `modified`) VALUES
    			(NULL, 'name', '2', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    		");
    	}
    	
    	if($this->hasTable('core_category_eav_attribute_names')) {
	    	$this->execute("INSERT INTO `core_category_eav_attribute_names` (`id`, `core_category_eav_attribute_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
	    		(NULL, '2', '1', 'Category Name', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, '2', '2', 'Kategoriename', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
	    	");
    	}
    	
    	if(!$this->hasTable('core_configurations')) {
    		$table = $this->table('core_configurations');
    		$table
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('configuration_group', 'string', array('limit' => '45'))
    			->addColumn('configuration_key', 'string', array('limit' => '100'))
    			->addColumn('configuration_value', 'string', array('limit' => '100'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('configuration_group')
    			->addIndex('configuration_key')
    			->create();
    	}
    	
    	if($this->hasTable('core_configurations')) {
	    	$this->execute("INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_key`, `configuration_value`, `created`, `modified`) VALUES
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/new_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/misco/FullProductFeed/new/', '2014-06-24 12:47:48', '2014-06-24 12:55:06'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/inprogress_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/misco/FullProductFeed/inprogress/', '2014-06-24 12:54:02', '2014-06-24 12:55:17'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/imported_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/misco/FullProductFeed/imported/', '2014-06-24 12:54:38', '2014-06-24 12:55:25'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/failed_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/misco/FullProductFeed/failed/', '2014-06-24 12:57:21', '2014-06-24 12:57:21'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/feed_import_format', 'csv', '2014-06-24 12:57:51', '2014-06-24 12:57:51'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/csv_delimiter', '|', '2014-06-24 12:58:09', '2014-06-24 12:58:09'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/csv_enclosure', '\"', '2014-06-24 12:58:48', '2014-06-24 13:00:36'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/product_identifier', 'misconr', '2014-06-24 15:45:00', '2014-06-24 15:45:00'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/need_language_id', '1', '2014-06-24 13:04:24', '2014-06-24 15:40:30'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/language_import_column', 'languageCode', '2014-06-24 13:04:57', '2014-06-24 15:41:32'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/need_marketplace_id', '1', '2014-06-24 16:01:12', '2014-06-24 16:01:12'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/marketplace_import_column', 'marketplaceCode', '2014-06-24 13:05:29', '2014-06-24 13:05:29'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/need_product_type_id', '1', '2014-06-24 13:05:54', '2014-06-24 13:05:54'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/product_type_import_column', 'productTypeCode', '2014-06-25 09:04:02', '2014-06-25 09:04:02'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/import_category', '1', '2014-06-25 09:35:30', '2014-06-25 09:35:30'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/category_path_used', '1', '2014-06-25 09:05:50', '2014-06-25 09:34:02'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/category_delimiter', '>', '2014-06-25 09:06:37', '2014-06-25 09:06:37'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/category_import_column', 'Group', '2014-06-25 09:14:46', '2014-06-25 09:14:46'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/import_attributes', '0', '2014-06-25 09:16:54', '2014-06-25 09:27:51'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/attributes_column', '', '2014-06-25 09:19:05', '2014-06-25 09:19:05'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/attribute_delimiter', '', '2014-06-25 09:19:50', '2014-06-25 09:25:34'),
				(NULL, '2', 'FeedProcessor', 'MISCO_CSV_FULL_PRODUCT_FEED/attribute_value_delimiter', '', '2014-06-25 09:21:03', '2014-06-25 09:21:03'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/new_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/misco/PriceStockFeed/new/', '2014-06-24 12:47:48', '2014-06-24 12:55:06'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/inprogress_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/misco/PriceStockFeed/inprogress/', '2014-06-24 12:54:02', '2014-06-24 12:55:17'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/imported_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/misco/PriceStockFeed/imported/', '2014-06-24 12:54:38', '2014-06-24 12:55:25'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/failed_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/misco/PriceStockFeed/failed/', '2014-06-24 12:57:21', '2014-06-24 12:57:21'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/feed_import_format', 'csv', '2014-06-24 12:57:51', '2014-06-24 12:57:51'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/csv_delimiter', '|', '2014-06-24 12:58:09', '2014-06-24 12:58:09'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/csv_enclosure', '\"', '2014-06-24 12:58:48', '2014-06-24 13:00:36'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/product_identifier', 'ProductCode', '2014-06-24 15:45:00', '2014-06-24 15:45:00'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/need_language_id', '1', '2014-06-24 13:04:24', '2014-06-24 15:40:30'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/language_import_column', 'LanguageCode', '2014-06-24 13:04:57', '2014-06-24 15:41:32'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/need_marketplace_id', '1', '2014-06-24 16:01:12', '2014-06-24 16:01:12'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/marketplace_import_column', 'MarketplaceCode', '2014-06-24 13:05:29', '2014-06-24 13:05:29'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/need_product_type_id', '0', '2014-06-24 13:05:54', '2014-06-24 13:05:54'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/product_type_import_column', '', '2014-06-25 09:04:02', '2014-06-25 09:04:02'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/import_category', '0', '2014-06-25 09:35:30', '2014-06-25 09:35:30'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/category_path_used', '0', '2014-06-25 09:05:50', '2014-06-25 09:34:02'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/category_delimiter', '', '2014-06-25 09:06:37', '2014-06-25 09:06:37'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/category_import_column', '', '2014-06-25 09:14:46', '2014-06-25 09:14:46'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/import_attributes', '0', '2014-06-25 09:16:54', '2014-06-25 09:27:51'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/attributes_column', '', '2014-06-25 09:19:05', '2014-06-25 09:19:05'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/attribute_delimiter', '', '2014-06-25 09:19:50', '2014-06-25 09:25:34'),
				(NULL, '2', 'FeedProcessor', 'MISCO_PRICE_STOCK_ADJUSTMENT/attribute_value_delimiter', '', '2014-06-25 09:21:03', '2014-06-25 09:21:03');
	    	");
    	}
    	
    	if($this->hasTable('core_products')) {
    		$this->execute("ALTER TABLE `core_products` CHANGE `parent_id` `parent_id` INT(10) NOT NULL DEFAULT '0';");
    	}
    	
    	if($this->hasTable('core_product_eav_attributes')) {
    		$this->execute("INSERT INTO `core_product_eav_attributes` (`id`, `code`, `core_seller_id`, `is_required`, `data_type`, `multiple_values`, `created`, `modified`) VALUES
	    		(NULL, 'ean', '2', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, 'condition', '2', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, 'price', '2', '1', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, 'title', '2', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, 'description', '2', '1', 'text', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, 'manufacturer', '2', '0', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    			(NULL, 'manufacturer_code', '2', '0', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, 'product_image', '2', '1', 'image', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    		");
    	}
    	
    	if($this->hasTable('core_product_eav_attribute_names')) {
    		$this->execute("INSERT INTO `core_product_eav_attribute_names` (`id`, `core_product_eav_attribute_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
				(NULL, 12, 1, 'EAN', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 12, 2, 'EAN', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 13, 1, 'Item Condition', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 13, 2, 'Artikelzustand', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 14, 1, 'Item Price', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 14, 2, 'Artikelpreis', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 15, 1, 'Title', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 15, 2, 'Titel', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 16, 1, 'Long Description', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 16, 2, 'Langbeschreibung', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 17, 1, 'Manufacturer', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 17, 2, 'Hersteller', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 18, 1, 'Manufacturer Product Codes', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 18, 2, 'Herstellernummer', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 19, 1, 'Item Image', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 19, 2, 'Artikelbild', '2014-06-16 17:22:24', '2014-06-16 17:22:24');
    		");
    	}
    	
    	if($this->hasTable('core_sellers')) {
	    	$this->execute("INSERT INTO `core_sellers` (`id`, `name`, `is_active`, `created`, `modified`) VALUES
	    		(NULL, 'MISCO Germany Inc.', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
	    	");
    	}

    	if($this->hasTable('core_seller_marketplaces')) {
	    	$this->execute("INSERT INTO `core_seller_marketplaces` (`id`, `core_seller_id`, `core_marketplace_id`, `created`, `modified`) VALUES
	    		(NULL, '2', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
	    	");
    	}
    	
    	if($this->hasTable('ebay_accounts')) {
	    	$this->execute("INSERT INTO `ebay_accounts` (`id`, `ebay_account_type_id`, `ebay_credential_id`, `core_seller_id`, `is_active`, `name`, `token`, `created`, `modified`) VALUES (NULL, '1', '1', '1', '1', 'iways111', 'AgAAAA**AQAAAA**aAAAAA**i1qhUw**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wJnY+lD5aBowmdj6x9nY+seQ**gX8AAA**AAMAAA**xCZLd2Kgq+HmA90K8y+2k6Lxpl5BvqRRvK/SRmITjCXm8p6zrRdztafbWsUX0j+qdZzT28+Adj/leBC6OMPgQ0BQmMfZ3qLiP9s3E2by3KM/oAV7fSfNcQfIGvYA0kPmYZ4Qy/3c5loKB6ONfYtKQxHxqpdk83F9a4PyAQOGsoYVSSceTmaczppS17OE5pOBwOPgZX9H1GDDDOAfrZbP+dKWDQnbPERuJovud8MHOP1n2CjggJ4uHnkldpnm0WkC6Cai2cAVHV9x6Nnfjo8eSMzA7cGrBH7DQWalZDnKGA3oI58yUDU00UJPXnF7xmQbdb9EGR7thQ1jQv2MeXMtc/H0wXjS3NjG+Ajb/ev6r6O+HKH0/SrG9NOJYa9X4dYq2rARg+LL9dF7bX6oLep5Hmr2kkyIMg63gYWLSWLwCHKwaG6dle+f7upPh7XCUR+/y+4r8jr3eDfDkGx8V8QI/dB+rYptGLHo7no2Hg1xkasohgFr2W8Y5sMUm5Eg7udSuSrRXdSzkUx4Bzwd0RJf6GDmer2oudzDbsId/quClHCIA11BI0qd2c5dvpVVsbqmqGHUtlY0XE+RQ9eJNPxSjKRq+Whxpwx9K1Xkp78MY2h5FUomMjFs8T83E2SmwhqnNWaH+eHh9TdmgXEpXUqZiA1RGJqSNyTRp9OGL1bdJ/7JL5LxXaZEf6xveUMDIkE6FgvfeNhJc0DbJX1LQOlhnmvy6ivxPZOj7/+b78DtzLWJ20aeszxLsZC7PW9vDtXS', NOW(), NOW())");
    	}
    	
    	if($this->hasTable('ebay_account_sites')) {
    		$this->execute("INSERT INTO `ebay_account_sites` (`id`, `ebay_account_id`, `ebay_site_id`, `created`, `modified`) VALUES (NULL, '1', '1', NOW(), NOW());");
    	}
    	
    	if($this->hasTable('ebay_categories')) {
    		$this->execute("ALTER TABLE `ebay_categories` CHANGE `parent_id` `parent_id` INT(10) NULL;");
    	}
    	
    	if($this->hasTable('ebay_credentials')) {
    		$this->execute("INSERT INTO `ebay_credentials` (`id`, `ebay_account_type_id`, `key_set_name`, `app_id`, `dev_id`, `cert_id`, `created`, `modified`) VALUES (NULL, '2', 'Key Set 1', 'IWAYSP9BK2C4GZ5JJO11IP8148XLD5', 'D94DVH116G67LKJ7E23Z2L385X13B9', 'R4E685DPA1D\$DU5XX771R-5FXJ555J', NOW(), NOW());");
    	}
    	
    	if($this->hasTable('ebay_sites')) {
    		$this->execute("INSERT INTO `ebay_sites` (`id`, `core_marketplace_id`, `ebay_site_id`, `is_active`, `created`, `modified`) VALUES (NULL, '1', '77', '1', NOW(), NOW());");
    	}
    	
    	if($this->hasTable('ebay_site_names')) {
    		$this->execute("INSERT INTO `ebay_site_names` (`id`, `ebay_site_id`, `core_language_id`, `name`, `created`, `modified`) VALUES (NULL, '1', '1', 'eBay Germany', NOW(), NOW()), (NULL, '1', '2', 'eBay Deutschland', NOW(), NOW());");
    	}
    	
    	if($this->hasTable('feed_import_accounts')) {
	    	$this->execute("INSERT INTO `feed_import_accounts` (`id`, `core_seller_id`, `name`, `active`, `created`, `modified`) VALUES
	    		(NULL, '2', 'Misco Feed Account', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
	    	");
    	}
    	
    	if($this->hasTable('feed_import_accounts_to_types')) {
	    	$this->execute("INSERT INTO `feed_import_accounts_to_types` (`id`, `feed_import_type_id`, `feed_import_account_id`, `limit_per_hour`, `sort_order`, `created`, `modified`) VALUES
	    		(NULL, '4', '2', '10', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, '5', '2', '10', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
	    	");
    	}
    	
    	if($this->hasTable('feed_import_field_mappings')) {
    		$this->dropTable('feed_import_field_mappings');
    		$table = $this->table('feed_import_field_mappings');
    		$table
	    		->addColumn('feed_import_type_id', 'integer', array('limit' => '10'))
	    		->addColumn('import_file_field_name', 'string', array('limit' => '100'))
	    		->addColumn('itool_field_name', 'string', array('limit' => '100'))
	    		->addColumn('search_value_in_database', 'integer', array('limit' => '1'))
	    		->addColumn('created', 'datetime')
	    		->addColumn('modified', 'datetime')
	    		->addIndex('feed_import_type_id')
    		->create();
    	}
    	
    	if($this->hasTable('feed_import_field_value_mappings')) {
    		$this->dropTable('feed_import_field_value_mappings');
    		$table = $this->table('feed_import_field_value_mappings');
    		$table
	    		->addColumn('feed_import_field_mapping_id', 'integer', array('limit' => '10'))
	    		->addColumn('target_table', 'string', array('limit' => '45'))
	    		->addColumn('source_column_name', 'string', array('limit' => '45'))
	    		->addColumn('target_column_name', 'string', array('limit' => '45'))
	    		->addColumn('created', 'datetime')
	    		->addColumn('modified', 'datetime')
	    		->addIndex('feed_import_field_mapping_id')
	    		->create();
    	}
    	
    	if($this->hasTable('feed_import_flat_fields')) {
    		$this->dropTable('feed_import_flat_fields');
    	}
    	
    	if($this->hasTable('feed_import_type_configs')) {
    		$this->dropTable('feed_import_type_configs');
    	}
    	
    	if($this->hasTable('feed_import_type_required_configurations')) {
    		$this->dropTable('feed_import_type_required_configurations');
    	}
    	
    	if($this->hasTable('feed_import_types')) {
	    	$this->execute("INSERT INTO `feed_import_types` (`id`, `type_name`, `type_code`, `created`, `modified`) VALUES
	    		(NULL, 'Misco Full Product Feed', 'MISCO_CSV_FULL_PRODUCT_FEED', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
	    		(NULL, 'Misco Price Adjustment', 'MISCO_PRICE_STOCK_ADJUSTMENT', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
	    	");
    	}
    }
}