<?php
namespace EbayCheckout\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use EbayCheckout\Controller\Component\CheckoutSessionsFileComponent;

/**
 * EbayCheckout\Controller\Component\CheckoutSessionsFileComponent Test Case
 */
class SaveSessionsToFileComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EbayCheckout\Controller\Component\CheckoutSessionsFileComponent
     */
    public $SaveSessionsToFile;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->SaveSessionsToFile = new CheckoutSessionsFileComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SaveSessionsToFile);

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
