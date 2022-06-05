<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayOrderShipmentsFixture
 *
 */
class EbayOrderShipmentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayOrderShipments',
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
            'core_order_id' => 1,
            'core_order_shipment_id' => 1,
            'ebay_identifier' => 'Lorem ipsum dolor sit amet',
            'message' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
