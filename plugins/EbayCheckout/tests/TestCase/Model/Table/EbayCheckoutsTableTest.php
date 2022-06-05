<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutsTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutsTable Test Case
 */
class EbayCheckoutsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutsTable
     */
    public $EbayCheckouts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay_checkout.ebay_checkouts',
        'app.Core/core_sellers',
        'plugin.ebay_checkout.ebay_checkout_sessions',
        'app.Core/core_orders',
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
        $config = TableRegistry::exists('EbayCheckouts') ? [] : ['className' => EbayCheckoutsTable::class];
        $this->EbayCheckouts = TableRegistry::get('EbayCheckouts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckouts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $ebayCheckouts = $this->EbayCheckouts->find();
        $this->assertInstanceOf("Cake\Orm\Query", $ebayCheckouts);
        $result = $ebayCheckouts->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $ebayCheckouts = $this->EbayCheckouts->newEntity([
            'id'                        => '2',
            'core_seller_id'            => '1',
            'name'                      => NULL,
            'title'                     => NULL,
            'x_frame_origins'           => NULL,
            'logo'                      => NULL,
            'main_color'                => NULL,
            'second_color'              => NULL,
            'font'                      => NULL,
            'font_color'                => NULL,
            'background_image'          => NULL,
            'background_image_position' => NULL,
            'background_color'          => NULL,
            'modified'                  => '2019-09-05 13:21:17',
            'created'                   => '2019-09-05 13:21:17'
        ]);
        $result = $this->EbayCheckouts->save($ebayCheckouts);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckout', $result);

    }
}
