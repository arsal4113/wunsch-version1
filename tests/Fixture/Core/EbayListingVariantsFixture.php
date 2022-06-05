<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayListingVariantsFixture
 *
 */
class EbayListingVariantsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayListingVariants',
        'connection' => 'default'
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'ebay_listing_id' => 1,
            'sku' => 'sku',
            'current_price' => 20.45,
            'quantity' => 1,
            'created' => '2015-08-21 14:42:01',
            'modified' => '2015-08-21 14:42:01'
        ],
    ];
}
