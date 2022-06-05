<?php

namespace App\Test\TestCase\Controller;

use App\Controller\CoreSellersController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreSellersController Test Case
 */
class CoreSellersControllerTest extends IntegrationTestCase
{

    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    const CURRENT_URL = '/core_sellers';

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreUsers',
        'app.Core/CoreCountries',
        'app.Core/CoreConfigurations',
        'app.Core/CoreCustomerAddresses',
        'app.Core/CoreCustomers',
        'app.Core/CoreSellerAddresses',
        'app.Core/CoreOrders',
        'app.Core/CoreCurrencies',
        'app.Core/CoreMarketplacesCoreSellers',
        'app.Core/CoreCategories',
        'app.Core/CoreErrors',
        'app.Core/CoreProductTypes',
        'app.Core/CoreProductQuantities',
        'app.Core/CoreProductEavAttributeSets',
        'app.Core/CoreMarketplaceRunningProfiles',
        'app.Core/CoreProductAttributeValueDatetimes',
        'app.Core/CoreProductAttributeValueDecimals',
        'app.Core/CoreProductAttributeValueImages',
        'app.Core/CoreProductAttributeValueTexts',
        'app.Core/CoreProductAttributeValueVarchars',
        'app.Core/TranslationCoreCountries',
        'app.Core/EbaySites',
        'app.Core/CoreMarketplaces',
        'app.Core/CoreProductEavAttributeGroups',
        'app.Core/CoreMarketplaceGroups',
        'app.Core/CoreProductEavAttributes',
        'app.Core/TranslationCoreAttributes',
        'app.Core/CoreProductEavAttributeGroupsCoreProductEavAttributes',
        'app.Core/CoreProducts',
        'app.Core/CoreCancelReasons',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Core/EbayAutoListerConfigurations',
        'app.Core/EbayDisputeExplanationNames',
        'app.Core/EbayDisputeReasonNames',
        'app.Core/EbayLaunchProfiles',
        'app.Core/EbayListings',
        'app.Core/TranslationCoreAttributes',
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

    /**
     * Test view method
     *
     * @return void
     */
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
            'id'               => 1,
            'code'             => 'admin',
            'name'             => 'Admin',
            'core_language_id' => 1,
            'core_country_id'  => 1,
            'is_active'        => 1,
            'created'          => '2015-11-10 15:46:17',
            'modified'         => '2015-11-10 15:46:17'
        ];

        $this->post(self::CURRENT_URL.'/add', $data);
        $this->assertResponseSuccess();
        $sellers = TableRegistry::getTableLocator()->get('core_sellers');
        $seller  = $sellers->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $seller->name);
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

        $data = [
            'id'               => 1,
            'code'             => 'admin',
            'name'             => 'Admin',
            'core_language_id' => 3,
            'core_country_id'  => 1,
            'is_active'        => 1,
            'created'          => '2015-11-10 15:46:17',
            'modified'         => '2015-11-10 15:46:17'
        ];

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
            'id'               => 1,
            'code'             => 'admin',
            'name'             => 'Admin',
            'core_language_id' => 1,
            'core_country_id'  => 1,
            'is_active'        => 1,
            'created'          => '2015-11-10 15:46:17',
            'modified'         => '2015-11-10 15:46:17'
        ];

        $this->post(self::CURRENT_URL.'/edit/1', $data);
        $this->assertResponseSuccess();
        $sellers = TableRegistry::getTableLocator()->get('core_sellers');
        $seller  = $sellers->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $seller->name);
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
            'id'               => 1,
            'code'             => 'admin',
            'name'             => 'Admin',
            'core_language_id' => 4,
            'core_country_id'  => 1,
            'is_active'        => 1,
            'created'          => '2015-11-10 15:46:17',
            'modified'         => '2015-11-10 15:46:17'
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
        $this->assertResponseSuccess();
        $type        = TableRegistry::getTableLocator()->get('core_sellers');
        $resultCount = $type->find()->where(['core_sellers.id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('core_sellers')->get(1);
        $cancelReasons = $this->getMockForModel('CoreSellers', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }

    public function testRegister()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'code' => 'admins',
            'name' => 'Admins',
            'core_language_id' => 1,
            'core_country_id'  => 1,
            'is_active'        => 1,
            'botdetect_captcha' => 1,
            'created'          => '2015-11-10 15:46:17',
            'modified'         => '2015-11-10 15:46:17',
            'email' => 'test2@i-ways.net',
            'password' => '12345678'
        ];
        $this->post(self::CURRENT_URL.'/register', $data);
        $this->assertResponseSuccess();
    }

    public function testGetCountryId(){
        // dd(1);
        $this->get(self::CURRENT_URL. '/getCountryId/DE');
        $this->assertResponseSuccess();
    }

    public function testActivateAccount()
    {
        $this->get(self::CURRENT_URL.'/activateAccount');
        $this->assertResponseSuccess();
    }

    public function testActivateAccountToken()
    {
        $this->get(self::CURRENT_URL.'/activateAccount/125d25/test2@i-ways.net');
        $this->assertResponseSuccess();
    }


}
