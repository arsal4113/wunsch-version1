<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreSellerTypesController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreSellerTypesController Test Case
 */
class CoreSellerTypesControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    const CURRENT_URL = '/core_seller_types';

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreUsers',
        'app.Core/CoreProductSkuMappings',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
    ];

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
//    public function testIndexUnauthorizedFails()
//    {
//        // Set session data
//        $this->get('/core_product_types/index');
//        $this->assertRedirect(['controller' => 'CoreUsers', 'action' => 'login']);
//    }

    public function testIndex()
    {
        $this->get(self::CURRENT_URL);
        $this->assertResponseOk();
    }

    public function testView()
    {
        $this->get(self::CURRENT_URL.'/view/1');
        $this->assertResponseOk();
    }

    public function testAdd()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'core_user_role_id' => 1,
            'code' => 'admin',
            'name' => 'Admin',
            'created' => '2016-08-19 13:52:16',
            'modified' => '2016-08-19 13:52:16'
        ];

        $this->post(self::CURRENT_URL.'/add', $data);
        $this->assertResponseSuccess();
        $types = TableRegistry::getTableLocator()->get('core_seller_types');
        $type  = $types->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $type->name);
    }

    public function testAddView()
    {
        $this->get(self::CURRENT_URL.'/add');
        $this->assertResponseSuccess();
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [];

        $this->post(self::CURRENT_URL.'/add', $data);
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

        $data = [
            'id' => 1,
            'core_user_role_id' => 1,
            'code' => 'admin',
            'name' => 'Admin',
            'created' => '2016-08-19 13:52:16',
            'modified' => '2016-08-19 13:52:16'
        ];

        $this->post(self::CURRENT_URL.'/edit/1', $data);
        $this->assertResponseSuccess();
        $types = TableRegistry::getTableLocator()->get('core_seller_types');
        $type  = $types->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $type->name);
    }

    public function testEditView()
    {
        $this->get(self::CURRENT_URL.'/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'core_user_role_id' => null,
            'code' => null,
            'name' => null,
            'created' => '2016-08-19 13:52:16',
            'modified' => '2016-08-19 13:52:16'
        ];

        $this->post(self::CURRENT_URL.'/edit/1', $data);
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

        $this->post(self::CURRENT_URL.'/delete/1');

//        $this->assertResponseSuccess();
        $type   = TableRegistry::getTableLocator()->get('core_seller_types');
        $resultCount = $type->find()->where(['core_seller_types.id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('core_seller_types')->get(1);
        $cancelReasons = $this->getMockForModel('CoreSellerTypes', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }
}
