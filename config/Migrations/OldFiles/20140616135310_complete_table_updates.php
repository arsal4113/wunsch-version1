<?php
use Phinx\Migration\AbstractMigration;

class CompleteTableUpdates extends AbstractMigration
{
	
    /**
     * Migrate Up.
     */
    public function up()
    {
    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
    
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     */
    public function change() {
    	$this->create_tables();
    	$this->fill_tables();
    }
    
    /**
     * Recreate all tables
     */
    private function create_tables() {
    	// 1. CoreCancelReasons
    	if(!$this->hasTable('core_cancel_reasons')) {
    		$table = $this->table('core_cancel_reasons');
    		$table
	    		->addColumn('code', 'string', array('limit' => '80'))
	    		->addColumn('created', 'datetime')
	    		->addColumn('modified', 'datetime')
	    		->create();
    	}
    	
    	// 2. CoreCancelReasonNames
    	if(!$this->hasTable('core_cancel_reason_names')) {
    		$table = $this->table('core_cancel_reason_names');
    		$table
    			->addColumn('core_cancel_reason_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '255'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_language_id')
    			->addIndex('core_cancel_reason_id')
    			->create();
    	}
    	
    	// 3. CoreCarriers
    	if(!$this->hasTable('core_carriers')) {
    		$table = $this->table('core_carriers');
    		$table
    			->addColumn('carrier_code', 'string', array('limit' => '80'))
    			->addColumn('carrier_link', 'string', array('limit' => '255'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
 		   		->create();
    	}
    	
    	// 4. CoreCarrierNames
    	if(!$this->hasTable('core_carrier_names')) {
    		$table = $this->table('core_carrier_names');
    		$table
    			->addColumn('core_carrier_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '255'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_carrier_id')
    			->addIndex('core_language_id')
    			->create();
    	}
    	
    	// 5. CoreCategories
    	if(!$this->hasTable('core_categories')) {
    		$table = $this->table('core_categories');
    		$table
    			->addColumn('parent_id', 'integer', array('limit' => '10'))
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('category_level', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('parent_id')
    			->addIndex('core_seller_id')
    			->addIndex('category_level')
    			->create();
    	}
    	
    	// 6. CoreCategoryAttributeValueVarchars
    	if(!$this->hasTable('core_category_attribute_value_varchars')) {
    		$table = $this->table('core_category_attribute_value_varchars');
    		$table
    			->addColumn('core_category_id', 'integer', array('limit' => '10'))
    			->addColumn('core_category_eav_attribute_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => '10'))
    			->addColumn('value', 'string', array('limit' => '255'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_category_id')
    			->addIndex('core_category_eav_attribute_id')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    		->create();
    	}
    	
    	// 7. CoreCategoryEavAttributes
    	if(!$this->hasTable('core_category_eav_attributes')) {
    		$table = $this->table('core_category_eav_attributes');
    		$table
    			->addColumn('code', 'string', array('limit' => '255'))
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('is_required', 'integer', array('limit' => '1'))
    			->addColumn('data_type', 'string', array('limit' => '45'))
    			->addColumn('multiple_values', 'integer', array('limit' => '1', 'default' => '0'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('is_required')
    			->addIndex('data_type')
    			->addIndex('multiple_values')
    			->create();
    	}
    	
    	// 8. CoreCategoryEavAttributeNames
    	if(!$this->hasTable('core_category_eav_attribute_names')) {
    		$table = $this->table('core_category_eav_attribute_names');
    		$table
    			->addColumn('core_category_eav_attribute_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '255'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_category_eav_attribute_id')
    			->addIndex('core_language_id')
    			->create();
    	}
    	
    	// 9. CoreErrorLogs
    	if(!$this->hasTable('core_error_logs')) {
    		$table = $this->table('core_error_logs');
    		$table
    			->addColumn('error_type', 'string', array('limit' => '80'))
    			->addColumn('error_sub_type', 'string', array('limit' => '80', 'null' => true))
    			->addColumn('message', 'string', array('limit' => '255'))
    			->addColumn('additional_error_data', 'string', array('limit' => '255', 'null' => true))
    			->addColumn('http_code', 'integer', array('limit' => '10', 'null' => true))
    			->addColumn('file', 'string', array('limit' => '255', 'null' => true))
    			->addColumn('line', 'integer', array('limit' => '10', 'null' => true))
    			->addColumn('trace', 'integer', array('limit' => '10', 'null' => true))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('error_type')
    			->addIndex('error_sub_type')
    			->addIndex('http_code')
    			->create();
    	}
    	
    	// 10. CoreLanguages
    	if(!$this->hasTable('core_languages')) {
    		$coreLanguages = $this->table('core_languages');
    		$coreLanguages
    			->addColumn('iso_code', 'string', array('limit' => 3))
    			->addColumn('name', 'string', array('limit' => 45))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('iso_code')
    			->create();
    	}
    	
    	// 11. CoreMarketplaces
    	if(!$this->hasTable('core_marketplaces')) {
    		$coreMarketplaces = $this->table('core_marketplaces');
    		$coreMarketplaces
    			->addColumn('code', 'string', array('limit' => 45))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('code')
    			->create();
    	}
    	
    	// 12. CoreMarketplaceNames
    	if(!$this->hasTable('core_marketplace_names')) {
    		$coreMarketplaceNames = $this->table('core_marketplace_names');
    		$coreMarketplaceNames
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('name', 'string', array('limit' => 80))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 13. CoreProducts
    	if(!$this->hasTable('core_products')) {
    		$coreProducts = $this->table('core_products');
    		$coreProducts
    			->addColumn('parent_id', 'integer', array('limit' => 10))
    			->addColumn('sku', 'string', array('limit' => 80))
    			->addColumn('core_product_type_id', 'integer', array('limit' => 10))
    			->addColumn('core_seller_id', 'integer', array('limit' => 10))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_type_id')
    			->addIndex('core_seller_id')
    			->create();
    	}
    	
    	// 14. CoreProductAttributeValueDatetimes
    	if(!$this->hasTable('core_product_attribute_value_datetimes')) {
    		$coreProductAttributeValueDatetimes = $this->table('core_product_attribute_value_datetimes');
    		$coreProductAttributeValueDatetimes
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('core_product_eav_attribute_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('value', 'datetime')
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_id')
    			->addIndex('core_product_eav_attribute_id')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 15. CoreProductAttributeValueDecimals
    	if(!$this->hasTable('core_product_attribute_value_decimals')) {
    		$coreProductAttributeValueDecimals = $this->table('core_product_attribute_value_decimals');
    		$coreProductAttributeValueDecimals
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('core_product_eav_attribute_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('value', 'decimal', array('limit' => '14,4'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_id')
    			->addIndex('core_product_eav_attribute_id')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 16. CoreProductAttributeValueDecimals
    	if(!$this->hasTable('core_product_attribute_value_decimals')) {
    		$coreProductAttributeValueDecimals = $this->table('core_product_attribute_value_decimals');
    		$coreProductAttributeValueDecimals
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('core_product_eav_attribute_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('value', 'decimal', array('limit' => '14,4'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_id')
    			->addIndex('core_product_eav_attribute_id')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 17. CoreProductAttributeValueImages
    	if(!$this->hasTable('core_product_attribute_value_images')) {
    		$coreProductAttributeValueImages = $this->table('core_product_attribute_value_images');
    		$coreProductAttributeValueImages
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('core_product_eav_attribute_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('value', 'string', array('limit' => 1024))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_id')
    			->addIndex('core_product_eav_attribute_id')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 18. CoreProductAttributeValueInts
    	if(!$this->hasTable('core_product_attribute_value_ints')) {
    		$coreProductAttributeValueInts = $this->table('core_product_attribute_value_ints');
    		$coreProductAttributeValueInts
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('core_product_eav_attribute_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('value', 'integer', array('limit' => 10))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_id')
    			->addIndex('core_product_eav_attribute_id')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 19. CoreProductAttributeValueTexts
    	if(!$this->hasTable('core_product_attribute_value_texts')) {
    		$coreProductAttributeValueTexts = $this->table('core_product_attribute_value_texts');
    		$coreProductAttributeValueTexts
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('core_product_eav_attribute_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('value', 'text')
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_id')
    			->addIndex('core_product_eav_attribute_id')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 20. CoreProductAttributeValueVarchars
    	if(!$this->hasTable('core_product_attribute_value_varchars')) {
    		$coreProductAttributeValueVarchars = $this->table('core_product_attribute_value_varchars');
    		$coreProductAttributeValueVarchars
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('core_product_eav_attribute_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('value', 'string', array('limit' => 1024))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_id')
    			->addIndex('core_product_eav_attribute_id')
    			->addIndex('core_language_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 21. CoreProductCategories
    	if(!$this->hasTable('core_product_categories')) {
    		$coreProductCategories = $this->table('core_product_categories');
    		$coreProductCategories
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('core_category_id', 'integer', array('limit' => 10))
	    		->addColumn('created', 'datetime')
	    		->addColumn('modified', 'datetime')
	    		->addIndex('core_product_id')
	    		->addIndex('core_category_id')
    			->create();
    	}
    	
    	// 22. CoreProductDefaultEavAttributes
    	if(!$this->hasTable('core_product_default_eav_attributes')) {
    		$coreProductDefaultEavAttributes = $this->table('core_product_default_eav_attributes');
    		$coreProductDefaultEavAttributes
    			->addColumn('code', 'string', array('limit' => 100))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('is_required', 'integer', array('limit' => 1))
    			->addColumn('data_type', 'string', array('limit' => 10))
    			->addColumn('multiple_values', 'integer', array('limit' => 1, 'default' => 0))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
	    		->addIndex('core_marketplace_id')
    			->addIndex('is_required')
    			->addIndex('data_type')
    			->addIndex('multiple_values')
    			->create();
    	}
    	
    	// 23. CoreProductEavAttributes
    	if(!$this->hasTable('core_product_eav_attributes')) {
    		$coreProductEavAttributes = $this->table('core_product_eav_attributes');
    		$coreProductEavAttributes
    			->addColumn('code', 'string', array('limit' => 100))
    			->addColumn('core_seller_id', 'integer', array('limit' => 10))
    			->addColumn('is_required', 'integer', array('limit' => 1))
    			->addColumn('data_type', 'string', array('limit' => 10))
    			->addColumn('multiple_values', 'integer', array('limit' => 1, 'default' => 0))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('is_required')
    			->addIndex('data_type')
    			->addIndex('multiple_values')
    			->create();
    	}
    	
    	// 24. CoreProductEavAttributeNames
    	if(!$this->hasTable('core_product_eav_attribute_names')) {
    		$coreProductEavAttributeNames = $this->table('core_product_eav_attribute_names');
    		$coreProductEavAttributeNames
    			->addColumn('core_product_eav_attribute_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('name', 'string', array('limit' => 100))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_language_id')
    			->addIndex('core_product_eav_attribute_id')
    			->create();
    	}
    	
    	// 25. CoreProductQuantities
    	if(!$this->hasTable('core_product_quantities')) {
    		$coreProductQuantities = $this->table('core_product_quantities');
    		$coreProductQuantities
    			->addColumn('core_product_id', 'integer', array('limit' => 10))
    			->addColumn('quantity', 'integer', array('limit' => 10))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_product_id')
    			->create();
    	}
    	
    	// 26. CoreProductTypes
    	if(!$this->hasTable('core_product_types')) {
    		$coreProductTypes = $this->table('core_product_types');
    		$coreProductTypes
    			->addColumn('code', 'string', array('limit' => 80))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->create();
    	}
    	
    	// 27. CoreProductTypeNames
    	if(!$this->hasTable('core_product_type_names')) {
    		$coreProductTypeNames = $this->table('core_product_type_names');
    		$coreProductTypeNames
    			->addColumn('core_product_type_id', 'integer', array('limit' => 10))
    			->addColumn('core_language_id', 'integer', array('limit' => 10))
    			->addColumn('name', 'string', array('limit' => 100))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_language_id')
    			->addIndex('core_product_type_id')
    			->create();
    	}
    	
    	// 28. CoreProductUpdateHistories
    	if(!$this->hasTable('core_product_update_histories')) {
    		$coreProductUpdateHistories = $this->table('core_product_update_histories');
    		$coreProductUpdateHistories
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('core_product_id', 'integer', array('limit' => '10'))
    			->addColumn('core_product_update_type_id', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('core_marketplace_id')
    			->addIndex('core_language_id')
    			->addIndex('core_product_id')
    			->addIndex('core_product_update_type_id')
    			->create();
    	}
    	
    	// 29. CoreProductUpdateTypes
    	if(!$this->hasTable('core_product_update_types')) {
    		$coreProductUpdateTypes = $this->table('core_product_update_types');
    		$coreProductUpdateTypes
    			->addColumn('name', 'string', array('limit' => '45'))
    			->addColumn('code', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->create();
    	}
    	
    	// 30. CoreSellers
    	if(!$this->hasTable('core_sellers')) {
    		$coreSellers = $this->table('core_sellers');
    		$coreSellers
    			->addColumn('name', 'string', array('limit' => 80))
    			->addColumn('is_active', 'integer', array('limit' => 1))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('is_active')
    			->create();
    	}
    	
    	// 31. CoreSellerMarketplaces
    	if(!$this->hasTable('core_seller_marketplaces')) {
    		$coreSellerMarketplaces = $this->table('core_seller_marketplaces');
    		$coreSellerMarketplaces
    			->addColumn('core_seller_id', 'integer', array('limit' => 10))
    			->addColumn('core_marketplace_id', 'integer', array('limit' => 10))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('core_marketplace_id')
    			->create();
    	}
    	
    	// 32. EbayAccounts
    	if(!$this->hasTable('ebay_accounts')) {
    		$ebayAccounts = $this->table('ebay_accounts');
    		$ebayAccounts
    			->addColumn('ebay_account_type_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_credential_id', 'integer', array('limit' => '10'))
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('is_active', 'integer', array('limit' => '1'))
    			->addColumn('name', 'string', array('limit' => '45'))
    			->addColumn('token', 'text')
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('ebay_account_type_id')
    			->addIndex('ebay_credential_id')
    			->addIndex('core_seller_id')
    			->addIndex('is_active')
    			->create();
    	}
    	
    	// 33. EbayAccountSites
    	if(!$this->hasTable('ebay_account_sites')) {
    		$ebayAccountSites = $this->table('ebay_account_sites');
    		$ebayAccountSites
    			->addColumn('ebay_account_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_site_id', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('ebay_account_id')
    			->addIndex('ebay_site_id')
    			->create();
    	}
    	
    	// 34. EbayAccountTypes
    	if(!$this->hasTable('ebay_account_types')) {
    		$ebayAccountTypes = $this->table('ebay_account_types');
    		$ebayAccountTypes
    			->addColumn('account_type', 'string', array('limit' => '45'))
    			->addColumn('is_active', 'integer', array('limit' => '1'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('is_active')
    			->create();
    	}
    	
    	// 35. EbayAccountTypeNames
    	if(!$this->hasTable('ebay_account_type_names')) {
    		$ebayAccountTypeNames = $this->table('ebay_account_type_names');
    		$ebayAccountTypeNames
    			->addColumn('ebay_account_type_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('ebay_account_type_id')
    			->addIndex('core_language_id')
    			->create();
    	}
    	
    	// 36. EbayCategories
    	if(!$this->hasTable('ebay_categories')) {
    		$ebayCategories = $this->table('ebay_categories');
    		$ebayCategories
    			->addColumn('ebay_site_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_category_id', 'integer', array('limit' => '10'))
    			->addColumn('parent_id', 'integer', array('limit' => '10'))
    			->addColumn('category_level', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '255'))
    			->addColumn('version', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('ebay_site_id')
    			->addIndex('ebay_category_id')
    			->addIndex('parent_id')
    			->addIndex('version')
    			->create();
    	}
    	
    	// 37. EbayCategoryMappings
    	if(!$this->hasTable('ebay_category_mappings')) {
    		$ebayCategoryMappings = $this->table('ebay_category_mappings');
    		$ebayCategoryMappings
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('core_category_id', 'integer', array('limit' => '10'))
    			->addColumn('ebay_category_id', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('core_category_id')
    			->addIndex('ebay_category_id')
    			->create();
    	}
    	
    	// 38. EbayCredentials
    	if(!$this->hasTable('ebay_credentials')) {
    		$ebayCredentials = $this->table('ebay_credentials');
    		$ebayCredentials
    		->addColumn('ebay_account_type_id', 'integer', array('limit' => '11'))
    		->addColumn('key_set_name', 'string', array('limit' => '64'))
    		->addColumn('app_id', 'string', array('limit' => '255'))
    		->addColumn('dev_id', 'string', array('limit' => '255'))
    		->addColumn('cert_id', 'string', array('limit' => '255'))
    		->addColumn('created', 'datetime')
    		->addColumn('modified', 'datetime')
    		->addIndex('ebay_account_type_id')
    		->create();
    	}
    	
    	// 39. EbaySites
    	if(!$this->hasTable('ebay_sites')) {
    		$ebaySites = $this->table('ebay_sites');
    		$ebaySites
    			->addColumn('core_marketplace_id', 'integer', array('limit' => '11'))
    			->addColumn('ebay_site_id', 'integer', array('limit' => '11'))
    			->addColumn('is_active', 'integer', array('limit' => '1'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_marketplace_id')
    			->addIndex('ebay_site_id')
    			->addIndex('is_active')
    			->create();
    	}
    	
    	// 40. EbaySiteNames
    	if(!$this->hasTable('ebay_site_names')) {
    		$ebaySiteNames = $this->table('ebay_site_names');
    		$ebaySiteNames
    			->addColumn('ebay_site_id', 'integer', array('limit' => '11'))
    			->addColumn('core_language_id', 'integer', array('limit' => '11'))
    			->addColumn('name', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('ebay_site_id')
    			->addIndex('core_language_id')
    			->create();
    	}
    	
    	// 41. FeedImportAccounts
    	if(!$this->hasTable('feed_import_accounts')) {
    		$feedImportAccounts = $this->table('feed_import_accounts');
    		$feedImportAccounts
    			->addColumn('core_seller_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '45'))
    			->addColumn('active', 'integer', array('limit' => '1'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('core_seller_id')
    			->addIndex('active')
    			->create();
    	}
    	
    	// 42. FeedImportAccountsToTypes
    	if(!$this->hasTable('feed_import_accounts_to_types')) {
    		$feedImportAccountsToTypes = $this->table('feed_import_accounts_to_types');
    		$feedImportAccountsToTypes
    			->addColumn('feed_import_type_id', 'integer', array('limit' => '10'))
    			->addColumn('feed_import_account_id', 'integer', array('limit' => '10'))
    			->addColumn('limit_per_hour', 'integer', array('limit' => '10'))
    			->addColumn('sort_order', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('feed_import_type_id')
    			->addIndex('feed_import_account_id')
    			->create();
    	}
    	
    	// 43. FeedImportFieldMappings
    	if(!$this->hasTable('feed_import_field_mappings')) {
    		$feedImportFieldMappings = $this->table('feed_import_field_mappings');
    		$feedImportFieldMappings
    			->addColumn('feed_import_type_id', 'integer', array('limit' => '10'))
    			->addColumn('source_table', 'string', array('limit' => '45'))
    			->addColumn('target_table', 'string', array('limit' => '45'))
    			->addColumn('entity_id', 'integer', array('limit' => '10'))
    			->addColumn('import_file_field', 'string', array('limit' => '100'))
    			->addColumn('default_value', 'string', array('limit' => '100', 'null' => true))
    			->addColumn('is_eav', 'integer', array('limit' => '1'))
    			->addColumn('value_mapping', 'integer', array('limit' => '1'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('feed_import_type_id')
    			->addIndex('entity_id')
    			->addIndex('is_eav')
    			->addIndex('value_mapping')
    			->create();
    	}
    	
    	// 44. FeedImportFieldValueMappings
    	if(!$this->hasTable('feed_import_field_value_mappings')) {
    		$feedImportFieldValueMappings = $this->table('feed_import_field_value_mappings');
    		$feedImportFieldValueMappings
    			->addColumn('feed_import_field_mapping_id', 'integer', array('limit' => '10'))
    			->addColumn('mapping_table', 'string', array('limit' => '45'))
    			->addColumn('source_column_name', 'string', array('limit' => '45'))
    			->addColumn('target_column_name', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('feed_import_field_mapping_id')
    			->create();
    	}
    	
    	// 45. FeedImportFlatFields
    	if(!$this->hasTable('feed_import_flat_fields')) {
    		$feedImportFlatFields = $this->table('feed_import_flat_fields');
    		$feedImportFlatFields
    			->addColumn('entity_id', 'integer', array('limit' => '10'))
    			->addColumn('column_name', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('entity_id')
    			->create();
    	}
    	
    	// 46. FeedImportJobs
    	if(!$this->hasTable('feed_import_jobs')) {
    		$feedImportJobs = $this->table('feed_import_jobs');
    		$feedImportJobs
    			->addColumn('feed_import_account_id', 'integer', array('limit' => '10'))
    			->addColumn('feed_import_type_id', 'integer', array('limit' => '10'))
    			->addColumn('file_name', 'string', array('limit' => '255'))
    			->addColumn('feed_import_job_status_id', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('feed_import_account_id')
    			->addIndex('feed_import_type_id')
    			->addIndex('feed_import_job_status_id')
    			->create();
    	}
    	
    	// 47. FeedImportJobStatuses
    	if(!$this->hasTable('feed_import_job_statuses')) {
    		$feedImportJobStatuses = $this->table('feed_import_job_statuses');
    		$feedImportJobStatuses
    			->addColumn('code', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->create();
    	}
    	
    	// 48. FeedImportJobStatusHistories
    	if(!$this->hasTable('feed_import_job_status_histories')) {
    		$feedImportJobStatusHistories = $this->table('feed_import_job_status_histories');
    		$feedImportJobStatusHistories
    			->addColumn('feed_import_job_id', 'integer', array('limit' => '10'))
    			->addColumn('feed_import_job_status_id', 'integer', array('limit' => '10'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('feed_import_job_id')
    			->addIndex('feed_import_job_status_id')
    			->create();
    	}

    	// 49. FeedImportJobStatusNames
    	if(!$this->hasTable('feed_import_job_status_names')) {
    		$feedImportJobStatusNames = $this->table('feed_import_job_status_names');
    		$feedImportJobStatusNames
    			->addColumn('feed_import_job_status_id', 'integer', array('limit' => '10'))
    			->addColumn('core_language_id', 'integer', array('limit' => '10'))
    			->addColumn('name', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('feed_import_job_status_id')
    			->addIndex('core_language_id')
    			->create();
    	}

    	// 50. FeedImportTypes
    	if(!$this->hasTable('feed_import_types')) {
    		$feedImportTypes = $this->table('feed_import_types');
    		$feedImportTypes
    			->addColumn('type_name', 'string', array('limit' => '80'))
    			->addColumn('type_code', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->create();
    	}
    	
    	// 51. FeedImportTypeConfigs
    	if(!$this->hasTable('feed_import_type_configs')) {
    		$feedImportTypeConfigs = $this->table('feed_import_type_configs');
    		$feedImportTypeConfigs
    		->addColumn('feed_import_type_id', 'integer', array('limit' => '10'))
    		->addColumn('configuration_code', 'string', array('limit' => '45'))
    		->addColumn('configuration_value', 'string', array('limit' => '255'))
    		->addColumn('created', 'datetime')
    		->addColumn('modified', 'datetime')
    		->addIndex('feed_import_type_id')
    		->addIndex('configuration_code')
    		->create();
    	}
    	
    	// 52. FeedImportTypeRequiredConfigurations
    	if(!$this->hasTable('feed_import_type_required_configurations')) {
    		$feedImportTypeRequiredConfigurations = $this->table('feed_import_type_required_configurations');
    		$feedImportTypeRequiredConfigurations
    			->addColumn('feed_import_type_id', 'integer', array('limit' => '10'))
    			->addColumn('configuration_code', 'string', array('limit' => '45'))
    			->addColumn('created', 'datetime')
    			->addColumn('modified', 'datetime')
    			->addIndex('feed_import_type_id')
    			->addIndex('configuration_code')
    			->create();
    	}
    }
    
    /**
     * Fill standard values for some tables
     */
    public function fill_tables() {
    	// 1. Fill CoreCategoryEavAttributes Table
    	$this->execute("INSERT INTO `core_category_eav_attributes` (`id`, `code`, `core_seller_id`, `is_required`, `data_type`, `multiple_values`, `created`, `modified`) VALUES
    		(NULL, 'name', '1', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 2. Fill CoreCategoryEavAttributeNames Table
    	$this->execute("INSERT INTO `core_category_eav_attribute_names` (`id`, `core_category_eav_attribute_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    		(NULL, '1', '1', 'Category Name', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', '2', 'Kategoriename', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 3. Fill CoreLanguages Table
    	$this->execute("INSERT INTO `core_languages` (`id`, `iso_code`, `name`, `created`, `modified`) VALUES
    		(NULL, 'EN', 'English', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'DE', 'German', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 4. Fill CoreMarketplaces Table
    	$this->execute("INSERT INTO `core_marketplaces` (`id`, `code`, `created`, `modified`) VALUES
    		(NULL, 'ebay_de', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 5. Fill CoreMarketplaceNames Table
    	$this->execute("INSERT INTO `core_marketplace_names` (`id`, `core_marketplace_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    		(NULL, '1', '1', 'eBay Germany', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', '2', 'eBay Deutschland', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 6. Fill CoreProductDefaultEavAttributes Table
    	$this->execute("INSERT INTO `core_product_default_eav_attributes` (`id`, `code`, `core_marketplace_id`, `is_required`, `data_type`, `multiple_values`, `created`, `modified`) VALUES
    		(NULL, 'ean', '1', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'condition', '1', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'price', '1', '1', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'msr_price', '1', '0', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'strikethrough_price', '1', '0', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'title', '1', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'short_description', '1', '0', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'description', '1', '1', 'text', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
   			(NULL, 'weight', '1', '0', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'manufacturer', '1', '0', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'product_image', '1', '1', 'image', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)  			
    	");
    	
    	// 7. Fill CoreProductEavAttributes Table
    	$this->execute("INSERT INTO `core_product_eav_attributes` (`id`, `code`, `core_seller_id`, `is_required`, `data_type`, `multiple_values`, `created`, `modified`) VALUES
    		(NULL, 'ean', '1', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'condition', '1', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'price', '1', '1', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'msr_price', '1', '0', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'strikethrough_price', '1', '0', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'title', '1', '1', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'short_description', '1', '0', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'description', '1', '1', 'text', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
   			(NULL, 'weight', '1', '0', 'decimal', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'manufacturer', '1', '0', 'varchar', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'product_image', '1', '1', 'image', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 8. Fill CoreProductEavAttributeNames Table
    	$this->execute("INSERT INTO `core_product_eav_attribute_names` (`id`, `core_product_eav_attribute_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    		(NULL, '1', '1', 'EAN', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', '2', 'EAN', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '1', 'Item Condition', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '2', 'Artikelzustand', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', '1', 'Item Price', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', '2', 'Artikelpreis', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '4', '1', 'UVP Price', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '4', '2', 'UVP-Preis', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '5', '1', 'Discount Price', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '5', '2', 'Rabatt-Preis', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '6', '1', 'Title', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '6', '2', 'Titel', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '7', '1', 'Short Description', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '7', '2', 'Kurzbeschreibung', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '8', '1', 'Long Description', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '8', '2', 'Langbeschreibung', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '9', '1', 'Weight', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '9', '2', 'Gewicht', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '10', '1', 'Manufacturer', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '10', '2', 'Hersteller', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '11', '1', 'Item Image(s)', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '11', '2', 'Artikelbild(er)', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)								
    	");
    	

    	// 9. Fill CoreProductTypes Table
    	$this->execute("INSERT INTO `core_product_types` (`id`, `code`, `created`, `modified`) VALUES
    		(NULL, 'PHYSICAL', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'DIGITAL', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 10. Fill CoreProductTypeNames Table
    	$this->execute("INSERT INTO `core_product_type_names` (`id`, `core_product_type_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    		(NULL, '1', '1', 'Physical Product', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', '2', 'Physisches Produkt', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '1', 'Digital Product', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '2', 'Digitales Produkt', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 11. Fill CoreSellers Table
    	$this->execute("INSERT INTO `core_sellers` (`id`, `name`, `is_active`, `created`, `modified`) VALUES
    		(NULL, 'I-Ways sales solutions GmbH', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 12. Fill CoreSellerMarketplaces Table
    	$this->execute("INSERT INTO `core_seller_marketplaces` (`id`, `core_seller_id`, `core_marketplace_id`, `created`, `modified`) VALUES
    		(NULL, '1', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 13. Fill EBayAccountTypes Table
    	$this->execute("INSERT INTO `ebay_account_types` (`id`, `account_type`, `is_active`, `created`, `modified`) VALUES
    		(NULL, 'Live', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'Sandbox', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)	
    	");
    	
    	// 14. Fill EBayAccountTypeNames Table
    	$this->execute("INSERT INTO `ebay_account_type_names` (`id`, `ebay_account_type_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    		(NULL, '1', '1', 'eBay Live', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', '2', 'eBay Live', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '1', 'eBay Sandbox', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '2', 'eBay Sandbox', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 15. Fill FeedImportAccounts Table
    	$this->execute("INSERT INTO `feed_import_accounts` (`id`, `core_seller_id`, `name`, `active`, `created`, `modified`) VALUES
    		(NULL, '1', 'I-Ways Feed Account', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 16. Fill FeedImportAccountsToTypes Table
    	$this->execute("INSERT INTO `feed_import_accounts_to_types` (`id`, `feed_import_type_id`, `feed_import_account_id`, `limit_per_hour`, `sort_order`, `created`, `modified`) VALUES
    		(NULL, '1', '1', '10', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '1', '10', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', '1', '10', '3', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");

    	// 17. Fill FeedImportFieldMappings Table
    	$this->execute("INSERT INTO `feed_import_field_mappings` (`id`, `feed_import_type_id`, `source_table`, `target_table`, `entity_id`, `import_file_field`, `default_value`, `is_eav`, `value_mapping`, `created`, `modified`) VALUES
    		(NULL, '1', 'FeedImportFlatFields', 'CoreProducts', '1', 'sku', '', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'CoreProductEavAttributes', 'CoreProductAttributeValueDecimals', '3', 'price', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'CoreProductEavAttributes', 'CoreProductAttributeValueDecimals', '4', 'msrp_price', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'FeedImportFlatFields', 'CoreProducts', '2', 'parent_sku', '', '0', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'FeedImportFlatFields', 'CoreProducts', '3', 'product_type', '', '0', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'CoreProductEavAttributes', 'CoreProductAttributeValueVarchars', '6', 'title', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'CoreProductEavAttributes', 'CoreProductAttributeValueImages', '11', 'product_image_1', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'CoreProductEavAttributes', 'CoreProductAttributeValueImages', '11', 'product_image_2', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'FeedImportFlatFields', 'CoreProductQuantities', '4', 'quantity', '', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'CoreProductEavAttributes', 'CoreProductAttributeValueVarchars', '0', 'attributes', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'FeedImportFlatFields', 'CoreProductCategories', '5', 'category_path', '', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'FeedImportFlatFields', 'CoreProducts', '1', 'sku', '', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'CoreProductEavAttributes', 'CoreProductAttributeValueDecimals', '3', 'price', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'CoreProductEavAttributes', 'CoreProductAttributeValueDecimals', '4', 'msrp_price', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'CoreProductEavAttributes', 'CoreProductAttributeValueDecimals', '5', 'discount_price', '', '1', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'FeedImportFlatFields', 'CoreProducts', '1', 'sku', '', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'FeedImportFlatFields', 'CoreProductQuantities', '4', 'quantity', '', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");  

    	// 18. Fill FeedImportFieldValueMappings Table
    	$this->execute("INSERT INTO `feed_import_field_value_mappings` (`id`, `feed_import_field_mapping_id`, `mapping_table`, `source_column_name`, `target_column_name`, `created`, `modified`) VALUES
    		(NULL, '4', 'CoreProducts', 'sku', 'id', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '5', 'CoreProductTypes', 'code', 'id', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 19. Fill FeedImportFlatFields Table
    	$this->execute("INSERT INTO `feed_import_flat_fields` (`id`, `entity_id`, `column_name`, `created`, `modified`) VALUES
    		(NULL, '1', 'sku', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'parent_id', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'core_product_type_id', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '4', 'quantity', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '5', 'core_category_id', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 20. Fill FeedImportJobStatuses Table
    	$this->execute("INSERT INTO `feed_import_job_statuses` (`id`, `code`, `created`, `modified`) VALUES
    		(NULL, 'PLANNED', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'IN_PROGRESS', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'COMPLETED', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),		
    		(NULL, 'FAILED', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	 
    	// 21. Fill FeedImportJobStatusNames Table
    	$this->execute("INSERT INTO `feed_import_job_status_names` (`id`, `feed_import_job_status_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    		(NULL, '1', '1', 'Planned', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', '2', 'Geplant', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '1', 'In Progress', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', '2', 'In Bearbeitung', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),   
    		(NULL, '3', '1', 'Completed', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', '2', 'Komplett bearbeitet', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),   
    		(NULL, '4', '1', 'Failed', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '4', '2', 'Fehlgeschlagen', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)   
    	");
    	
    	// 22. Fill FeedImportTypes Table
    	$this->execute("INSERT INTO `feed_import_types` (`id`, `type_name`, `type_code`, `created`, `modified`) VALUES
    		(NULL, 'I-Ways Full Product Feed', 'STANDARD_CSV_FULL_PRODUCT_FEED', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'I-Ways Price Adjustment', 'STANDARD_PRICE_ADJUSTMENT', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, 'I-Ways Stock Adjustment', 'STANDARD_STOCK_ADJUSTMENT', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 23. Fill FeedImportTypeConfigs Table
    	$this->execute("INSERT INTO `feed_import_type_configs` (`id`, `feed_import_type_id`, `configuration_code`, `configuration_value`, `created`, `modified`) VALUES
    		(NULL, '1', 'new_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/FullProductFeed/new/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'inprogress_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/FullProductFeed/inprogress/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'imported_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/FullProductFeed/imported/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'failed_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/FullProductFeed/failed/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'feed_import_format', 'csv', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'csv_delimiter', ';', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'csv_enclosure', '\"', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_identifier', 'sku', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'language_identifier', 'language_code', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'marketplace_identifier', 'marketplace_code', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_attributes_column', 'attributes', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_attribute_delimiter', '||', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_attribute_value_delimiter', ':::', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'delete_old_attribute_data', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_category_column', 'category_path', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_category_delimiter', '>', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'new_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/PriceFeed/new/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'inprogress_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/PriceFeed/inprogress/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'imported_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/PriceFeed/imported/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'failed_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/PriceFeed/failed/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'feed_import_format', 'csv', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'csv_delimiter', ';', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'csv_enclosure', '\"', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),	
    		(NULL, '2', 'product_identifier', 'sku', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'language_identifier', 'language_code', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'marketplace_identifier', 'marketplace_code', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'delete_old_attribute_data', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'new_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/StockFeed/new/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'inprogress_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/StockFeed/inprogress/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'imported_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/StockFeed/imported/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'failed_feed_directory', '/Applications/MAMP/htdocs/iTool3/import/iways/StockFeed/failed/', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'feed_import_format', 'csv', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'csv_delimiter', ';', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'csv_enclosure', '\"', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'product_identifier', 'sku', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    	");
    	
    	// 24. Fill FeedImportTypeRequiredConfigurations Table
    	$this->execute("INSERT INTO `feed_import_type_required_configurations` (`id`, `feed_import_type_id`, `configuration_code`, `created`, `modified`) VALUES
    		(NULL, '1', 'new_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'inprogress_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'imported_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'failed_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'feed_import_format', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'csv_delimiter', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'csv_enclosure', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_identifier', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'language_identifier', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'marketplace_identifier', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_attributes_column', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_attribute_delimiter', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_attribute_value_delimiter', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'delete_old_attribute_data', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_category_column', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '1', 'product_category_delimiter', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'new_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'inprogress_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'imported_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'failed_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'feed_import_format', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'csv_delimiter', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'csv_enclosure', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'product_identifier', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'language_identifier', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '2', 'marketplace_identifier', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),	
    		(NULL, '2', 'delete_old_attribute_data', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'new_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'inprogress_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'imported_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'failed_feed_directory', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'feed_import_format', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'csv_delimiter', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'csv_enclosure', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    		(NULL, '3', 'product_identifier', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)	
    	");
    }
}