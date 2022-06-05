<?php

namespace App\Test\TestCase\Controller;

use App\Controller\CoreConfigurationsController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreConfigurationsController Test Case
 */
class CoreConfigurationsControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    const CURRENT_URL = '/core_configurations';
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreUsers',
        'app.Core/CoreConfigurations',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
        'app.UrlRewriteRoutes'
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

    public function testIndex(){
        $this->get(self::CURRENT_URL);
        $this->assertResponseCode(302);
    }


    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexUnauthorizedFails()
    {
        // Set session data
        $this->get(self::CURRENT_URL.'/loadConfigurationGroup/config_group');
        $this->assertResponseOk();
    }

    public function testIndexUnauthorizedFailsPost()
    {
//        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            '1' => 'loadConfigurationGroup',
        ];

        // Set session data
        $this->patch(self::CURRENT_URL.'/loadConfigurationGroup/config_group', $data);
        $this->assertResponseCode(302);
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
            'core_seller_id'      => 1,
            'configuration_group' => 'ConfigGroup',
            'configuration_path'  => 'www.ebay.com/test/config',
            'configuration_value' => 'config_value',
            'created'             => '2015-04-10 12:09:21',
            'modified'            => '2015-04-10 12:09:21'
        ];

        $this->post(self::CURRENT_URL.'/add', $data);
        $this->assertResponseSuccess();
        $configurations = TableRegistry::getTableLocator()->get('core_configurations');
        $configuration  = $configurations->find()->where(['configuration_group' => $data['configuration_group']])->first();
        $this->assertEquals($data['configuration_group'], $configuration->configuration_group);

    }

    public function testAddView()
    {
        $this->get(self::CURRENT_URL.'/add');
        $this->assertResponseSuccess();
    }

    public function testAddFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();


        $data = [];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseOk();

    }

    public function testEdit()
    {

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'core_seller_id'      => 1,
            'configuration_group' => 'ConfigGroup',
            'configuration_path'  => 'config_path',
            'configuration_value' => 'config_value',
            'created'             => '2015-04-10 12:09:21',
            'modified'            => '2015-04-10 12:09:21'
        ];

        $this->post(self::CURRENT_URL.'/edit/1', $data);
        $this->assertResponseSuccess();
        $configurations = TableRegistry::getTableLocator()->get('core_configurations');
        $configuration  = $configurations->find()->where(['configuration_group' => $data['configuration_group']])->first();
        $this->assertEquals($data['configuration_group'], $configuration->configuration_group);
    }

    public function testEditView()
    {

        $this->get(self::CURRENT_URL.'/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();


        $data = [
            'core_seller_id'      => null,
            'configuration_group' => null,
            'configuration_path'  => null,
            'configuration_value' => 'config_value',
            'created'             => '2015-04-10 12:09:21',
            'modified'            => '2015-04-10 12:09:21'
    ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testDelete()
    {

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(self::CURRENT_URL.'/delete/1');
        $configuration = TableRegistry::getTableLocator()->get('core_configurations');
        $resultCount   = $configuration->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason  = TableRegistry::getTableLocator()->get('core_configurations')->get(1);
        $cancelReasons = $this->getMockForModel('CoreConfigurations', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL.'/delete/0');
        $this->assertResponseSuccess();
    }
}
