<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreCustomersController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreCustomersController Test Case
 */
class CoreCustomersControllerTest extends IntegrationTestCase
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
        'app.Core/CoreErrorEbayNotifications',
        'app.Core/CoreCustomers',
        'app.Core/CoreCustomerAddresses',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
    ];

    const CURRENT_URL = '/core_customers';
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
//        $this->get('/core_customers/index');
//        $this->assertRedirect(['controller' => 'CoreUsers', 'action' => 'login']);
//    }

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

        $data =  [
            'id' => 1,
            'core_seller_id' => 1,
            'firstname' => 'new name',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'company' => 'test company',
            'email' => 'email@company.com',
            'phone' => '030000000',
            'street_1' => 'Lorem ipsum dolor sit amet',
            'street_2' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'city' => 'lahore',
            'country_code' => 'pkr',
            'country_name' => 'pakistan',
            'default_shipping_address_id' => 1,
            'default_billing_address_id' => 1,
            'created' => '2015-04-24 11:56:33',
            'modified' => '2015-04-24 11:56:33'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $customers = TableRegistry::getTableLocator()->get('core_customers');
        $customer = $customers->find()->where(['firstname' => $data['firstname']])->first();
        $this->assertEquals($data['firstname'], $customer->firstname);
    }

    public function testAddView(){
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseSuccess();
    }

    public function testAddFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data =  [
            'id' => 1,
            'core_seller_id' => 1,
            'firstname' => 'new name',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'company' => 'test company',
            'email' => 'email address',
            'phone' => '030000000',
            'street_1' => 'Lorem ipsum dolor sit amet',
            'street_2' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'city' => 'lahore',
            'country_code' => 'pkr',
            'country_name' => 'pakistan',
            'default_shipping_address_id' => 1,
            'default_billing_address_id' => 1,
            'created' => '2015-04-24 11:56:33',
            'modified' => '2015-04-24 11:56:33'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEdit(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data =  [
            'id' => 1,
            'core_seller_id' => 1,
            'firstname' => 'new name',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'company' => 'test company',
            'email' => 'email@company.com',
            'phone' => '030000000',
            'street_1' => 'Lorem ipsum dolor sit amet',
            'street_2' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'city' => 'lahore',
            'country_code' => 'pkr',
            'country_name' => 'pakistan',
            'default_shipping_address_id' => 1,
            'default_billing_address_id' => 1,
            'created' => '2015-04-24 11:56:33',
            'modified' => '2015-04-24 11:56:33'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $customers = TableRegistry::getTableLocator()->get('core_customers');
        $customer = $customers->find()->where(['firstname' => $data['firstname']])->first();
        $this->assertEquals($data['firstname'], $customer->firstname);
    }

    public function testEditView(){

        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data =  [
            'id' => 1,
            'core_seller_id' => 1,
            'firstname' => 'new name',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'company' => 'test company',
            'email' => 'email address',
            'phone' => '030000000',
            'street_1' => 'Lorem ipsum dolor sit amet',
            'street_2' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'city' => 'lahore',
            'country_code' => 'pkr',
            'country_name' => 'pakistan',
            'default_shipping_address_id' => 1,
            'default_billing_address_id' => 1,
            'created' => '2015-04-24 11:56:33',
            'modified' => '2015-04-24 11:56:33'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testDelete(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
        $customer = TableRegistry::getTableLocator()->get('core_customers');
        $resultCount = $customer->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('core_customers')->get(1);
        $cancelReasons = $this->getMockForModel('CoreCustomers', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }

    public function testSetStandardShippingAddress(){
        $this->get(self::CURRENT_URL . '/setStandardShippingAddress/1/1');
        $this->assertResponseSuccess();
    }

    public function testSetStandardShippingAddressAjax(){

        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ]
        ]);

        $this->get(self::CURRENT_URL . '/setStandardShippingAddress/1/1');
        $this->assertResponseSuccess();
    }

    public function testSetStandardBillingAddress(){
        $this->get(self::CURRENT_URL . '/setStandardBillingAddress/1/1');
        $this->assertResponseSuccess();
    }

    public function testSetStandardBillingAddressAjax(){

        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ]
        ]);

        $this->get(self::CURRENT_URL . '/setStandardBillingAddress/1/1');
        $this->assertResponseSuccess();
    }

}
