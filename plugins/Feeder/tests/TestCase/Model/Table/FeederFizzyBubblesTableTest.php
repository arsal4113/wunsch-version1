<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederFizzyBubblesTable;

/**
 * Feeder\Model\Table\FeederFizzyBubblesTable Test Case
 */
class FeederFizzyBubblesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederFizzyBubblesTable
     */
    public $FeederFizzyBubbles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.feeder.feeder_fizzy_bubbles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FeederFizzyBubbles') ? [] : ['className' => FeederFizzyBubblesTable::class];
        $this->FeederFizzyBubbles = TableRegistry::get('FeederFizzyBubbles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederFizzyBubbles);

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
