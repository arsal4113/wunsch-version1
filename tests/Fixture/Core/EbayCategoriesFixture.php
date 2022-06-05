<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCategoriesFixture
 *
 */
class EbayCategoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCategories',
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
            'ebay_category_id' => 1,
            'parent_id' => 1,
            'category_level' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'version' => 1,
            'created' => '2015-07-15 10:12:00',
            'modified' => '2015-07-15 10:12:00'
        ],
    ];
}
