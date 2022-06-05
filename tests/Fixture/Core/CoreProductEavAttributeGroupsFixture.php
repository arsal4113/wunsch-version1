<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductEavAttributeGroupsFixture
 *
 */
class CoreProductEavAttributeGroupsFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductEavAttributeGroups',
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
            'core_product_eav_attribute_set_id' => 1,
            'code' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'created' => '2015-07-08 13:11:16',
            'modified' => '2015-07-08 13:11:16'
        ],
    ];
}
