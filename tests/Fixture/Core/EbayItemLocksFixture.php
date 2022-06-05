<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayItemLocksFixture
 *
 */
class EbayItemLocksFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayItemLocks',
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
            'core_seller_id' => 1,
            'ebay_item' => 'Lorem ipsum dolor ',
            'ebay_account_id' => 1,
            'core_marketplace_id' => 1,
            'lock_until' => '2017-02-24 16:19:09'
        ],
    ];
}
