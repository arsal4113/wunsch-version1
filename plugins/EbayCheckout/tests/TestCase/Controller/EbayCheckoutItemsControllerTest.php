<?php
namespace EbayCheckout\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\Controller\ComponentRegistry;
use EbayCheckout\Test\GlobalTraits\AddCart;
use EbayCheckout\Test\GlobalTraits\CartItem;


class EbayCheckoutItemsControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;
    use AddCart;
    use CartItem;

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
        'app.ProductVisits',
        'plugin.feeder.FeederHomepageBanners',
        'plugin.feeder.FeederHomepageMidpageContainers',
        'plugin.EbayCheckout.EbayCheckouts',

    ];

    const CURRENT_URL = '/checkout';

    private $coreUser;
    private $itemid='v1|153402157101|0';
    private $uuid='fb058b6c-7fbb-43b4-8680-a4c9ec62f114';

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
        //$this->testAddItem();
    }
    /**
     * Test index method
     *
     * @return void
     */
     public function testDescription()
     {
        $this->get(self::CURRENT_URL.'/'.$this->uuid.'/product/description/'.$this->itemid);
        $this->assertResponseOk();
     }
     public function testDescriptionCountryCodeGlobalId()
     {
         $this->get(self::CURRENT_URL . '/' . $this->uuid . '/product/description/' . $this->itemid . '/de/EBAY-DE');
         $this->assertResponseOk();
     }
    public function testView()
    {
        $this->get(self::CURRENT_URL.'/'.$this->uuid.'/product/view/'.$this->itemid);
        $this->assertResponseOk();
    }
    public function testViewParamCountryCodeUs()
    {
        $this->get(self::CURRENT_URL . '/' . $this->uuid . '/product/view/' . $this->itemid . '/us');
        $this->assertResponseOk();
    }

    public function testViewParamCountryCodeGb()
    {
        $this->get(self::CURRENT_URL . '/' . $this->uuid . '/product/view/' . $this->itemid . '/gb');
        $this->assertResponseOk();
    }

    public function testViewParamCountryCodeUk()
    {
        $this->get(self::CURRENT_URL . '/' . $this->uuid . '/product/view/' . $this->itemid . '/uk');
        $this->assertResponseOk();
    }

    public function testViewParamCountryCodeGlobalId()
    {
        $this->get(self::CURRENT_URL . '/' . $this->uuid . '/product/view/' . $this->itemid . '/de/EBAY-DE');
        $this->assertResponseOk();
    }

    public function controllerSpy($event, $controller = null)
    {
        if (!$controller) {
            // @var Controller $controller
            $controller = $event->getSubject();
        }
        $this->_controller = $controller;
        $events = $controller->getEventManager();
        $events->on('View.beforeRender', function ($event, $viewFile) use ($controller) {
            if (!$this->_viewName) {
                $this->_viewName = $viewFile;
            }
            if ($this->_retainFlashMessages) {
                $this->_flashMessages = $controller->getRequest()->getSession()->read('Flash');
            }
        });
        $events->on('View.beforeLayout', function ($event, $viewFile) {
            $this->_layoutName = $viewFile;
        });
        if (isset($this->_controller) && $this->_controller->name == 'EbayCheckoutItems') {
            $items = $this->getItem();
            $componentRegistry = new ComponentRegistry($this->_controller);
            $getItemComponent = $this->getMockBuilder('EbayCheckout\Controller\Component\GetItemComponent')
                ->setMethods(['get'])
                ->setConstructorArgs([$componentRegistry, []])
                ->getMock();
            $getItemComponent->expects($this->any())->method('get')->will(
                $this->returnValue($items)
            );
            $this->_controller->GetItem = $getItemComponent;
        }
    }

}
