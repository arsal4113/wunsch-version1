<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionBillingAddressesTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionBillingAddressesTable Test Case
 */
class EbayCheckoutSessionBillingAddressesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionBillingAddressesTable
     */
    public $EbayCheckoutSessionBillingAddresses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay_checkout.ebay_checkout_session_billing_addresses',
        'plugin.ebay_checkout.ebay_checkout_sessions',
        'app.Core/core_sellers',
        'app.Core/core_orders',
        'plugin.ebay_checkout.ebay_checkouts',
        'plugin.ebay_checkout.ebay_checkout_session_payments',
        'plugin.ebay_checkout.ebay_checkout_session_items',
        'plugin.ebay_checkout.ebay_checkout_session_item_shippings',
        'plugin.ebay_checkout.ebay_checkout_session_shipping_addresses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EbayCheckoutSessionBillingAddresses') ? [] : ['className' => EbayCheckoutSessionBillingAddressesTable::class];
        $this->EbayCheckoutSessionBillingAddresses = TableRegistry::get('EbayCheckoutSessionBillingAddresses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionBillingAddresses);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $EbayCheckoutSessionBillingAddresses = $this->EbayCheckoutSessionBillingAddresses->find();
        $this->assertInstanceOf("Cake\Orm\Query", $EbayCheckoutSessionBillingAddresses);
        $result = $EbayCheckoutSessionBillingAddresses->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $EbayCheckoutSessionBillingAddresses = $this->EbayCheckoutSessionBillingAddresses->newEntity([
                'id'                                => '2',
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
        ]);
        $result = $this->EbayCheckoutSessionBillingAddresses->save($EbayCheckoutSessionBillingAddresses);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress', $result);

    }
}
