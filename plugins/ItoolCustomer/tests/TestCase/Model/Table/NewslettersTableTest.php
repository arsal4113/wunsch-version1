<?php
namespace ItoolCustomer\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ItoolCustomer\Model\Table\NewslettersTable;

/**
 * ItoolCustomer\Model\Table\NewslettersTable Test Case
 */
class NewslettersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ItoolCustomer\Model\Table\NewslettersTable
     */
    public $Newsletters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.itool_customer.newsletters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Newsletters') ? [] : ['className' => NewslettersTable::class];
        $this->Newsletters = TableRegistry::get('Newsletters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Newsletters);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
