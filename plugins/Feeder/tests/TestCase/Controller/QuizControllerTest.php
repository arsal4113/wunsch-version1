<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\QuizController;
use \Psr\Http\Message\UploadedFileInterface;

/**
 * Feeder\Controller\QuizController Test Case
 */
class QuizControllerTest extends IntegrationTestCase
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
        'app.Core/EbayAccounts',
        'app.Core/EbayAccountTypes',
        'app.Core/EbayCredentials',
        'app.EbayCheckoutSessionItem',
        'app.EbayCheckoutSessions',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederQuizzes',
        'plugin.feeder.FeederQuizResults',
        'plugin.feeder.FeederHomepages',
        'plugin.feeder.FeederHomepageBanners',
        'plugin.feeder.FeederHomepageMidpageContainers',
        'plugin.feeder.FeederGuides',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes',
        'plugin.UrlRewrite.UrlRewriteRedirects'

    ];

    const CURRENT_URL = '/feeder/quiz';
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

    public function testIndexId()
    {
        $this->get(self::CURRENT_URL . '/index/1');
        $this->assertResponseOk();
    }


}
