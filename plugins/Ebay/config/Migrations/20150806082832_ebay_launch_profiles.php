<?php

use Phinx\Migration\AbstractMigration;

class EbayLaunchProfiles extends AbstractMigration
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
        $table = $this->table('ebay_launch_profiles');
        $table
            ->removeColumn('ebay_lister_type_id')
            ->addColumn('ebay_lister_type_id', 'integer', array(
                'limit' => 11,
                'after' => 'id'
            ))
            ->removeColumn('ebay_account_id')
            ->addColumn('ebay_account_id', 'integer', array(
                'limit' => 11,
                'after' => 'ebay_lister_type_id'
            ))
            ->removeColumn('ebay_site_id')
            ->addColumn('ebay_site_id', 'integer', array(
                'limit' => 11,
                'after' => 'ebay_account_id'
            ))
            ->removeColumn('auction_type')
            ->addColumn('ebay_auction_type_id', 'integer', array(
                'limit' => 11,
                'after' => 'ebay_site_id'
            )) 
            ->addColumn('core_language_id', 'integer', array(
                'limit' => 11,
                'after' => 'core_seller_id'
            ))
            ->removeColumn('min_quantity')
            ->addColumn('use_subtitle', 'boolean', array(
                'default' => 0, 
                'limit' => null, 
                'after' => 'quantity_restriction_per_buyer'
            ))
            ->addColumn('use_eps_service', 'boolean', array(
                'default' => 0,
                'limit' => null,
                'after' => 'use_subtitle'
            ))
            ->addColumn('use_second_category', 'boolean', array(
                'default' => 0,
                'limit' => null,
                'after' => 'use_eps_service'
            ))            
            ->addColumn('item_location', 'string', array(
                'limit' => 128,
                'null' => false,
                'after' => 'use_second_category'
            ))
            ->addColumn('item_postal_code', 'string', array(
                'limit' => 32,
                'null' => true,
                'after' => 'item_location'
            ))
            ->addColumn('item_country', 'string', array(
                'limit' => 64,
                'null' => true,
                'after' => 'item_postal_code'
            ))
            ->addColumn('ebay_shipping_profile_name', 'string', array(
                'limit' => 32,
                'null' => true,
                'after' => 'item_country'
            ))
            ->addColumn('ebay_return_profile_name', 'string', array(
                'limit' => 32,
                'null' => true,
                'after' => 'ebay_shipping_profile_name'
            ))
            ->addColumn('ebay_payment_profile_name', 'string', array(
                'limit' => 32,
                'null' => true,
                'after' => 'ebay_return_profile_name'
            ))                                    
            ->update();
    }
}
