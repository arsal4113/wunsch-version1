<?php
namespace App\Test\TestCase\Shell;

use App\Shell\SuperUserShell;
use Cake\Core\Configure;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\SuperUserShell Test Case
 */
class SuperUserShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    public $fixtures = [
        'app.Core/CoreUsers',
        'app.Core/EbayAccounts',
        'app.Core/EbayCredentials',
        'app.Core/EbayAccountTypes',
        'app.EbayRestApiAccessTokens',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
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
     * @var \App\Shell\SuperUserShell
     */
    public $SuperUser;

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
        $this->SuperUser = new SuperUserShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SuperUser);

        parent::tearDown();
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->exec('super_user show test@test.com');
        $this->assertEquals([], $this->_out->messages());

        $this->exec('super_user make test@test.com');
        $this->assertEquals([], $this->_out->messages());

        $this->exec('super_user make test@i-ways.net');
        $this->assertEquals([], $this->_out->messages());
    }

}
