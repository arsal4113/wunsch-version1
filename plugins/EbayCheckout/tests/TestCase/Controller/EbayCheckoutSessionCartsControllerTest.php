<?php
namespace EbayCheckout\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use EbayCheckout\Controller\EbayCheckoutSessionCartsController;
use \Psr\Http\Message\UploadedFileInterface;
use Cake\Controller\ComponentRegistry;

/**
 * EbayCheckout\Controller\EbayCheckoutWorldsController Test Case
 */
class EbayCheckoutSessionCartsControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;
    private $uuid = 'fb058b6c-7fbb-43b4-8680-a4c9ec62f114';
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
        'plugin.EbayCheckout.EbayCheckouts',
        'plugin.EbayCheckout.EbayCheckoutSessionItemShippings',
        'plugin.EbayCheckout.EbayCheckoutSessionItemPromotions',
        'plugin.feeder.Customers',
        'plugin.feeder.Newsletter',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederGuides',
        'plugin.feeder.FeederHomepages',
        'plugin.Feeder.CustomerWishlistItems',
        'app.Core/TranslationCoreCountries',
        'app.UrlRewriteRoutes',
        'app.UrlRewriteRedirects',
        'app.Core/EbayAccounts',
        'app.Core/EbayCredentials',
        'app.Core/EbayAccountTypes',
        'app.EbayRestApiAccessTokens',
        'plugin.EbayCheckout.EbayCheckoutSessionTotals',
        'app.ProductVisits',
        'plugin.feeder.FeederHomepageBanners',
        'plugin.feeder.FeederHomepageMidpageContainers',

    ];

    const CURRENT_URL = '/checkout';
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


     public function testMini()
     {
        $this->get(self::CURRENT_URL.'/'.$this->uuid.'/cart');
        $this->assertResponseOk();
     }

}
