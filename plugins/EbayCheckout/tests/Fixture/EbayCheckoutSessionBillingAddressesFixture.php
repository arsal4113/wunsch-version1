<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionBillingAddressesFixture
 *
 */
class EbayCheckoutSessionBillingAddressesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessionBillingAddresses',
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
                'first_name'                        => 'Raza',
                'last_name'                         => 'Umer',
                'address_line_1'                    => 'test',
                'address_line_2'                    => 'test',
                'city'                              => 'Lahore',
                'country'                           => 'Germany',
                'county'                            => 'test',
                'postal_code'                       => '312211',
                'state_or_province'                 => 'Berlin',
                'modified'                          => '2020-12-29 02:05:10',
                'created'                           => '2020-12-29 02:05:10'
            ],
        ];
        parent::init();
    }
}
