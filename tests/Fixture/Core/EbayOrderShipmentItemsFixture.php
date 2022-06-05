<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayOrderShipmentItemsFixture
 *
 */
class EbayOrderShipmentItemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayOrderShipmentItems',
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
            'ebay_order_shipment_id' => 1,
            'core_order_shipment_item_id' => 1,
            'created' => '2015-11-23 14:09:09',
            'modified' => '2015-11-23 14:09:09'
        ],
    ];
}
