<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\ProductsController;
use \Psr\Http\Message\UploadedFileInterface;

/**
 * Feeder\Controller\FeederWorldsController Test Case
 */
class ProductsControllerTest extends IntegrationTestCase
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
        'plugin.feeder.FeederHomepageMidpageContainers',
        'plugin.feeder.FeederHomepages',
        'plugin.feeder.FeederHompagesBreakpointBanners',
        'plugin.feeder.FeederHomepageBanners',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederFizzyBubbleContainers',
        'plugin.feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederPillarPages',
        'plugin.feeder.FeederGuides',
        'plugin.feeder.FeederWorlds',
        'plugin.ItoolCustomer.CustomerWishlists',
        'app.Core/TranslationCoreCountries',
        'app.EbayRestApiAccessTokens',

    ];

    const CURRENT_URL = '/feeder/products';
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
    public function testDescription()
    {
        $this->get('/feeder/product-description/1');
        $this->assertResponseOk();
    }

    public function testDescriptionElse()
    {
        $this->get(self::CURRENT_URL .'/description/1');
        $this->assertResponseOk();
    }


}
