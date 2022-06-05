<?php
namespace Dashboard\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Dashboard\Controller\Component\CellCollectorComponent;

/**
 * Dashboard\Controller\Component\CellCollectorComponent Test Case
 */
class CellCollectorComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Dashboard\Controller\Component\CellCollectorComponent
     */
    public $CellCollector;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->CellCollector = new CellCollectorComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CellCollector);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
