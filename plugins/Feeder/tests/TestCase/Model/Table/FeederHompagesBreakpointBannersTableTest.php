<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederHompagesBreakpointBannersTable;

/**
 * Feeder\Model\Table\FeederHompagesBreakpointBannersTable Test Case
 */
class FeederHompagesBreakpointBannersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederHompagesBreakpointBannersTable
     */
    public $FeederHompagesBreakpointBanners;

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
        $config = TableRegistry::exists('FeederHompagesBreakpointBanners') ? [] : ['className' => FeederHompagesBreakpointBannersTable::class];
        $this->FeederHompagesBreakpointBanners = TableRegistry::get('FeederHompagesBreakpointBanners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederHompagesBreakpointBanners);

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
