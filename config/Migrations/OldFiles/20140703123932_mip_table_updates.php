<?php

use Phinx\Migration\AbstractMigration;

class MipTableUpdates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
     */
    public function change()
    {
    	if(!$this->hasTable('core_configurations')) {
    		$table = $this->table('core_configurations');
    		$this->execute("ALTER TABLE `core_configurations` CHANGE `configuration_value` `configuration_value` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
    		$this->execute("INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_key`, `configuration_value`, `created`, `modified`) VALUES
				(NULL, '2', 'Mip', 'mip_account_username', 'iways111', '2014-06-24 12:58:48', '2014-06-24 13:00:36'),
    			(NULL, '2', 'Mip', 'mip_ebay_site_id', '77', '2014-06-24 12:58:48', '2014-06-24 13:00:36'),
    			(NULL, '2', 'Mip', 'mip_feed_format', 'xml', '2014-06-24 12:58:48', '2014-06-24 13:00:36'),
				(NULL, '2', 'Mip', 'mip_new_product_feed_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/product/new/', '2014-06-24 12:47:48', '2014-06-24 12:55:06'),
				(NULL, '2', 'Mip', 'mip_new_inventory_feed_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/inventory/new/', '2014-06-24 12:54:02', '2014-06-24 12:55:17'),
				(NULL, '2', 'Mip', 'mip_new_product_response_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/product/new/', '2014-06-24 12:54:38', '2014-06-24 12:55:25'),
				(NULL, '2', 'Mip', 'mip_new_inventory_response_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/inventory/new/', '2014-06-24 12:57:21', '2014-06-24 12:57:21'),
				(NULL, '2', 'Mip', 'mip_processed_product_response_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/product/processed/', '2014-06-24 12:57:51', '2014-06-24 12:57:51'),
				(NULL, '2', 'Mip', 'mip_processed_inventory_response_path', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/inventory/processed/', '2014-06-24 12:58:09', '2014-06-24 12:58:09'),
				(NULL, '2', 'Mip', 'mip_sku_field', 'sku', '2014-06-24 15:45:00', '2014-06-24 15:45:00'),
				(NULL, '2', 'Mip', 'mip_ean_field', 'ean', '2014-06-24 13:04:24', '2014-06-24 15:40:30'),
				(NULL, '2', 'Mip', 'mip_condition_field', 'condition', '2014-06-24 13:04:57', '2014-06-24 15:41:32'),
				(NULL, '2', 'Mip', 'mip_title_field', 'title', '2014-06-24 16:01:12', '2014-06-24 16:01:12'),
				(NULL, '2', 'Mip', 'mip_subtitle_field', '', '2014-06-24 13:05:29', '2014-06-24 13:05:29'),
				(NULL, '2', 'Mip', 'mip_description_field', 'description', '2014-06-24 13:05:54', '2014-06-24 13:05:54'),
				(NULL, '2', 'Mip', 'mip_start_price_field', 'price', '2014-06-25 09:04:02', '2014-06-25 09:04:02'),
				(NULL, '2', 'Mip', 'mip_retail_price_field', '', '2014-06-25 09:35:30', '2014-06-25 09:35:30'),
				(NULL, '2', 'Mip', 'mip_min_advertised_price_field', '', '2014-06-25 09:05:50', '2014-06-25 09:34:02'),
				(NULL, '2', 'Mip', 'mip_min_advertised_price_exposure', 'DuringCheckout', '2014-06-25 09:06:37', '2014-06-25 09:06:37'),
				(NULL, '2', 'Mip', 'mip_launch_quantity', '1', '2014-06-25 09:14:46', '2014-06-25 09:14:46'),
				(NULL, '2', 'Mip', 'mip_image_field', 'product_image', '2014-06-25 09:19:50', '2014-06-25 09:25:34');
	    	");
    	}
    	
    	if($this->hasTable('ebay_accounts')) {
    		$this->execute("INSERT INTO `ebay_accounts` (`id`, `ebay_account_type_id`, `ebay_credential_id`, `core_seller_id`, `is_active`, `name`, `token`, `created`, `modified`) VALUES (NULL, '1', '1', '2', '1', 'iways111', 'AgAAAA**AQAAAA**aAAAAA**i1qhUw**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wJnY+lD5aBowmdj6x9nY+seQ**gX8AAA**AAMAAA**xCZLd2Kgq+HmA90K8y+2k6Lxpl5BvqRRvK/SRmITjCXm8p6zrRdztafbWsUX0j+qdZzT28+Adj/leBC6OMPgQ0BQmMfZ3qLiP9s3E2by3KM/oAV7fSfNcQfIGvYA0kPmYZ4Qy/3c5loKB6ONfYtKQxHxqpdk83F9a4PyAQOGsoYVSSceTmaczppS17OE5pOBwOPgZX9H1GDDDOAfrZbP+dKWDQnbPERuJovud8MHOP1n2CjggJ4uHnkldpnm0WkC6Cai2cAVHV9x6Nnfjo8eSMzA7cGrBH7DQWalZDnKGA3oI58yUDU00UJPXnF7xmQbdb9EGR7thQ1jQv2MeXMtc/H0wXjS3NjG+Ajb/ev6r6O+HKH0/SrG9NOJYa9X4dYq2rARg+LL9dF7bX6oLep5Hmr2kkyIMg63gYWLSWLwCHKwaG6dle+f7upPh7XCUR+/y+4r8jr3eDfDkGx8V8QI/dB+rYptGLHo7no2Hg1xkasohgFr2W8Y5sMUm5Eg7udSuSrRXdSzkUx4Bzwd0RJf6GDmer2oudzDbsId/quClHCIA11BI0qd2c5dvpVVsbqmqGHUtlY0XE+RQ9eJNPxSjKRq+Whxpwx9K1Xkp78MY2h5FUomMjFs8T83E2SmwhqnNWaH+eHh9TdmgXEpXUqZiA1RGJqSNyTRp9OGL1bdJ/7JL5LxXaZEf6xveUMDIkE6FgvfeNhJc0DbJX1LQOlhnmvy6ivxPZOj7/+b78DtzLWJ20aeszxLsZC7PW9vDtXS', NOW(), NOW())");
    	}
    	
    	if($this->hasTable('ebay_account_sites')) {
    		$this->execute("INSERT INTO `ebay_account_sites` (`id`, `ebay_account_id`, `ebay_site_id`, `created`, `modified`) VALUES (NULL, '2', '1', NOW(), NOW());");
    	}
    	 
    	if(!$this->hasTable('ebay_listings')) {
    		$table = $this->table('ebay_listings');
    		$table
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_account_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_site_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('core_product_id', 'integer', array('limit' => '10'))
    			->addColumn('sku', 'string', array('limit' => '100'))
    			->addColumn('ebay_item_id', 'string', array('limit' => '45', 'null' => true))
    			->addColumn('item_title', 'string', array('limit' => '100'))
    			->addColumn('item_subtitle', 'string', array('limit' => '100', 'null' => true))
    			->addColumn('item_condition', 'string', array('limit' => '45'))
    			->addColumn('ebay_category_id', 'integer', array('limit' => '10'))
    			->addColumn('start_price', 'decimal', array('limit' => '14,4'))
    			->addColumn('quantity', 'integer', array('limit' => '10'))
    			->addColumn('quantity_sold', 'integer', array('limit' => '10'))
    			->addColumn('lister_type', 'string', array('limit' => '45'))
    			->addColumn('auction_type', 'string', array('limit' => '45'))
    			->addColumn('duration', 'string', array('limit' => '45'))
    			->addColumn('scheduled', 'integer', array('limit' => '1'))
    			->addColumn('to_be_updated', 'integer', array('limit' => '1'))
    			->addColumn('active', 'integer', array('limit' => '1'))
    			->addColumn('ended', 'integer', array('limit' => '1'))
    			->addColumn('start_time', 'datetime', array('null' => true))
    			->addColumn('end_time', 'datetime', array('null' => true))
    			->addColumn('listing_status', 'string', array('limit' => '45', 'null' => true))
    			->addColumn('warnings', 'text', array('null' => true))
    			->addColumn('error_messages', 'text', array('null' => true))
    			->addColumn('xml_feed_name', 'string', array('limit' => '255'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('ebay_account_id')
    			->addIndex('ebay_site_id')
    			->addIndex('core_language_id')
    			->addIndex('core_product_id')
    			->addIndex('sku')
    			->addIndex('ebay_item_id')
    			->addIndex('ebay_category_id')
    			->addIndex('lister_type')
    			->addIndex('auction_type')
    			->addIndex('scheduled')
    			->addIndex('to_be_updated')
    			->addIndex('active')
    			->addIndex('ended')
    			->addIndex('listing_status')
    			->addIndex('xml_feed_name')
    			->create();
    	}
    	
    	if(!$this->hasTable('ftp_configurations')) {
    		$table = $this->table('ftp_configurations')
	    		->addColumn('core_seller_id', 'integer', array('limit' => '10'))
	    		->addColumn('name', 'string', array('limit' => '100'))
	    		->addColumn('host', 'string', array('limit' => '100'))
	    		->addColumn('port', 'integer', array('limit' => '10'))
	    		->addColumn('user', 'string', array('limit' => '100'))
	    		->addColumn('pass', 'string', array('limit' => '255'))
	    		->addColumn('action_type', 'string', array('limit' => '100'))
	    		->addColumn('connection_type', 'string', array('limit' => '100'))
	    		->addColumn('remote_path', 'string', array('limit' => '255'))
	    		->addColumn('local_path', 'string', array('limit' => '255'))
	    		->addColumn('archive_path', 'string', array('limit' => '255', 'null' => true))
	    		->addColumn('time_interval', 'integer', array('limit' => '10'))
	    		->addColumn('last_start', 'datetime', array('null' => true))
	    		->addColumn('next_start', 'datetime', array('null' => true))
	    		->addColumn('last_execution_time', 'datetime', array('null' => true))
	    		->addColumn('active', 'integer', array('limit' => '1'))
	    		->addColumn('created', 'datetime')
	    		->addColumn('modified', 'datetime')
	    		->addIndex('core_seller_id')
	    		->addIndex('active')
	    		->create();
    	}
    	
    	if($this->hasTable('ftp_configurations')) {
    		$this->execute("INSERT INTO `ftp_configurations` (`id`, `core_seller_id`, `name`, `host`, `port`, `user`, `pass`, `action_type`, `connection_type`, `remote_path`, `local_path`, `archive_path`, `time_interval`, `last_start`, `next_start`, `last_execution_time`, `active`, `created`, `modified`) VALUES
				(NULL, 2, 'MIP Product Feed Upload', 'mip.sandbox.ebay.com', 22, 'iways111', 'v^1.1#i^1#I^3#f^0#p^3#r^1#t^Ul4yXzYyMjFBNUQwMDcwOUU2MTIwMDdDM0FDM0ZENUQwMUM5I0VeMTI4NA==', 'UploadFile', 'sftp', '/store/product/', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/product/new/', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/product/uploaded', 15, '2014-07-02 09:04:00', '2014-07-02 09:19:00', '2014-07-02 09:04:00', 1, '2014-07-01 13:58:55', '2014-07-02 09:04:29'),
				(NULL, 2, 'MIP Inventory Feed Upload', 'mip.sandbox.ebay.com', 22, 'iways111', 'v^1.1#i^1#I^3#f^0#p^3#r^1#t^Ul4yXzYyMjFBNUQwMDcwOUU2MTIwMDdDM0FDM0ZENUQwMUM5I0VeMTI4NA==', 'UploadFile', 'sftp', '/store/inventory/', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/inventory/new/', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/inventory/uploaded', 15, '2014-07-02 09:04:00', '2014-07-02 09:19:00', '2014-07-02 09:04:00', 1, '2014-07-01 13:58:55', '2014-07-02 09:04:34'),
				(NULL, 2, 'MIP Product Feed Response Download', 'mip.sandbox.ebay.com', 22, 'iways111', 'v^1.1#i^1#I^3#f^0#p^3#r^1#t^Ul4yXzYyMjFBNUQwMDcwOUU2MTIwMDdDM0FDM0ZENUQwMUM5I0VeMTI4NA==', 'DownloadFile', 'sftp', '/store/product/output/{date}/', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/product/new/', '', 15, '2014-07-02 09:13:00', '2014-07-02 09:28:00', '2014-07-02 09:13:00', 1, '2014-07-01 13:58:55', '2014-07-02 09:13:39'),
				(NULL, 2, 'MIP Inventory Feed Response Download', 'mip.sandbox.ebay.com', 22, 'iways111', 'v^1.1#i^1#I^3#f^0#p^3#r^1#t^Ul4yXzYyMjFBNUQwMDcwOUU2MTIwMDdDM0FDM0ZENUQwMUM5I0VeMTI4NA==', 'DownloadFile', 'sftp', '/store/inventory/output/{date}/', '/Applications/MAMP/htdocs/iTool3/plugins/Mip/feeds/misco/responses/inventory/new/', '', 15, '2014-07-02 09:13:00', '2014-07-02 09:28:00', '2014-07-02 09:13:00', 1, '2014-07-01 13:58:55', '2014-07-02 09:13:44');
    		");
    	}
    	
    	if(!$this->hasTable('mip_jobs')) {
    		$table = $this->table('mip_jobs')
	    		->addColumn('core_seller_id', 'integer', array('limit' => '10'))
	    		->addColumn('mip_account_name', 'string', array('limit' => '45'))
	    		->addColumn('file_name', 'string', array('limit' => '255'))
	    		->addColumn('mip_job_status_id', 'integer', array('limit' => '10'))
	    		->addColumn('created', 'datetime')
	    		->addColumn('modified', 'datetime')
	    		->addIndex('core_seller_id')
	    		->addIndex('mip_account_name')
	    		->addIndex('mip_job_status_id')
	    		->create();
    	}
    	
    	if(!$this->hasTable('mip_job_statuses')) {
    		$table = $this->table('mip_job_statuses')
	    		->addColumn('code', 'string', array('limit' => '45'))
	    		->addColumn('created', 'datetime')
	    		->addColumn('modified', 'datetime')
	    		->addIndex('code')
	    		->create();
    	}
    	
    	if($this->hasTable('mip_job_statuses')) {
    		$this->execute("INSERT INTO `mip_job_statuses` (`id`, `code`, `created`, `modified`) VALUES
    			(NULL, 'PLANNED', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
    			(NULL, 'COMPLETED', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
    			(NULL, 'FAILED', '2014-06-16 17:22:24', '2014-06-16 17:22:24');");
    	}
    	
    	if(!$this->hasTable('mip_job_status_histories')) {
    		$table = $this->table('mip_job_status_histories')
    			->addColumn('mip_job_id', 'integer', array('limit' => '10'))
    			->addColumn('mip_job_status_id', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('mip_job_id')
    			->addIndex('mip_job_status_id')
    			->create();
    	}
    	
    	if(!$this->hasTable('mip_job_status_names')) {
    		$table = $this->table('mip_job_status_names')
    			->addColumn('feed_import_job_status_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('feed_import_job_status_id')
    			->addIndex('core_language_id')
    			->create();
    	}
    	
    	if($this->hasTable('mip_job_status_names')) {
    		$this->execute("INSERT INTO `mip_job_status_names` (`id`, `feed_import_job_status_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
				(NULL, 1, 1, 'Planned', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 1, 2, 'Geplant', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 2, 1, 'Completed', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 2, 2, 'Komplett bearbeitet', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 3, 1, 'Failed', '2014-06-16 17:22:24', '2014-06-16 17:22:24'),
				(NULL, 3, 2, 'Fehlgeschlagen', '2014-06-16 17:22:24', '2014-06-16 17:22:24');");
    	}
    }
}