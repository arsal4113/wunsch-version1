<?php
namespace ItoolCustomer\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ItoolCustomer\Model\Table\AccountGendersTable;

/**
 * ItoolCustomer\Model\Table\AccountGendersTable Test Case
 */
class AccountGendersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ItoolCustomer\Model\Table\AccountGendersTable
     */
    public $AccountGenders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.itool_customer.account_genders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccountGenders') ? [] : ['className' => AccountGendersTable::class];
        $this->AccountGenders = TableRegistry::get('AccountGenders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountGenders);

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
