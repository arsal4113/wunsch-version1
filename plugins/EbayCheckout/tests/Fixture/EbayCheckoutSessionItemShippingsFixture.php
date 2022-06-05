<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionItemShippingsFixture
 *
 */
class EbayCheckoutSessionItemShippingsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessionItemShippings',
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
            'id' => '1',
            'ebay_checkout_session_item_id' => '1',
            'base_delivery_cost_currency' => 'EUR',
            'base_delivery_cost_value' => '0.0000',
            'additional_unit_cost_value' => NULL,
            'additional_unit_cost_currency' => NULL,
            'delivery_discount_currency' => NULL,
            'delivery_discount_value' => NULL,
            'max_estimated_delivery_date' => '2019-11-20 09:00:00',
            'min_estimated_delivery_date' => '2019-10-07 09:00:00',
            'selected' => NULL,
            'shipping_carrier_code' => NULL,
            'shipping_option_id' => '420007',
            'shipping_service_code' => 'Sparversand aus dem Ausland',
            'modified' => '2019-09-05 17:04:53',
            'created' => '2019-09-05 17:04:53'
            ],
        ];
        parent::init();
    }
}
