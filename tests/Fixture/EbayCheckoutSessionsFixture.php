<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionsFixture
 *
 */
class EbayCheckoutSessionsFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessions',
        'connection' => 'default'
    ];    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'core_seller_id' => 1,
            'core_order_id' => 1,
            'ebay_checkout_id' => 1,
            'selected_ebay_checkout_session_payment_id' => 1,
            'type' => 'Lorem ipsum dolor sit amet',
            'session_token' => '9635cb8c83bc8f5ddfca284cfdbe6129f7ea07b836def3869531727356314e435275f09130073d78bd4b3a3c091ea5337a5e',
            'ebay_checkout_session_id' => '1',
            'email' => 'Lorem ipsum dolor sit amet',
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'modified' => '2017-10-25 17:04:17',
            'created' => '2017-10-25 17:04:17'
        ],
    ];
}
