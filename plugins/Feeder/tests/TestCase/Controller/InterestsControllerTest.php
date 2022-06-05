<?php
namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Feeder\Controller\InterestsController;
use Cake\TestSuite\IntegrationTestTrait;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;
use Cake\Controller\ComponentRegistry;
/**
 * Feeder\Controller\InterestsController Test Case
 */
class InterestsControllerTest extends IntegrationTestCase
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
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
        'app.Core/CoreCountries',
        'app.Core/CoreConfigurations',
        'app.FeederGuides',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.Customers',
        'plugin.feeder.CustomerGenders',
        'plugin.feeder.Newsletter',
        'app.FeederCategoriesFeederHeroItems',
        'app.FeederGuidesFeederCategories',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'app.Core/TranslationCoreCountries',
        //'plugin.Feeder.Interests',
        'plugin.Feeder.FeederInterestSubcategories',
        'plugin.Feeder.FeederInterestsFeederInterestSubcategories',
        'plugin.Feeder.FeederInterests',
        'plugin.feeder.FeederHomepages',
        'plugin.feeder.FeederHompagesBreakpointBanners',
        'plugin.feeder.FeederHomepageBanners',
        'plugin.feeder.FeederHomepageMidpageContainers',
        'app.CustomersFeederInterestSubcategories',
        'plugin.Feeder.CustomerWishlistItems',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes'

    ];
    

    const CURRENT_URL = '/feeder/interests';
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
    public function testView()
    {
        $this->get(self::CURRENT_URL);
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
        if (isset($this->_controller) && $this->_controller->name == 'Interests') {
            $user = TableRegistry::getTableLocator()->get('customers')->get(1);
            $componentRegistry = new ComponentRegistry($this->_controller);
            $auth = $this->getMockBuilder('Cake\Controller\Component\AuthComponent')
                ->setMethods(['user'])
                ->setConstructorArgs([$componentRegistry, []])
                ->getMock();
            $auth->expects($this->any())->method('user')->will(
                $this->returnValue($user)
            );
            $this->_controller->Auth = $auth;
            
        }
    }
}
