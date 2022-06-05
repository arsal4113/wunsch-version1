<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionItemShippingsTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionItemShippingsTable Test Case
 */
class EbayCheckoutSessionItemShippingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionItemShippingsTable
     */
    public $EbayCheckoutSessionItemShippings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay_checkout.ebay_checkout_session_item_shippings',
        'plugin.ebay_checkout.ebay_checkout_session_items',
        'plugin.ebay_checkout.ebay_checkout_sessions',
        'app.Core/core_sellers',
        'app.Core/core_orders',
        'plugin.ebay_checkout.ebay_checkouts',
        'plugin.ebay_checkout.ebay_checkout_session_payments',
        'plugin.ebay_checkout.ebay_checkout_session_billing_addresses',
        'plugin.ebay_checkout.ebay_checkout_session_shipping_addresses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EbayCheckoutSessionItemShippings') ? [] : ['className' => EbayCheckoutSessionItemShippingsTable::class];
        $this->EbayCheckoutSessionItemShippings = TableRegistry::get('EbayCheckoutSessionItemShippings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionItemShippings);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $EbayCheckoutSessionItemShippings = $this->EbayCheckoutSessionItemShippings->find();
        $this->assertInstanceOf("Cake\Orm\Query", $EbayCheckoutSessionItemShippings);
        $result = $EbayCheckoutSessionItemShippings->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $EbayCheckoutSessionItemShippings = $this->EbayCheckoutSessionItemShippings->newEntity([
            'id' => '2',
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
        ]);
        $result = $this->EbayCheckoutSessionItemShippings->save($EbayCheckoutSessionItemShippings);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping', $result);

    }
}
