<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederGlobalPriceLimitTable;

/**
 * Feeder\Model\Table\FeederGlobalPriceLimitTable Test Case
 */
class FeederGlobalPriceLimitTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederGlobalPriceLimitTable
     */
    public $FeederGlobalPriceLimit;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.feeder.feeder_global_price_limit'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FeederGlobalPriceLimit') ? [] : ['className' => FeederGlobalPriceLimitTable::class];
        $this->FeederGlobalPriceLimit = TableRegistry::get('FeederGlobalPriceLimit', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederGlobalPriceLimit);

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
