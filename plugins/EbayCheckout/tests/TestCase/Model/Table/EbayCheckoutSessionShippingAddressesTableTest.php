<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionShippingAddressesTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionShippingAddressesTable Test Case
 */
class EbayCheckoutSessionShippingAddressesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionShippingAddressesTable
     */
    public $EbayCheckoutSessionShippingAddresses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay_checkout.ebay_checkout_session_shipping_addresses',
        'plugin.ebay_checkout.ebay_checkout_sessions',
        'app.Core/core_sellers',
        'app.Core/core_orders',
        'plugin.ebay_checkout.ebay_checkouts',
        'plugin.ebay_checkout.ebay_checkout_session_payment_brands',
        'plugin.ebay_checkout.ebay_checkout_session_payments',
        'plugin.ebay_checkout.ebay_checkout_session_payment_messages',
        'plugin.ebay_checkout.ebay_checkout_session_items',
        'plugin.ebay_checkout.ebay_checkout_session_item_shippings',
        'plugin.ebay_checkout.ebay_checkout_session_item_promotions',
        'plugin.ebay_checkout.ebay_checkout_session_billing_addresses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EbayCheckoutSessionShippingAddresses') ? [] : ['className' => EbayCheckoutSessionShippingAddressesTable::class];
        $this->EbayCheckoutSessionShippingAddresses = TableRegistry::get('EbayCheckoutSessionShippingAddresses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionShippingAddresses);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $EbayCheckoutSessionShippingAddresses = $this->EbayCheckoutSessionShippingAddresses->find();
        $this->assertInstanceOf("Cake\Orm\Query", $EbayCheckoutSessionShippingAddresses);
        $result = $EbayCheckoutSessionShippingAddresses->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $EbayCheckoutSessionShippingAddresses = $this->EbayCheckoutSessionShippingAddresses->newEntity([
            'id'                                => '2',
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
        ]);
        $result = $this->EbayCheckoutSessionShippingAddresses->save($EbayCheckoutSessionShippingAddresses);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress', $result);

    }
}
