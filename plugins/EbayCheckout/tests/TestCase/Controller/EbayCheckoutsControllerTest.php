<?php
namespace EbayCheckout\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use EbayCheckout\Controller\EbayCheckoutsController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use \Psr\Http\Message\UploadedFileInterface;
use Cake\Controller\ComponentRegistry;
/**
 * EbayCheckout\Controller\EbayCheckoutsController Test Case
 */
class EbayCheckoutsControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;
    /**
     * Test initial setup
     *
     * @return void
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
        'plugin.feeder.Customers',
        'plugin.feeder.Newsletter',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederHomepageMidpageContainers',
        'plugin.feeder.FeederHomepages',
        'plugin.feeder.FeederHompagesBreakpointBanners',
        'plugin.feeder.FeederHomepageBanners',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'plugin.feeder.FeederHeroItems',
        'app.FeederCategoriesFeederHeroItems',
        'plugin.feeder.FeederFizzyBubbleContainers',
        'plugin.feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederPillarPages',
        'plugin.feeder.FeederGuides',
        'plugin.feeder.FeederWorlds',
        'plugin.Feeder.CustomerWishlistItems',
        'plugin.ItoolCustomer.CustomerWishlists',
        'app.Core/TranslationCoreCountries',
        'plugin.EbayCheckout.EbayCheckouts',
        'plugin.EbayCheckout.EbayCheckoutSessionTotals',
        'plugin.EbayCheckout.EbayCheckoutSessionShippingAddresses',
        

    ];

    const CURRENT_URL = '/checkout/ebay-checkouts/';
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
        $this->get(self::CURRENT_URL.'/index');
        $this->assertResponseOk();
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
        $this->enableRetainFlashMessages();
        $data = [
            'id'                        => '1',
            'core_seller_id'            => '1',
            'name'                      => NULL,
            'title'                     => NULL,
            'x_frame_origins'           => NULL,
            'logo'                      => NULL,
            'main_color'                => NULL,
            'second_color'              => NULL,
            'font'                      => NULL,
            'font_color'                => NULL,
            'background_image'          => NULL,
            'background_image_position' => NULL,
            'background_color'          => NULL,
            'modified'                  => '2019-09-05 13:21:17',
            'created'                   => '2019-09-05 13:21:17'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $EbayCheckouts = TableRegistry::getTableLocator()->get('EbayCheckouts');
        $query              = $EbayCheckouts->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id'                        => '1',
            'core_seller_id'            => '1',
            'name'                      => NULL,
            'title'                     => NULL,
            'x_frame_origins'           => NULL,
            'logo'                      => NULL,
            'main_color'                => NULL,
            'second_color'              => NULL,
            'font'                      => NULL,
            'font_color'                => NULL,
            'background_image'          => NULL,
            'background_image_position' => NULL,
            'background_color'          => NULL,
            'modified'                  => '2019-09-05 13:21:17',
            'created'                   => '2019-09-05 13:21:17'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $EbayCheckouts = TableRegistry::getTableLocator()->get('EbayCheckouts');
        $query  = $EbayCheckouts->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $query->id);
    }

    public function testEditFailedTest()
    {

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id'                        => NULL,
            'core_seller_id'            => NULL,
            'name'                      => NULL,
            'title'                     => NULL,
            'x_frame_origins'           => NULL,
            'logo'                      => NULL,
            'main_color'                => NULL,
            'second_color'              => NULL,
            'font'                      => NULL,
            'font_color'                => NULL,
            'background_image'          => NULL,
            'background_image_position' => NULL,
            'background_color'          => NULL,
            'modified'                  => '2019-09-05 13:21:17',
            'created'                   => '2019-09-05 13:21:17'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }

    public function testDeleteFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }

    public function testIndexSessions()
    {
        $this->get(self::CURRENT_URL.'/index-sessions');
        $this->assertResponseOk();
    }

    public function testViewSession()
    {
        $this->get(self::CURRENT_URL.'/view-session/1');
        $this->assertResponseOk();
    }

    public function testExportSessions()
    {
        $this->get(self::CURRENT_URL.'/export-sessions');
        $this->assertResponseOk();
    }
    
   
}
