<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductUpdatesFixture
 *
 */
class CoreProductUpdatesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductUpdates',
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
            'core_product_id' => 1,
            'type' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-09-08 15:32:59',
            'modified' => '2015-09-08 15:32:59'
        ],
    ];
}
