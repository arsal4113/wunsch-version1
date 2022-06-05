<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CorePaymentMethodsFixture
 *
 */
class CorePaymentMethodsFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model'      => 'CorePaymentMethods',
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
            'code' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-02-03 14:59:15',
            'modified' => '2016-02-03 14:59:15'
        ],
    ];
}
