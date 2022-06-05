<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreConfigurationsFixture
 *
 */
class CoreConfigurationsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CoreConfigurations',
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
            'configuration_path' => 'www.ebay.com/test/config',
            'configuration_value' => 'config_value',
            'created' => '2015-04-10 12:09:21',
            'modified' => '2015-04-10 12:09:21'
        ],
    ];
}
