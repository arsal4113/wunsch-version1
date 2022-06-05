<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCategoryMappingsFixture
 *
 */
class EbayCategoryMappingsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCategoryMappings',
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
            'core_seller_id' => 1,
            'core_category_id' => 1,
            'ebay_category_id' => 1,
            'created' => '2016-02-08 12:39:38',
            'modified' => '2016-02-08 12:39:38'
        ],
    ];
}
