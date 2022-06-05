<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionPaymentMessagesFixture
 *
 */
class EbayCheckoutSessionPaymentMessagesFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessionPaymentMessages',
        'connection' => 'default'
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
            'id' => 1,
            'ebay_checkout_session_payment_id' => 1,
            'legal_message' => 'Your payment was approved',
            'required_for_user_confirmation' => 1,
            'modified' => '2017-10-25 17:03:49',
            'created' => '2017-10-25 17:03:49'
            ],
        ];
        parent::init();
    }
}
