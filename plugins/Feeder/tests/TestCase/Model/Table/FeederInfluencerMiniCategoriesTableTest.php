<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederInfluencerMiniCategoriesTable;

/**
 * Feeder\Model\Table\FeederInfluencerMiniCategoriesTable Test Case
 */
class FeederInfluencerMiniCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederInfluencerMiniCategoriesTable
     */
    public $FeederInfluencerMiniCategories;

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
        $config = TableRegistry::getTableLocator()->exists('FeederInfluencerMiniCategories') ? [] : ['className' => FeederInfluencerMiniCategoriesTable::class];
        $this->FeederInfluencerMiniCategories = TableRegistry::getTableLocator()->get('FeederInfluencerMiniCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederInfluencerMiniCategories);

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
