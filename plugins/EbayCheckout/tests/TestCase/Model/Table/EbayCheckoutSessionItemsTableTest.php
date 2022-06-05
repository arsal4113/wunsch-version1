<?php
namespace EbayCheckout\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable;

/**
 * EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable Test Case
 */
class EbayCheckoutSessionItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable
     */
    public $EbayCheckoutSessionItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('EbayCheckoutSessionItems') ? [] : ['className' => EbayCheckoutSessionItemsTable::class];
        $this->EbayCheckoutSessionItems = TableRegistry::get('EbayCheckoutSessionItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCheckoutSessionItems);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $EbayCheckoutSessionItems = $this->EbayCheckoutSessionItems->find();
        $this->assertInstanceOf("Cake\Orm\Query", $EbayCheckoutSessionItems);
        $result = $EbayCheckoutSessionItems->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $EbayCheckoutSessionItems = $this->EbayCheckoutSessionItems->newEntity([
            'id'                                              => 2,
            'ebay_checkout_session_id'                        => 1,
            'selected_ebay_checkout_session_item_shipping_id' => 1,
            'title'                                           => 'Frauen Baumwollmischung Socken Avocado / Kuchen / Sushi / Apfel / Toast / D E7Z9',
            'short_description'                               => 'New with tags, #9',
            'base_price_currency'                             => 'EUR',
            'base_price_value'                                => 1.83,
            'ebay_category_path'                              => "http://ebay.com/category",
            'image'                                           => 'https://i.ebayimg.com/00/s/MTAwMVgxMDAx/z/VUgAAOSwBSxbBmaH/$_3.JPG',
            'ebay_item_id'                                    => 'v1|372315975605|641139695655',
            'ebay_line_item_id'                               => 420002,
            'net_price_currency'                              => 'EUR',
            'net_price_value'                                 => 1.83,
            'quantity'                                        => 1,
            'seller_username'                                 => 'Lorem ipsum dolor sit amet',
            'seller_account_type'                             => 'Lorem ipsum dolor sit amet',
            'seller_feedback_score'                           => 'Lorem ipsum dolor sit amet',
            'seller_feedback_percentage'                      => 'Lorem ipsum dolor sit amet',
            'modified'                                        => '2017-10-25 17:03:25',
            'created'                                         => '2017-10-25 17:03:25'
        ]);
        $result = $this->EbayCheckoutSessionItems->save($EbayCheckoutSessionItems);
        $this->assertInstanceOf('EbayCheckout\Model\Entity\EbayCheckoutSessionItem', $result);

    }
}
