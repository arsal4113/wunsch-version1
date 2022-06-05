<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductBatchUpdatesFixture
 *
 */
class CoreProductBatchUpdatesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model'      => 'CoreProductBatchUpdates',
        'connection' => 'default'
    ];

    public $records = [
        [
            'id' => 1,
            'core_seller_id' => 1,
            'type' => 'Lorem ipsum dolor sit amet',
            'is_processed' => 0,
            'is_running' => 1,
            'start_time' => '2016-08-16 10:55:38',
            'created' => '2016-08-16 10:55:38',
            'modified' => '2016-08-16 10:55:38'
        ],
    ];

}
