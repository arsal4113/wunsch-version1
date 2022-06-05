<?php
namespace ItoolCustomer\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ItoolCustomer\Model\Table\CustomerGendersTable;

/**
 * ItoolCustomer\Model\Table\CustomerGendersTable Test Case
 */
class CustomerGendersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ItoolCustomer\Model\Table\CustomerGendersTable
     */
    public $CustomerGenders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.itool_customer.customer_genders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomerGenders') ? [] : ['className' => CustomerGendersTable::class];
        $this->CustomerGenders = TableRegistry::get('CustomerGenders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerGenders);

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
}
