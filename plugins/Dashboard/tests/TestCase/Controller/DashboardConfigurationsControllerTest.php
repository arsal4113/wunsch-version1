<?php
namespace Dashboard\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\TestSuite\IntegrationTestCase;
use Dashboard\Controller\DashboardConfigurationsController;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\Controller\ComponentRegistry;
/**
 * Dashboard\Controller\DashboardConfigurationsController Test Case
 */
class DashboardConfigurationsControllerTest extends IntegrationTestCase
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
        'app.Core/CoreConfigurations',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
        'app.Core/CoreCountries',
        'plugin.Dashboard.DashboardConfigurations',
        'app.UrlRewriteRoutes',
        'app.UrlRewriteRedirects',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes',
        'app.EbayCheckoutSessionItem',
        'app.EbayCheckoutSessions',
        'plugin.feeder.Customers',
        'plugin.feeder.Newsletter',
        'plugin.Dashboard.SocialProfiles',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    const CURRENT_URL = 'dashboard/dashboard-configurations';
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
            'id' => 1,
            'core_seller_id' => 1,
            'core_user_id' => 1,
            'cell_name' => 'Lorem ipsum dolor sit amet',
            'cell_action' => 'Lorem ipsum dolor sit amet',
            'cell_configuration' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-10-06 15:48:39',
            'modified' => '2016-10-06 15:48:39'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);

        $this->assertResponseSuccess();
        $user = TableRegistry::getTableLocator()->get('DashboardConfigurations');
        $query = $user->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEdit(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'core_seller_id' => 1,
            'core_user_id' => 1,
            'cell_name' => 'Lorem ipsum dolor sit amet',
            'cell_action' => 'Lorem ipsum dolor sit amet',
            'cell_configuration' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-10-06 15:48:39',
            'modified' => '2016-10-06 15:48:39'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);

        $this->assertResponseSuccess();
        $user = TableRegistry::getTableLocator()->get('DashboardConfigurations');
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
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }

    /*public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('DashboardConfigurations')->get(1);
        $cancelReasons = $this->getMockForModel('DashboardConfigurations', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }*/
    public function testGetCellParameters()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'parameters' => 1,
            'docComment' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post(self::CURRENT_URL . '/getCellParameters/1', $data);
        $this->assertResponseSuccess();
    }
}
