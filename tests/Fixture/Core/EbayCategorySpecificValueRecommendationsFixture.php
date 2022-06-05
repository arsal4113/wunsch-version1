<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCategorySpecificValueRecommendationsFixture
 *
 */
class EbayCategorySpecificValueRecommendationsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCategorySpecificValueRecommendations',
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
            'ebay_site_id' => 1,
            'ebay_attribute_value_name' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-02-08 12:58:53',
            'modified' => '2016-02-08 12:58:53'
        ],
    ];
}
