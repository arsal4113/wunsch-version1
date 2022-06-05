<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductEavAttributeGroupsCoreProductEavAttributesFixture
 *
 */
class CoreProductEavAttributeGroupsCoreProductEavAttributesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductEavAttributeGroupsCoreProductEavAttributes',
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
            'core_product_eav_attribute_set_id' => 1,
            'core_product_eav_attribute_group_id' => 1,
            'core_product_eav_attribute_id' => 1,
            'created' => '2015-07-08 15:38:56',
            'modified' => '2015-07-08 15:38:56'
        ],
    ];
}
