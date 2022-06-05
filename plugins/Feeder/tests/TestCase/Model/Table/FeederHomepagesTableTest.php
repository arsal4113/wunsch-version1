<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederHomepagesTable;

/**
 * Feeder\Model\Table\FeederHomepagesTable Test Case
 */
class FeederHomepagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederHomepagesTable
     */
    public $FeederHomepages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FeederHomepages') ? [] : ['className' => FeederHomepagesTable::class];
        $this->FeederHomepages = TableRegistry::get('FeederHomepages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederHomepages);

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
