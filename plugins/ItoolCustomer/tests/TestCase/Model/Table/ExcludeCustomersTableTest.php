<?php
namespace ItoolCustomer\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ItoolCustomer\Model\Table\ExcludeCustomersTable;

/**
 * ItoolCustomer\Model\Table\ExcludeCustomersTable Test Case
 */
class ExcludeCustomersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \ItoolCustomer\Model\Table\ExcludeCustomersTable
     */
    public $ExcludeCustomers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ItoolCustomer.ExcludeCustomers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ExcludeCustomers') ? [] : ['className' => ExcludeCustomersTable::class];
        $this->ExcludeCustomers = TableRegistry::getTableLocator()->get('ExcludeCustomers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExcludeCustomers);

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
