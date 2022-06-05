<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionItemPromotionsFixture
 *
 */
class EbayCheckoutSessionItemPromotionsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessionItemPromotions',
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
                'ebay_checkout_session_item_id' => 1,
                'discount_currency' => 'EUR',
                'discount_value' => 1.5,
                'message' => 'EID Discount',
                'promotion_code' => '1A2S3D',
                'promotion_type' => 'Double',
                'modified' => '2017-10-25 17:03:11',
                'created' => '2017-10-25 17:03:11'
            ],
        ];
        parent::init();
    }
}
