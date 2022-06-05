<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionPaymentsTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionPaymentsTable Test Case
 */
class EbayCheckoutSessionPaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionPaymentsTable
     */
    public $EbayCheckoutSessionPayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('EbayCheckoutSessionPayments') ? [] : ['className' => EbayCheckoutSessionPaymentsTable::class];
        $this->EbayCheckoutSessionPayments = TableRegistry::get('EbayCheckoutSessionPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionPayments);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $EbayCheckoutSessionPayments = $this->EbayCheckoutSessionPayments->find();
        $this->assertInstanceOf("Cake\Orm\Query", $EbayCheckoutSessionPayments);
        $result = $EbayCheckoutSessionPayments->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $EbayCheckoutSessionPayments = $this->EbayCheckoutSessionPayments->newEntity([
            'id'                                => '2',
            'ebay_checkout_session_id'          => '1',
            'payment_method_type'               => 'WALLET',
            'label'                             => 'WALLET',
            'logo'                              => NULL,
            'additional_data'                   => NULL,
            'modified'                          => '2019-09-05 15:49:37',
            'created'                           => '2019-09-05 15:49:37'
        ]);
        $result = $this->EbayCheckoutSessionPayments->save($EbayCheckoutSessionPayments);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionPayment', $result);

    }
}
