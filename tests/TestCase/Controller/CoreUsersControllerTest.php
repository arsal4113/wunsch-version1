<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreUsersController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\CoreUsersController Test Case
 */
class CoreUsersControllerTest extends IntegrationTestCase
{
        use IntegrationTestTrait;
        use GenerateCoreUserEntity;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [

        'app.Core/CoreUsers',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
        'app.Core/EbayAccounts'
    ];

    const CURRENT_URL = '/core_users';
    private $coreUser;

    public static function setUpBeforeClass()
    {
        Configure::write('Acl.database', 'test');
    }

    public function setup()
    {
        Cache::drop('api_user');
        $this->coreUser = $this->setLogin('test');
        $this->session([
            'Auth' => [
                'User' => $this->coreUser
            ]
        ]);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $resp = $this->get(self::CURRENT_URL);
        $this->assertResponseOk();
    }

    public function testAdd(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => (int)1,
                'core_seller_id' => (int)1,
                'core_language_id' => (int)1,
                'is_active' => true,
                'is_deleted' => false,
                'first_name' => 'test',
                'last_name' => 'test',
                'email' => 'test@i-ways.net',
                'password' => '12345678',
                'company_name' => null,
                'street_line_1' => null,
                'street_line_2' => null,
                'city' => null,
                'postal_code' => null,
                'phone_number' => null,
                'redirect_url' => null,
        ];
        $this->post(self::CURRENT_URL . '/add', $data);

        $this->assertResponseSuccess();
        $user = TableRegistry::getTableLocator()->get('CoreUsers');
        $query = $user->find()->where(['first_name' => $data['first_name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEdit(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => (int)1,
                'core_seller_id' => (int)1,
                'core_language_id' => (int)1,
                'is_active' => true,
                'is_deleted' => false,
                'first_name' => 'test',
                'last_name' => 'test12',
                'email' => 'test@i-ways.net',
                'password' => '',
                'company_name' => null,
                'street_line_1' => null,
                'street_line_2' => null,
                'city' => null,
                'postal_code' => null,
                'phone_number' => null,
                'redirect_url' => null,
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);

        $this->assertResponseSuccess();
        $user = TableRegistry::getTableLocator()->get('CoreUsers');
        $query = $user->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testView()
    {
        $resp = $this->get(self::CURRENT_URL . '/view/1');
        $this->assertResponseOk();
    }

    public function testDelete()
    {
        $resp = $this->get(self::CURRENT_URL . '/delete/1');
        $this->assertResponseOk();
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('CoreUsers')->get(1);
        $cancelReasons = $this->getMockForModel('CoreUsers', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }

    public function testLogin()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'email' => 'test@i-ways.net',
            'password' => '12345678'
        ];
        $this->post(self::CURRENT_URL . '/login', $data);
        $this->assertResponseSuccess();
    }

    public function testSeller()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'super_seller_id' => 1
        ];
        $this->post(self::CURRENT_URL . '/set_super_seller_id', $data);
        $this->assertResponseSuccess();
    }

    public function testLogout()
    {
        $this->get(self::CURRENT_URL . '/logout');
        $this->assertResponseSuccess();
    }

    public function testResetPassword()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'new_password' => '123456',
            'confirm_password' => '123456'
        ];

        $this->get(self::CURRENT_URL . '/resetPassword');

        $this->post(self::CURRENT_URL . '/resetPassword/xyz', $data);

        $data = [
            'new_password' => '',
            'confirm_password' => '123456'
        ];

        $this->post(self::CURRENT_URL . '/resetPassword/xyz', $data);
        $this->assertResponseSuccess();

    }

    public function testForgotPassword()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();

        $data = [
            'email' => ''
        ];
        $this->post(self::CURRENT_URL . '/forgotPassword', $data);
        $data = [
            'email' => 'test@i-ways.net'
        ];

        $this->post(self::CURRENT_URL . '/forgotPassword', $data);
        $this->assertResponseSuccess();

    }

    public function testActivate()
    {
        $this->get(self::CURRENT_URL . '/activate/1');
        $this->assertResponseSuccess();
    }

    public function testActivateUser()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();

        $data = [
            'user_email' => 'test2@i-ways.net'
        ];

        $this->post(self::CURRENT_URL . '/activateUser', $data);
        $this->assertResponseSuccess();

    }

    public function testLoginAs()
    {
        $this->get(self::CURRENT_URL . '/loginAs/1');
        $this->assertResponseSuccess();
    }

}
