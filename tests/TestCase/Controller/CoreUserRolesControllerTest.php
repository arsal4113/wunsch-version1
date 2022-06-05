<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreUserRolesController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\CoreUserRolesController Test Case
 */
class CoreUserRolesControllerTest extends IntegrationTestCase
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
        'app.Acos/AcosAros'
    ];

    const CURRENT_URL = '/core_user_roles';
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

     public function testAdd(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
                'core_seller_id' => 1,
                'code' => 'admin',
                'name' => 'Admin',
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $user_roles = TableRegistry::getTableLocator()->get('CoreUserRoles');
        $query = $user_roles->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddView(){
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseSuccess();
    }

    public function testAddFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEdit(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'core_seller_id' => 1,
            'code' => 'Dealsguru-ADMINISTRATOR',
            'name' => 'Dealsguru',
            'created' => '2016-02-22 12:17:06',
            'modified' => '2016-02-22 12:17:06'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);

        $this->assertResponseSuccess();
        $roles = TableRegistry::getTableLocator()->get('core_user_roles');
        $role   = $roles->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $role->name);
    }

    public function testEditView(){

        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'core_seller_id' => null,
            'code' => null,
            'name' => null,
            'created' => '2016-02-03 15:03:13',
            'modified' => '2016-02-03 15:03:13'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testView()
    {
        $resp = $this->get(self::CURRENT_URL . '/view/1');
        $this->assertResponseOk();
    }

    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }
    
    public function testDeleteSuccess()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $CoreUserRole = TableRegistry::getTableLocator()->get('CoreUserRoles')->get(1);
        $CoreUserRoles = $this->getMockForModel('CoreUserRoles', ['get', 'delete']);
        $CoreUserRoles->expects($this->once())
            ->method('get')
            ->will($this->returnValue($CoreUserRole));
        $CoreUserRoles->expects($this->any())
            ->method('delete')
            ->will($this->returnValue(true)); 
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }
    
    public function testDeleteFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $CoreUserRole = TableRegistry::getTableLocator()->get('CoreUserRoles')->get(1);
        $CoreUserRoles = $this->getMockForModel('CoreUserRoles', ['get', 'delete']);
        $CoreUserRoles->expects($this->once())
            ->method('get')
            ->will($this->returnValue($CoreUserRole));
        $CoreUserRoles->expects($this->once())
            ->method('delete')
            ->will($this->returnValue(false)); 
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }

}
