<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederQuizResultsTable;

/**
 * Feeder\Model\Table\FeederQuizResultsTable Test Case
 */
class FeederQuizResultsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederQuizResultsTable
     */
    public $FeederQuizResults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeederQuizResults') ? [] : ['className' => FeederQuizResultsTable::class];
        $this->FeederQuizResults = TableRegistry::getTableLocator()->get('FeederQuizResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederQuizResults);

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
