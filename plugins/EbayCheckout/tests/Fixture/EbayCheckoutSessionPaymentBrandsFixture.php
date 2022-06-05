<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionPaymentBrandsFixture
 *
 */
class EbayCheckoutSessionPaymentBrandsFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessionPaymentBrands',
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
                'payment_method_brand_type' => 'Lorem ipsum dolor sit amet',
                'image' => 'Lorem ipsum dolor sit amet',
                'modified' => '2017-10-25 17:03:43',
                'created' => '2017-10-25 17:03:43'
            ],
        ];
        parent::init();
    }
}
