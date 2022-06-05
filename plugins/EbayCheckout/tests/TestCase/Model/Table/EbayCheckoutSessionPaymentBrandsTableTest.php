<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionPaymentBrandsTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionPaymentBrandsTable Test Case
 */
class EbayCheckoutSessionPaymentBrandsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionPaymentBrandsTable
     */
    public $EbayCheckoutSessionPaymentBrands;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay_checkout.ebay_checkout_session_payment_brands',
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
        $config = TableRegistry::exists('EbayCheckoutSessionPaymentBrands') ? [] : ['className' => EbayCheckoutSessionPaymentBrandsTable::class];
        $this->EbayCheckoutSessionPaymentBrands = TableRegistry::get('EbayCheckoutSessionPaymentBrands', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionPaymentBrands);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $EbayCheckoutSessionPaymentBrands = $this->EbayCheckoutSessionPaymentBrands->find();
        $this->assertInstanceOf("Cake\Orm\Query", $EbayCheckoutSessionPaymentBrands);
        $result = $EbayCheckoutSessionPaymentBrands->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $EbayCheckoutSessionPaymentBrands = $this->EbayCheckoutSessionPaymentBrands->newEntity([
                'id' => 2,
                'ebay_checkout_session_payment_id' => 1,
                'payment_method_brand_type' => 'Lorem ipsum dolor sit amet',
                'image' => 'Lorem ipsum dolor sit amet',
                'modified' => '2017-10-25 17:03:43',
                'created' => '2017-10-25 17:03:43'
        ]);
        $result = $this->EbayCheckoutSessionPaymentBrands->save($EbayCheckoutSessionPaymentBrands);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentBrand', $result);

    }
}
