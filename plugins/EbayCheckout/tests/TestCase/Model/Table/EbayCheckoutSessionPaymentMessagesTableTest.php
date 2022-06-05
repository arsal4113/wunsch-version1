<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionPaymentMessagesTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionPaymentMessagesTable Test Case
 */
class EbayCheckoutSessionPaymentMessagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionPaymentMessagesTable
     */
    public $EbayCheckoutSessionPaymentMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay_checkout.ebay_checkout_session_payment_messages',
        'plugin.ebay_checkout.ebay_checkout_session_payments',
        'plugin.ebay_checkout.ebay_checkout_sessions',
        'app.Core/core_sellers',
        'app.Core/core_orders',
        'plugin.ebay_checkout.ebay_checkouts',
        'plugin.ebay_checkout.ebay_checkout_session_items',
        'plugin.ebay_checkout.ebay_checkout_session_item_shippings',
        'plugin.ebay_checkout.ebay_checkout_session_item_promotions',
        'plugin.ebay_checkout.ebay_checkout_session_billing_addresses',
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
        $config = TableRegistry::exists('EbayCheckoutSessionPaymentMessages') ? [] : ['className' => EbayCheckoutSessionPaymentMessagesTable::class];
        $this->EbayCheckoutSessionPaymentMessages = TableRegistry::get('EbayCheckoutSessionPaymentMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionPaymentMessages);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $EbayCheckoutSessionPaymentMessages = $this->EbayCheckoutSessionPaymentMessages->find();
        $this->assertInstanceOf("Cake\Orm\Query", $EbayCheckoutSessionPaymentMessages);
        $result = $EbayCheckoutSessionPaymentMessages->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $EbayCheckoutSessionPaymentMessages = $this->EbayCheckoutSessionPaymentMessages->newEntity([
            'id' => 2,
            'ebay_checkout_session_payment_id' => 1,
            'legal_message' => 'Your payment was approved',
            'required_for_user_confirmation' => 1,
            'modified' => '2017-10-25 17:03:49',
            'created' => '2017-10-25 17:03:49'
        ]);
        $result = $this->EbayCheckoutSessionPaymentMessages->save($EbayCheckoutSessionPaymentMessages);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentMessage', $result);

    }
}
