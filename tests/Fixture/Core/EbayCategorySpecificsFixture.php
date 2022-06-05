<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCategorySpecificsFixture
 *
 */
class EbayCategorySpecificsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCategorySpecifics',
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
            'ebay_category_id' => 1,
            'ebay_attribute_name' => 'Lorem ipsum dolor sit amet',
            'ebay_value_type' => 'Lorem ipsum dolor sit amet',
            'ebay_min_values' => 1,
            'ebay_max_values' => 1,
            'ebay_selection_mode' => 'Lorem ipsum dolor sit amet',
            'ebay_variation_specifics' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-07-17 12:29:08',
            'modified' => '2015-07-17 12:29:08'
        ],
    ];
}
