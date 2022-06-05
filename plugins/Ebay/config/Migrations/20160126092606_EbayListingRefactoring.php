<?php
use Migrations\AbstractMigration;

class EbayListingRefactoring extends AbstractMigration
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
        $this->table('ebay_auto_lister_configurations')
            ->dropForeignKey('ebay_launch_profile_id')
            ->removeColumn('ebay_launch_profile_id')
            ->removeColumn('ebay_shipping_profile_id')
            ->removeColumn('ebay_return_profile_id')
            ->removeColumn('ebay_payment_profile_id')
            ->removeColumn('ebay_shipping_profile_name')
            ->removeColumn('ebay_return_profile_name')
            ->removeColumn('ebay_payment_profile_name')
            ->removeColumn('query_limit')
            ->removeColumn('query_count')
            ->update();

        $this->table('ebay_listings')
            ->dropForeignKey('ebay_launch_profile_id')
            ->removeColumn('ebay_launch_profile_id')
            ->update();
    }
}
