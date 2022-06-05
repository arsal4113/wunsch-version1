<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreOrderPaymentsFixture
 *
 */
class CoreOrderPaymentsFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model'      => 'CoreOrderPayments',
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
            'code' => 'hgju12',
            'name' => 'lipsum code',
            'paid_amount' => 125,
            'payment_date' => '2016-02-03 14:59:15',
            'payment_reference_code' => 'SDLFK',
            'comment' => 'testing',
            'core_order' => 1,
            'core_order_payment_refunds' => 1,
            'created' => '2016-02-03 14:59:15',
            'modified' => '2016-02-03 14:59:15'
        ],
    ];
}
