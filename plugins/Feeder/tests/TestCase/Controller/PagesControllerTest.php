<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\PagesController;
use \Psr\Http\Message\UploadedFileInterface;
use Feeder\src\Controller;

/**
 * Feeder\Controller\FeederWorldsController Test Case
 */
class PagesControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    const CURRENT_URL = '/feeder/pages';

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
        'app.EbayCheckoutSessionItem',
        'app.EbayCheckoutSessions',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederHomepages',
        'plugin.feeder.FeederHompagesBreakpointBanners',
        'plugin.feeder.FeederHomepageMidpageContainers',
        'plugin.feeder.FeederHomepageBanners',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederFizzyBubbleContainers',
        'plugin.feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederPillarPages',
        'plugin.feeder.FeederGuides',
        'plugin.feeder.FeederWorlds',
        'plugin.ItoolCustomer.CustomerWishlists',
        'app.Core/TranslationCoreCountries'

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
    public function testBeforeRender()
    {
        $this->get(self::CURRENT_URL . '/display/about-us');
        $this->assertResponseOk();
    }

}


