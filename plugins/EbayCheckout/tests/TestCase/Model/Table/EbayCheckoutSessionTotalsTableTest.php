<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionTotalsTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionTotalsTable Test Case
 */
class EbayCheckoutSessionTotalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionTotalsTable
     */
    public $EbayCheckoutSessionTotals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay_checkout.ebay_checkout_session_totals',
        'plugin.ebay_checkout.ebay_checkout_sessions',
        'app.Core/core_sellers',
        'app.Core/core_orders',
        'plugin.ebay_checkout.ebay_checkouts',
        'plugin.ebay_checkout.ebay_checkout_session_payment_brands',
        'plugin.ebay_checkout.ebay_checkout_session_payments',
        'plugin.ebay_checkout.ebay_checkout_session_payment_messages',
        'plugin.ebay_checkout.ebay_checkout_session_billing_addresses',
        'plugin.ebay_checkout.ebay_checkout_session_items',
        'plugin.ebay_checkout.ebay_checkout_session_item_promotions',
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
        $config = TableRegistry::exists('EbayCheckoutSessionTotals') ? [] : ['className' => EbayCheckoutSessionTotalsTable::class];
        $this->EbayCheckoutSessionTotals = TableRegistry::get('EbayCheckoutSessionTotals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionTotals);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $ebayCheckoutSessionTotals = $this->EbayCheckoutSessionTotals->find();
        $this->assertInstanceOf("Cake\Orm\Query", $ebayCheckoutSessionTotals);
        $result = $ebayCheckoutSessionTotals->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $ebayCheckoutSessionTotals = $this->EbayCheckoutSessionTotals->newEntity([
                'id' => 2,
                'ebay_checkout_session_id' => 1,
                'code' => 'priceSubtotal',
                'label' => 'Lorem ipsum dolor sit amet',
                'currency' => 'EUR',
                'value' => 1.83,
                'sort_order' => 0,
                'modified' => '2017-11-13 17:49:44',
                'created' => '2017-11-13 17:49:44'
        ]);
        $result = $this->EbayCheckoutSessionTotals->save($ebayCheckoutSessionTotals);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionTotal', $result);

    }
}
