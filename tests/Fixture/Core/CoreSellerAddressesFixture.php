<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreSellerAddressesFixture
 *
 */
class CoreSellerAddressesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model'      => 'CoreSellerAddresses',
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
            'core_seller_id' => 1,
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'street_name' => 'Lorem ipsum dolor sit amet',
            'street_number' => 'Lorem ip',
            'city' => 'Lorem ipsum dolor sit amet',
            'zip_code' => 1,
            'phone_number' => 'Lorem ipsum dolor sit amet',
            'company_name' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-09-20 13:59:52',
            'modified' => '2016-09-20 13:59:52'
        ],
    ];
}
