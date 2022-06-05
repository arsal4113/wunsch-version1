<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreErrorNotificationProfilesController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreErrorNotificationProfilesController Test Case
 */
class CoreErrorNotificationProfilesControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreErrorNotificationProfiles',
        'app.Core/CoreUsers',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
    ];

    const CURRENT_URL = '/core_error_notification_profiles';
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
        $this->get(self::CURRENT_URL);
        $this->assertResponseOk();
    }

    public function testIndexPost()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'search_value' => 'Lorem',
            'search_param' => 'name'
        ];
        $this->post(self::CURRENT_URL, $data);
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get(self::CURRENT_URL. '/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data =[
            'id' => 1,
            'core_seller_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Lorem ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'email_to' => 'email1@company.com',
            'email_cc' => 'email2@company.com',
            'email_bcc' => 'email3@company.com',
            'email_subject' => 'Lorem ipsum dolor sit amet',
            'is_active' => 1,
            'is_running' => 1,
            'last_run' => '2015-12-09 10:21:00',
            'run_interval' => 1,
            'next_run' => '2015-12-09 10:21:00',
            'max_execution_time' => 1,
            'last_alive' => '2015-12-09 10:21:00',
            'created' => '2015-12-09 10:21:00',
            'modified' => '2015-12-09 10:21:00'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $errorNotifications = TableRegistry::getTableLocator()->get('core_error_notification_profiles');
        $errorNorification = $errorNotifications->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $errorNorification->name);
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data =[
            'id' => 1,
            'core_seller_id' => 3,
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Lorem ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'email_to' => 'Lorem ipsum dolo',
            'email_cc' => 'Lorem ipsum dolo',
            'email_bcc' => 'Lorem ipsum dolo',
            'email_subject' => 'Lorem ipsum dolor sit amet',
            'is_active' => 12,
            'is_running' => 1,
            'last_run' => '2015-12-09 10:21:00',
            'run_interval' => 1,
            'next_run' => '2015-12-09 10:21:00',
            'max_execution_time' => 1,
            'last_alive' => '2015-12-09 10:21:00',
            'created' => '2015-12-09 10:21:00',
            'modified' => '2015-12-09 10:21:00'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data =[
            'id' => 1,
            'core_seller_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Lorem ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'email_to' => 'email1@company.com',
            'email_cc' => 'email2@company.com',
            'email_bcc' => 'email3@company.com',
            'email_subject' => 'Lorem ipsum dolor sit amet',
            'is_active' => 1,
            'is_running' => 1,
            'last_run' => '2015-12-09 10:21:00',
            'run_interval' => 1,
            'next_run' => '2015-12-09 10:21:00',
            'max_execution_time' => 1,
            'last_alive' => '2015-12-09 10:21:00',
            'created' => '2015-12-09 10:21:00',
            'modified' => '2015-12-09 10:21:00'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $errorNotifications = TableRegistry::getTableLocator()->get('core_error_notification_profiles');
        $errorNorification = $errorNotifications->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $errorNorification->name);
    }

    public function testEditView(){

        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data =[
            'id' => 1,
            'core_seller_id' => 3,
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Lorem ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'email_to' => 'Lorem ipsum dolo',
            'email_cc' => 'Lorem ipsum dolo',
            'email_bcc' => 'Lorem ipsum dolo',
            'email_subject' => 'Lorem ipsum dolor sit amet',
            'is_active' => 12,
            'is_running' => 1,
            'last_run' => '2015-12-09 10:21:00',
            'run_interval' => 1,
            'next_run' => '2015-12-09 10:21:00',
            'max_execution_time' => 1,
            'last_alive' => '2015-12-09 10:21:00',
            'created' => '2015-12-09 10:21:00',
            'modified' => '2015-12-09 10:21:00'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
        $category = TableRegistry::getTableLocator()->get('core_error_notification_profiles');
        $resultCount = $category->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('core_error_notification_profiles')->get(1);
        $cancelReasons = $this->getMockForModel('CoreErrorNotificationProfiles', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }
}
