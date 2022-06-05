<?php
use Phinx\Migration\AbstractMigration;

class EbayListingFieldsUpdate extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('ebay_conditions')
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('ebay_code', 'string', ['limit' => 100])
            ->addColumn('ebay_id', 'integer', ['limit' => 10])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        $this->table('ebay_listings')
            ->removeColumn('scheduled')
            ->removeColumn('active')
            ->removeColumn('ended')
            ->removeColumn('use_second_category')
            ->removeColumn('item_condition')
            ->renameColumn('launch_quantity', 'max_quantity')
            ->renameColumn('item_title', 'title')
            ->renameColumn('item_subtitle', 'subtitle')
            ->renameColumn('item_location', 'location_city')
            ->renameColumn('item_postal_code', 'location_postal_code')
            ->renameColumn('item_country', 'location_country')
            ->addColumn('ebay_condition_id', 'integer', ['limit' => 10, 'after' => 'ebay_auction_type_id'])
            ->addColumn('current_price', 'decimal', ['precision' => 10, 'scale' => 2,'after' => 'start_price'])
            ->addColumn('currency', 'string', ['limit' => 10, 'after' => 'current_price'])
            ->addColumn('bid_count', 'integer', ['limit' => 10,'after' => 'listing_status'])
            ->addColumn('hit_counter', 'string', ['limit' => 100, 'after' => 'bid_count'])
            ->addColumn('hit_count', 'integer', ['limit' => 10,'after' => 'hit_counter'])
            ->addColumn('watch_count', 'integer', ['limit' => 10,'after' => 'hit_count'])
            ->addColumn('ebay_shipping_profile_id', 'string', ['limit' => 20,'after' => 'location_country'])
            ->addColumn('ebay_return_profile_id', 'string', ['limit' => 20,'after' => 'ebay_shipping_profile_name'])
            ->addColumn('ebay_payment_profile_id', 'string', ['limit' => 20,'after' => 'ebay_return_profile_name'])
            ->addIndex(['ebay_condition_id'])
            ->update();

        $this->execute('ALTER TABLE `ebay_listings` CHANGE `start_price` `start_price` DECIMAL(10,2) NULL DEFAULT NULL;');
    }
}
