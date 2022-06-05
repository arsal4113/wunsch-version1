<?php

use Migrations\AbstractMigration;

class CreateFeederCategoriesTable extends AbstractMigration
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
        $this->table('feeder_categories')
            ->addColumn('parent_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('lft', 'integer', [
                'limit' => 11,
                'signed' => true,
            ])
            ->addColumn('rght', 'integer', [
                'limit' => 11,
                'signed' => true,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('ebay_category_id', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('gtin', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('keywords', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('seller_account_type', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('listing_type', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('items_condition', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('include_seller', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true,
            ])
            ->addColumn('exclude_seller', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true,
            ])
            ->addColumn('country', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('qty', 'integer', [
                'default' => 18,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('min_price', 'decimal', [
                'default' => null,
                'precision' => 10,
                'scale' => 4,
                'null' => true,
            ])
            ->addColumn('max_price', 'decimal', [
                'default' => null,
                'precision' => 10,
                'scale' => 4,
                'null' => true,
            ])
            ->addColumn('sort_order', 'integer', [
                'default' => 0,
                'limit' => 11,
            ])->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'parent_id',
                ]
            )
            ->create();
    }
}
