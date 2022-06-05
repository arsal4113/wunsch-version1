<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederGuidesTable;

/**
 * Feeder\Model\Table\FeederGuidesTable Test Case
 */
class FeederGuidesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederGuidesTable
     */
    public $FeederGuides;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Feeder.FeederGuides',
        'plugin.Feeder.FeederCategories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeederGuides') ? [] : ['className' => FeederGuidesTable::class];
        $this->FeederGuides = TableRegistry::getTableLocator()->get('FeederGuides', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederGuides);

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
