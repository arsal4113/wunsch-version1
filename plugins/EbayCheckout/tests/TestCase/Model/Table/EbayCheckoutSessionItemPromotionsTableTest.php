<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionItemPromotionsTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionItemPromotionsTable Test Case
 */
class EbayCheckoutSessionItemPromotionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionItemPromotionsTable
     */
    public $EbayCheckoutSessionItemPromotions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay_checkout.ebay_checkout_session_item_promotions',
        'plugin.ebay_checkout.ebay_checkout_session_items',
        'plugin.ebay_checkout.ebay_checkout_sessions',
        'app.Core/core_sellers',
        'app.Core/core_orders',
        'plugin.ebay_checkout.ebay_checkouts',
        'plugin.ebay_checkout.ebay_checkout_session_payments',
        'plugin.ebay_checkout.ebay_checkout_session_billing_addresses',
        'plugin.ebay_checkout.ebay_checkout_session_shipping_addresses',
        'plugin.ebay_checkout.ebay_checkout_session_item_shippings',
    ];
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EbayCheckoutSessionItemPromotions') ? [] : ['className' => EbayCheckoutSessionItemPromotionsTable::class];
        $this->EbayCheckoutSessionItemPromotions = TableRegistry::get('EbayCheckoutSessionItemPromotions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionItemPromotions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $EbayCheckoutSessionItemPromotions = $this->EbayCheckoutSessionItemPromotions->find();
        $this->assertInstanceOf("Cake\Orm\Query", $EbayCheckoutSessionItemPromotions);
        $result = $EbayCheckoutSessionItemPromotions->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $EbayCheckoutSessionItemPromotions = $this->EbayCheckoutSessionItemPromotions->newEntity([
            'id' => 2,
            'ebay_checkout_session_item_id' => 1,
            'discount_currency' => 'EUR',
            'discount_value' => 1.5,
            'message' => 'EID Discount',
            'promotion_code' => '1A2S3D',
            'promotion_type' => 'Double',
            'modified' => '2017-10-25 17:03:11',
            'created' => '2017-10-25 17:03:11'
        ]);
        $result = $this->EbayCheckoutSessionItemPromotions->save($EbayCheckoutSessionItemPromotions);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionItemPromotion', $result);

    }
}
