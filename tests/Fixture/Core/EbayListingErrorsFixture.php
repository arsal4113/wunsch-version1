<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayListingErrorsFixture
 *
 */
class EbayListingErrorsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayListingErrors',
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
            'action' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'message' => 'Lorem ipsum dolor sit amet',
            'code' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-08-21 11:15:20',
            'modified' => '2015-08-21 11:15:20'
        ],
    ];
}
