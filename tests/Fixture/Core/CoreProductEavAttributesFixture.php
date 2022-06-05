<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductEavAttributesFixture
 *
 */
class CoreProductEavAttributesFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductEavAttributes',
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
            'core_seller_id' => 1,
            'code' => 'title',
            'name' => 'Title',
            'data_type' => 'varchar',
            'is_required' => 0,
            'multiple_values' => 0,
            'sort_order'=> 1,
            'is_configurable'=> 0,
            'created' => '2015-04-16 10:27:26',
            'modified' => '2015-04-16 10:27:26'
        ],
    ];
}
