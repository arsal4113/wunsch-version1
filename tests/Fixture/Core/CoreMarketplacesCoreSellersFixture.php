<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreSellerAddressesFixture
 *
 */
class CoreMarketplacesCoreSellersFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model'      => 'CoreMarketplacesCoreSellers',
        'connection' => 'default'
    ];
    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'core_marketplace_id' => 1,
            'core_seller_id' => 1,

        ],
    ];
}
