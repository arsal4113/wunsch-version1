<?php
namespace EbayCheckout\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use EbayCheckout\Controller\TopSoldItemsController;
use \Psr\Http\Message\UploadedFileInterface;
use Cake\Controller\ComponentRegistry;

/**
 * EbayCheckout\Controller\EbayCheckoutWorldsController Test Case
 */
class TopSoldItemsControllerTest extends IntegrationTestCase
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
        'app.EbayCheckoutSessionItem',
        'app.EbayCheckoutSessions',
        'plugin.feeder.Customers',
        'plugin.feeder.Newsletter',
        'plugin.feeder.FeederCategories',      
        'plugin.feeder.FeederGuides',      
        'plugin.feeder.FeederHomepages',      
        'plugin.Feeder.CustomerWishlistItems',
        'app.Core/TranslationCoreCountries'

    ];

    const CURRENT_URL = '/checkout/top-sold-items/get-top-sold-items-list';
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

     public function testGetTopSoldItemsList()
     {
        $this->get(self::CURRENT_URL);
        $this->assertResponseOk();
     }
    
    // public function controllerSpy($event, $controller = null)
    // {
    //     if (!$controller) {
    //         // @var Controller $controller
    //         $controller = $event->getSubject();
    //     }
    //     $this->_controller = $controller;
    //     $events = $controller->getEventManager();
    //     $events->on('View.beforeRender', function ($event, $viewFile) use ($controller) {
    //         if (!$this->_viewName) {
    //             $this->_viewName = $viewFile;
    //         }
    //         if ($this->_retainFlashMessages) {
    //             $this->_flashMessages = $controller->getRequest()->getSession()->read('Flash');
    //         }
    //     });
    //     $events->on('View.beforeLayout', function ($event, $viewFile) {
    //         $this->_layoutName = $viewFile;
    //     });
    //     if (isset($this->_controller)) {
    //         $user = TableRegistry::getTableLocator()->get('customers')->get(1);
    //         $componentRegistry = new ComponentRegistry($this->_controller);
    //         $auth = $this->getMockBuilder('Cake\Controller\Component\AuthComponent')
    //             ->setMethods(['user'])
    //             ->setConstructorArgs([$componentRegistry, []])
    //             ->getMock();
    //         $auth->expects($this->any())->method('user')->will(
    //             $this->returnValue($user)
    //         );
    //         $this->_controller->Auth = $auth;
            
    //     }
    // }

}
