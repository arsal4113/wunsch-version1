<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederHomepageMidpageContainersTable;

/**
 * Feeder\Model\Table\FeederHomepageMidpageContainersTable Test Case
 */
class FeederHomepageMidpageContainersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederHomepageMidpageContainersTable
     */
    public $FeederHomepageMidpageContainers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.feeder.feeder_homepage_midpage_containers',
        'plugin.feeder.feeder_homepages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FeederHomepageMidpageContainers') ? [] : ['className' => FeederHomepageMidpageContainersTable::class];
        $this->FeederHomepageMidpageContainers = TableRegistry::get('FeederHomepageMidpageContainers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederHomepageMidpageContainers);

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
