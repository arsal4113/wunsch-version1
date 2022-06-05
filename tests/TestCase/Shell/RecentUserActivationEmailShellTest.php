<?php
namespace App\Test\TestCase\Shell;

use App\Shell\RecentUserActivationEmailShell;
use Cake\Core\Configure;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\RecentUserActivationEmailShell Test Case
 */
class RecentUserActivationEmailShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    public $fixtures = [
        'app.Core/CoreSellers',
        'app.Core/CoreLanguages',
        'app.Core/CoreUsers',
        'app.Core/CoreSellerTypes',
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
     * @var \App\Shell\RecentUserActivationEmailShell
     */
    public $RecentUserActivationEmail;

    public static function setUpBeforeClass()
    {
        Configure::write('Acl.database', 'test');
        Configure::write('Acl.classname', 'DbAcl');
    }

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->RecentUserActivationEmail = new RecentUserActivationEmailShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RecentUserActivationEmail);

        parent::tearDown();
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->exec('recent_user_activation_email de');
        $this->assertEquals([], $this->_out->messages());
    }
}
