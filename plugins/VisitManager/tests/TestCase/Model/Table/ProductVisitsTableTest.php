<?php
namespace VisitManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use VisitManager\Model\Table\ProductVisitsTable;

/**
 * VisitManager\Model\Table\ProductVisitsTable Test Case
 */
class ProductVisitsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \VisitManager\Model\Table\ProductVisitsTable
     */
    public $ProductVisits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.visit_manager.product_visits'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProductVisits') ? [] : ['className' => ProductVisitsTable::class];
        $this->ProductVisits = TableRegistry::get('ProductVisits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductVisits);

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
