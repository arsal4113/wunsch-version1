<?php
namespace ItoolCustomer\Test\TestCase\Shell;

use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;
use ItoolCustomer\Shell\SubscribeRegisteredCustomersToNewsletterShell;

/**
 * ItoolCustomer\Shell\SubscribeRegisteredCustomersToNewsletterShell Test Case
 */
class SubscribeRegisteredCustomersToNewsletterShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \ItoolCustomer\Shell\SubscribeRegisteredCustomersToNewsletterShell
     */
    public $SubscribeRegisteredCustomersToNewsletter;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->SubscribeRegisteredCustomersToNewsletter = new SubscribeRegisteredCustomersToNewsletterShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubscribeRegisteredCustomersToNewsletter);

        parent::tearDown();
    }

    /**
     * Test getOptionParser method
     *
     * @return void
     */
    public function testGetOptionParser()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
