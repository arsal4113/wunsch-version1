<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreConfigurationsFixture
 *
 */
class CoreConfigurableAttributesFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'CoreConfigurableAttributes',
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
            'configuration_group' => 'ConfigGroup',
            'configuration_path' => 'config_path',
            'configuration_value' => 'config_value',
            'created' => '2015-04-10 12:09:21',
            'modified' => '2015-04-10 12:09:21'
        ],
    ];
}
