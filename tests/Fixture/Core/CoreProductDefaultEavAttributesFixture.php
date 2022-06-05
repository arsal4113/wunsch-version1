<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductDefaultEavAttributesFixture
 *
 */
class CoreProductDefaultEavAttributesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductDefaultEavAttributes',
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
            'core_marketplace_id' => 1,
            'code' => 'title',
            'name' => 'Title',
            'data_type' => 'varchar',
            'is_required' => 1,
            'multiple_values' => 1,
            'sort_order' => 1,
            'is_configurable' => 0,
            'created' => '2015-08-03 10:55:58',
            'modified' => '2015-08-03 10:55:58'
        ],
    ];
}
