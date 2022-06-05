<?php
use Migrations\AbstractMigration;

class EbayListingChanges extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $this->table('ebay_listings')
            ->changeColumn('ebay_auction_type_id', 'integer', ['null' => true])
            ->changeColumn('core_product_id', 'integer', ['null' => true])
            ->update();
    }

    public function down()
    {
    }
}
