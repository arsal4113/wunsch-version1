<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomersFeederInterestSubcategoriesFixture
 */
class CustomersFeederInterestSubcategoriesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'table' => 'customers_feeder_interest_subcategories',
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
                'feeder_interest_subcategory_id' => 1,
                'feeder_interest_id' => 1,
            ],
        ];
        parent::init();
    }
}
