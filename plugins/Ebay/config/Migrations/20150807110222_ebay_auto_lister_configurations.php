<?php

use Phinx\Migration\AbstractMigration;

class EbayAutoListerConfigurations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table('ebay_auto_lister_configurations');
        $table
            ->addColumn('ebay_lister_type_id', 'integer', array(
                'limit' => 11
            ))        
            ->addColumn('ebay_launch_profile_id', 'integer', array(
                'limit' => 11,
                'null' => true
            ))
            ->addColumn('ebay_account_id', 'integer', array(
                'limit' => 11
            ))
            ->addColumn('ebay_site_id', 'integer', array(
                'limit' => 11
            ))
            ->addColumn('ebay_auction_type_id', 'integer', array(
                'limit' => 11
            ))
            ->addColumn('core_seller_id', 'integer', array(
                'limit' => 11
            ))
            ->addColumn('core_language_id', 'integer', array(
                'limit' => 11
            ))
            ->addColumn('name', 'string', array(
                'limit' => 128
            ))
            ->addColumn('duration', 'string', array(
                'limit' => 64
            ))               
            ->addColumn('launch_quantity', 'integer', array(
                'limit' => 11,
            ))
            ->addColumn('quantity_restriction_per_buyer', 'integer', array(
                'limit' => 11,
                'default' => 1,
                'null' => true
            ))                                         
            ->addColumn('use_subtitle', 'boolean', array(
                'default' => 0,
                'limit' => null
            ))
            ->addColumn('use_eps_service', 'boolean', array(
                'default' => 0,
                'limit' => null
            ))
            ->addColumn('use_second_category', 'boolean', array(
                'default' => 0,
                'limit' => null
            ))
            ->addColumn('item_location', 'string', array(
                'limit' => 128,
                'null' => false,
            ))
            ->addColumn('item_postal_code', 'string', array(
                'limit' => 32,
                'null' => true,
            ))
            ->addColumn('item_country', 'string', array(
                'limit' => 64,
                'null' => true,
            ))
            ->addColumn('ebay_shipping_profile_name', 'string', array(
                'limit' => 64,
                'null' => true
            ))
            ->addColumn('ebay_return_profile_name', 'string', array(
                'limit' => 64,
                'null' => true
            ))
            ->addColumn('ebay_payment_profile_name', 'string', array(
                'limit' => 64,
                'null' => true
            ))
            ->addColumn('query_limit', 'integer', array(
                'limit' => 11,
                'default' => 100,
                'null' => true
            ))
            ->addColumn('query_count', 'integer', array(
                'limit' => 11,
                'default' => 1,
                'null' => true
            ))
            ->addColumn('is_active', 'boolean', array(
                'default' => 0,
                'limit' => null
            ))            
            ->addColumn('created', 'datetime', array(
                'default' => null,
                'limit' => null,
                'null' => false,
            ))
            ->addColumn('modified', 'datetime', array(
                'default' => null,
                'limit' => null,
                'null' => false,
            ))
            ->addIndex(['ebay_lister_type_id'])
            ->addForeignKey('ebay_lister_type_id', 'ebay_lister_types', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])            
            ->addIndex(['ebay_launch_profile_id'])
            ->addForeignKey('ebay_launch_profile_id', 'ebay_launch_profiles', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['ebay_account_id'])
            ->addForeignKey('ebay_account_id', 'ebay_accounts', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['ebay_site_id'])
            ->addForeignKey('ebay_site_id', 'ebay_sites', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['ebay_auction_type_id'])
            ->addForeignKey('ebay_auction_type_id', 'ebay_auction_types', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['core_seller_id'])
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['core_language_id'])
            ->addForeignKey('core_language_id', 'core_languages', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['is_active'])
            ->create();
    }
}
