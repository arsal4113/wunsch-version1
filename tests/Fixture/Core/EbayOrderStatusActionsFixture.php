<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayOrderStatusActionsFixture
 *
 */
class EbayOrderStatusActionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayOrderStatusActions',
        'connection' => 'default'
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'core_seller_id' => 1,
            'ebay_account_id' => 1,
            'core_order_status_id' => 1,
            'core_order_state_id' => 1,
            'ebay_action_id' => 1,
            'created' => '2015-11-25 13:53:49',
            'modified' => '2015-11-25 13:53:49'
        ],
    ];
}
