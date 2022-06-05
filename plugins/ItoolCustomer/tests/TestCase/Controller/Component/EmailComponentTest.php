<?php
namespace ItoolCustomer\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use ItoolCustomer\Controller\Component\EmailComponent;

/**
 * ItoolCustomer\Controller\Component\EmailComponent Test Case
 */
class EmailComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ItoolCustomer\Controller\Component\EmailComponent
     */
    public $Email;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Email = new EmailComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Email);

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
