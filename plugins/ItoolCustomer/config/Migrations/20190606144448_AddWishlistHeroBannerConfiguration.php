<?php
use Migrations\AbstractMigration;

class AddWishlistHeroBannerConfiguration extends AbstractMigration
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
        $table = $this->table('customer_wishlist_configurations');
        if (!$table->exists()) {
            $table
                ->addColumn('randomize', 'boolean', ['default' => false])
                ->addColumn(
                    'banner_products_factor',
                    'integer',
                    [
                        'limit' => 11,
                        'signed' => false,
                        'null' => true,
                        'default' => \ItoolCustomer\Model\Table\CustomerWishlistConfigurationsTable::BANNER_PRODUCTS_FACTOR
                    ]
                )
                ->addColumn(
                    'banner_small_positions',
                    'string',
                    [
                        'default' => implode(',', \ItoolCustomer\Model\Table\CustomerWishlistConfigurationsTable::BANNER_SMALL_POSITIONS),
                        'limit' => 510, 'null' => true,
                    ]
                )
                ->addColumn(
                    'banner_large_positions',
                    'string',
                    [
                        'default' => implode(',', \ItoolCustomer\Model\Table\CustomerWishlistConfigurationsTable::BANNER_LARGE_POSITIONS),
                        'limit' => 510,
                        'null' => true,
                    ]
                )
                ->create();
        }
    }
}
