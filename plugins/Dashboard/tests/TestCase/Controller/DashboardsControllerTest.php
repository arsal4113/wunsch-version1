<?php
namespace Dashboard\Test\TestCase\Controller;

use Dashboard\Controller\DashboardsController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\TestSuite\IntegrationTestCase;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\Controller\ComponentRegistry;
/**
 * Dashboard\Controller\DashboardsController Test Case
 */
class DashboardsControllerTest extends IntegrationTestCase
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
    const CURRENT_URL = '/dashboard/dashboards';
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


}
