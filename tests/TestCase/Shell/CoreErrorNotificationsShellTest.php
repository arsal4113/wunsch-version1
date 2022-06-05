<?php
namespace App\Test\TestCase\Shell;

use App\Shell\CoreErrorNotificationsShell;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\CoreErrorNotificationsShell Test Case
 */
class CoreErrorNotificationsShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    public $fixtures = [
        'app.Core/CoreErrorNotificationProfiles',
        'app.Core/CoreErrors',
    ];

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \App\Shell\CoreErrorNotificationsShell
     */
    public $CoreErrorNotifications;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->CoreErrorNotifications = new CoreErrorNotificationsShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoreErrorNotifications);

        parent::tearDown();
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        /*$result = $this->CoreErrorNotifications->main();
        $this->assertEquals([], $result);*/
        $this->exec('core_error_notifications');
        $this->assertEquals([], $this->_out->messages());
    }
}
