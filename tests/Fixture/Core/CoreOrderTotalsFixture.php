<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreOrderTotalsFixture
 *
 */
class CoreOrderTotalsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model'      => 'CoreOrderTotals',
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
            'core_order_id' => 1,
            'code' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'value' => 12,
            'sort_order' => 1,
            'created' => '2015-11-11 11:25:33',
            'modified' => '2015-11-11 11:25:33'
        ],
    ];
}
