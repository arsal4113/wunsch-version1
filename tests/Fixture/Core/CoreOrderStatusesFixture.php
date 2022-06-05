<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreOrderStatusesFixture
 *
 */
class CoreOrderStatusesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model'      => 'CoreOrderStatuses',
        'connection' => 'default'
    ];

    public $records = [
            [
                'id' => 1,
                'core_order_state_id' => 1,
                'code' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'created' => '2015-04-23 14:01:15',
                'modified' => '2015-04-23 14:01:15'
            ],
        ];

}
