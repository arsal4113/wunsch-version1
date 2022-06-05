<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederInterestSubcategoriesFixture
 *
 */
class FeederInterestSubcategoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'table' => 'feeder_interest_subcategories',
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
                'name' => 'Lorem ipsum dolor sit amet',
                'type' => 'Lorem ipsum dolor sit amet',
                'ids' => 'Lorem ipsum dolor sit amet',
                'sale_only' => 1,
            ],
        ];
        parent::init();
    }
}
