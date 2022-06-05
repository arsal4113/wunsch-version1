<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreCustomerAddressesController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\Routing\Router;

/**
 * App\Controller\CoreCustomerAddressesController Test Case
 */
class CoreCustomerAddressesControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreCustomers',
        'app.Core/CoreCustomerAddresses',
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
        'app.Core/TranslationCoreCountries',
    ];

    const CURRENT_URL = '/core_customer_addresses';
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
//        $this->get('/core_customer_addresses/index');
//        $this->assertRedirect(['controller' => 'CoreUsers', 'action' => 'login']);
//    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        
        $this->get(self::CURRENT_URL. '/customerAddresses/1');
        $this->assertResponseOk();
    }

    public function testAddAjax(){
        
        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ],
            'environment' => ['HTTPS' => 'on']
        ]);
        
        $data = [
            'core_seller_id' => 1,
            'core_customer_id' => 1,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'company' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone' => 'Lorem ipsum dolor sit amet',
            'street_1' => 'Lorem ipsum dolor sit amet',
            'street_2' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'country_code' => 'DE',
            'country_name' => 'Deutschland',
            'created' => '2015-04-24 11:56:40',
            'modified' => '2015-04-24 11:56:40',
            'CoreCustomerAddresses' => [
                'country_name' => 'Deutschland',
                'country_code' => 'DE'
            ]
        ];
        $this->post(self::CURRENT_URL .'/add/1', $data);
        $this->assertResponseOk();
    }



    public function testAdd(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'core_seller_id' => 1,
            'core_customer_id' => 1,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'company' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone' => 'Lorem ipsum dolor sit amet',
            'street_1' => 'Lorem ipsum dolor sit amet',
            'street_2' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'country_code' => 'DE',
            'country_name' => 'Deutschland',
            'created' => '2015-04-24 11:56:40',
            'modified' => '2015-04-24 11:56:40',
            'CoreCustomerAddresses' => [
                'country_name' => 'Deutschland',
                'country_code' => 'DE'
            ]
        ];
        $this->post(self::CURRENT_URL . '/add/1', $data);
        $this->assertResponseSuccess();
        $addresses = TableRegistry::getTableLocator()->get('core_customer_addresses');
        $address  = $addresses->find()->where(['firstname' => $data['firstname']])->first();
        $this->assertEquals($data['firstname'], $address->firstname);
    }
    
    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [];
        $this->post(self::CURRENT_URL . '/add/1', $data);
        $this->assertResponseSuccess();
    }

    public function testAddView(){
        $this->get(self::CURRENT_URL. '/add/1');
        $this->assertResponseOk();
    }

    public function testEditAjax(){

        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ],
            'environment' => ['HTTPS' => 'on']
        ]);

        $data = [
            'core_seller_id' => 1,
            'core_customer_id' => 1,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'company' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone' => 'Lorem ipsum dolor sit amet',
            'street_1' => 'Lorem ipsum dolor sit amet',
            'street_2' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'country_code' => 'DE',
            'country_name' => 'Deutschland',
            'created' => '2015-04-24 11:56:40',
            'modified' => '2015-04-24 11:56:40',
            'CoreCustomerAddresses' => [
                'country_name' => 'Deutschland',
                'country_code' => 'DE'
            ]
        ];
        $this->post(self::CURRENT_URL .'/edit/1/1', $data);
        $this->assertResponseOk();
    }

    public function testEdit(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id' => 1,
            'core_seller_id' => 1,
            'core_customer_id' => 1,
            'firstname' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'company' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'phone' => 'Lorem ipsum dolor sit amet',
            'street_1' => 'Lorem ipsum dolor sit amet',
            'street_2' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'country_code' => 'DE',
            'country_name' => 'Deutschland',
            'created' => '2015-04-24 11:56:40',
            'modified' => '2015-04-24 11:56:40',
            'CoreCustomerAddresses' => [
                'country_name' => 'Deutschland',
                'country_code' => 'DE'
            ]
        ];
        $this->post(self::CURRENT_URL . '/edit/1/1', $data);
        $this->assertResponseSuccess();
        $addresses = TableRegistry::getTableLocator()->get('core_customer_addresses');
        $address  = $addresses->find()->where(['firstname' => $data['firstname']])->first();
        $this->assertEquals($data['firstname'], $address->firstname);
    }
    
    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [];
        $this->post(self::CURRENT_URL . '/edit/1/1', $data);
        $this->assertResponseSuccess();
    }

    public function testEditView(){
        $this->get(self::CURRENT_URL. '/edit/1/1');
        $this->assertResponseOk();
    }

    public function testDeleteAjax(){

        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ]
        ]);

        $this->get(self::CURRENT_URL .'/delete/1/1');
        $this->assertResponseOk();
    }

    public function testDelete(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(self::CURRENT_URL . '/delete/1/1');
        $this->assertResponseSuccess();
        $customer = TableRegistry::getTableLocator()->get('core_customer_addresses');
        $resultCount = $customer->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('core_customer_addresses')->get(1);
        $cancelReasons = $this->getMockForModel('CoreCustomerAddresses', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }

}
