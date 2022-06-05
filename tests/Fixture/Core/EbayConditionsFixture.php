<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayConditionsFixture
 *
 */
class EbayConditionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayConditions',
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
            'name' => 'Lorem ipsum dolor sit amet',
            'ebay_code' => 'Lorem ipsum dolor sit amet',
            'ebay_id' => 1,
            'created' => '2016-02-08 13:06:26',
            'modified' => '2016-02-08 13:06:26'
        ],
    ];
}
