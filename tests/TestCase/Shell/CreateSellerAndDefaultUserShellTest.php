<?php
namespace App\Test\TestCase\Shell;

use App\Shell\CreateSellerAndDefaultUserShell;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\CreateSellerAndDefaultUserShell Test Case
 */
class CreateSellerAndDefaultUserShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    public $fixtures = [
        'app.Core/CoreUsers',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreCountries',
        'app.Core/CoreUserRolesCoreUsers',
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
     * @var \App\Shell\CreateSellerAndDefaultUserShell
     */
    public $CreateSellerAndDefaultUser;

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
        Cache::drop('api_user');
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->CreateSellerAndDefaultUser = new CreateSellerAndDefaultUserShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CreateSellerAndDefaultUser);

        parent::tearDown();
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->exec('create_seller_and_default_user test1 de DE test1@test.com test');
        $this->assertContains(__('Seller & default user has been created'), $this->_out->messages());
    }

    public function testMainUserFail()
    {
        $this->exec('create_seller_and_default_user test1 de DE test@i-ways.net test');
        $this->assertContains(__("given user's e-mail already exists"), $this->_out->messages());
    }

    public function testMainSellerFail()
    {
        $this->exec('create_seller_and_default_user admin de DE test1@test.com test');
        $this->assertContains(__("given user's e-mail already exists"), $this->_out->messages());
    }

}
