<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCategorySpecificValueRecommendationsFixture
 *
 */
class EbayCategorySpecificToValueRecommendationsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCategorySpecificToValueRecommendations',
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
            'ebay_category_specific_id' => 1,
            'ebay_category_specific_value_recommendation_id' => 1,
            'created' => '2016-02-08 12:58:53',
            'modified' => '2016-02-08 12:58:53'
        ],
    ];
}
