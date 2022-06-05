<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreOrderCancellationsFixture
 *
 */
class CoreOrderCancellationsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CoreOrderCancellations',
        'connection' => 'default'
    ];

    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public function init()
    {
        $this->records = [
//            [
//            'id' => 1,
//            'core_order_id' => 1,
//            'core_order_product_id' => 1,
//            'quantity' => 1,
//            'cancel_date' => '2015-04-23 14:03:13',
//            'cancel_reason_code' => 'Lorem ipsum dolor sit amet',
//            'cancel_reason_name' => 'Lorem ipsum dolor sit amet',
//            'comment' => 'Lorem ipsum dolor sit amet',
//            'created' => '2015-04-23 14:03:13',
//            'modified' => '2015-04-23 14:03:13'
//            ],
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }
}