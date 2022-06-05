<?php

namespace EbayCheckout\Test\Fixture;

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
            [
                'id'                                                    => '1',
                'core_seller_id'                                        => '2',
                'core_order_id'                                         => NULL,
                'purchase_order_id'                                     => '1234',
                'purchase_order_timestamp'                              => NULL,
                'order_payment_status'                                  => NULL,
                'ebay_checkout_id'                                      => '1',
                'customer_id'                                           => NULL,
                'selected_ebay_checkout_session_payment_id'             => '1',
                'type'                                                  => 'guest',
                'redemption_code'                                       => '24',
                'marketing_consent'                                     => '0',
                'session_token' => '9635cb8c83bc8f5ddfca284cfdbe6129f7ea07b836def3869531727356314e435275f09130073d78bd4b3a3c091ea5337a5e',
                'ebay_checkout_session_id'                              => 'v1|100013728524170|2Q-cgQrKSSy',
                'email'                                                 => 'asd@asdads.de',
                'first_name'                                            => 'fdgfdg',
                'last_name'                                             => 'dfdsfsdfdsf',
                'ip'                                                    => NULL,
                'form_key'                                              => '3d92161d3be2c65a7169bc1a98ad3d',
                'country_code'                                          => 'de',
                'ebay_global_id'                                        => 'EBAY-DE',
                'ebay_app_id'                                           => NULL,
                'ebay_epn_reference_id'                                 => NULL,
                'ebay_epn_campaign_id'                                  => NULL,
                'utm_source'                                            => NULL,
                'utm_medium'                                            => NULL,
                'utm_campaign'                                          => NULL,
                'utm_content'                                           => NULL,
                'payment_initiated'                                     => '1',
                'wrapper_layout'                                        => NULL,
                'correlation_id'                                        => NULL,
                'widget_type'                                           => NULL,
                'modified'                                              => '2019-09-05 17:04:55',
                'created'                                               => '2019-09-05 15:21:43'
            ],
        ];
        parent::init();
    }
}
