<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomerAddressesFixture
 */
class CustomerAddressesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CustomerAddresses',
        'connection' => 'default'
    ];

    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'customer_id' => 1,
                'core_country_id' => 1,
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'street_line_1' => 'Lorem ipsum dolor sit amet',
                'street_line_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'state' => 'Lorem ipsum dolor sit amet',
                'postal_code' => 16072,
                'phone_number' => 1607202943,
                'created' => '2020-12-05 22:15:43',
                'modified' => '2020-12-05 22:15:43',
            ],
        ];
        parent::init();
    }
}
