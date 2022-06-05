<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductQuantitiesFixture
 *
 */
class CoreProductQuantitiesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductQuantities',
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
            'quantity' => 1,
            'created' => '2015-07-06 14:32:42',
            'modified' => '2015-07-06 14:32:42'
        ],
    ];
}
