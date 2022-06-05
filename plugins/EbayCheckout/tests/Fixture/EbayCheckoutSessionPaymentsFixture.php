<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionPaymentsFixture
 *
 */
class EbayCheckoutSessionPaymentsFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessionPayments',
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
            'id'                                => '1',
            'ebay_checkout_session_id'          => '1',
            'payment_method_type'               => 'WALLET',
            'label'                             => 'WALLET',
            'logo'                              => NULL,
            'additional_data'                   => NULL,
            'modified'                          => '2019-09-05 15:49:37',
            'created'                           => '2019-09-05 15:49:37'
            ],
        ];
        parent::init();
    }
}
