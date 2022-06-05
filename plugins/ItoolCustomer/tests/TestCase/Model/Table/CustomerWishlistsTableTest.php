<?php
namespace ItoolCustomer\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ItoolCustomer\Model\Table\CustomerWishlistItemssTable;

/**
 * ItoolCustomer\Model\Table\CustomerWishlistItemssTable Test Case
 */
class CustomerWishlistsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ItoolCustomer\Model\Table\CustomerWishlistItemssTable
     */
    public $CustomerWishlists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.itool_customer.customer_wishlists',
        'plugin.itool_customer.customers',
        'plugin.itool_customer.ebay_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomerWishlists') ? [] : ['className' => CustomerWishlistItemssTable::class];
        $this->CustomerWishlists = TableRegistry::get('CustomerWishlists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerWishlists);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
