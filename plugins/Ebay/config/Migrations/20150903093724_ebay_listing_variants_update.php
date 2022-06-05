<?php
use Phinx\Migration\AbstractMigration;

class EbayListingVariantsUpdate extends AbstractMigration
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
        $this->table('ebay_listing_variants')
            ->addColumn('start_price', 'decimal', ['precision' => 10, 'scale' => 2,'after' => 'sku'])
            ->addColumn('current_price', 'decimal', ['precision' => 10, 'scale' => 2,'after' => 'start_price'])
            ->addColumn('quantity_sold', 'integer', ['limit' => 10,'after' => 'quantity'])
            ->addColumn('variation_specifics', 'text', ['after' => 'quantity_sold'])
        ->update();
    }
}
