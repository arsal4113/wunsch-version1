<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionShippingAddressesFixture
 *
 */
class EbayCheckoutSessionShippingAddressesFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessionShippingAddresses',
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
            'id'                                => '1',
            'ebay_checkout_session_id'          => '1',
            'recipient'                         => 'fdgfdg dfdsfsdfdsf',
            'address_line_1'                    => 'fdgfdg',
            'address_line_2'                    => '',
            'city'                              => 'sdfdsfdsf',
            'country'                           => 'DE',
            'phone_number'                      => '34234324234',
            'random_phone_number'               => '0',
            'postal_code'                       => '234234',
            'state_or_province'                 => 'sdfdsf',
            'modified'                          => '2019-09-05 17:04:53',
            'created'                           => '2019-09-05 15:22:22'
            ],
        ];
        parent::init();
    }
}
