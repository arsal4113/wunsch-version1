<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreCurrenciesController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreCurrenciesController Test Case
 */
class CoreCurrenciesControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreCurrencies',
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

    const CURRENT_URL = '/core_currencies';
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
//        $this->get('/core_currencies/index');
//        $this->assertRedirect(['controller' => 'CoreUsers', 'action' => 'login']);
//    }

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

    public function testView(){
        $this->get(self::CURRENT_URL. '/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'code' => 'Lorem ipsum dolor sit amet',
            'symbol' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-04-23 14:01:41',
            'modified' => '2015-04-23 14:01:41'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $currencies = TableRegistry::getTableLocator()->get('core_currencies');
        $currency = $currencies->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $currency->name);

    }

    public function testAddView(){
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseSuccess();
    }

    public function testAddFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'code' => '',
            'symbol' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-04-23 14:01:41',
            'modified' => '2015-04-23 14:01:41'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEdit(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data =[
            'id' => 1,
            'code' => 'Lorem ipsum dolor sit amet',
            'symbol' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-04-23 14:01:41',
            'modified' => '2015-04-23 14:01:41'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $currencies = TableRegistry::getTableLocator()->get('core_currencies');
        $currency = $currencies->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $currency->name);
    }

    public function testEditView(){

        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'code' => '',
            'symbol' => 'update failed',
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-04-23 14:01:41',
            'modified' => '2015-04-23 14:01:41'
        ];


        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testDelete(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
        $currency = TableRegistry::getTableLocator()->get('core_currencies');
        $resultCount = $currency->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('core_currencies')->get(1);
        $cancelReasons = $this->getMockForModel('CoreCurrencies', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }


}
