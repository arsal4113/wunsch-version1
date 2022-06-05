<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederCategoriesVideoElementsTable;

/**
 * Feeder\Model\Table\FeederCategoriesVideoElementsTable Test Case
 */
class FeederCategoriesVideoElementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederCategoriesVideoElementsTable
     */
    public $FeederCategoriesVideoElements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Feeder.FeederCategoriesVideoElements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeederCategoriesVideoElements') ? [] : ['className' => FeederCategoriesVideoElementsTable::class];
        $this->FeederCategoriesVideoElements = TableRegistry::getTableLocator()->get('FeederCategoriesVideoElements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederCategoriesVideoElements);

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
