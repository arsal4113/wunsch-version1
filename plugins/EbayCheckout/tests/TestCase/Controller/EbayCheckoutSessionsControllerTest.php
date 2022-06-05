<?php

namespace EbayCheckout\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use EbayCheckout\Controller\EbayCheckoutSessionsController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use http\Client\Request;
use \Psr\Http\Message\UploadedFileInterface;
use Cake\Controller\ComponentRegistry;
use EbayCheckout\Test\GlobalTraits\CartItem;

/**
 * EbayCheckout\Controller\EbayCheckoutSessionsController Test Case
 */
class EbayCheckoutSessionsControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;
    use CartItem;

    public $fixtures = [
        'app.Core/CoreUsers',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreProducts',
        'app.Core/CoreOrders',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Core/CoreErrors',
        'app.Core/CoreConfigurations',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
        'app.Core/CoreCountries',
        'app.EbayCheckoutSessionItem',
        'app.EbayCheckoutSessions',
        'app.CustomerAddressesCustomerAddressTypes',
        'plugin.feeder.Customers',
        'plugin.feeder.Newsletter',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederGuides',
        'plugin.feeder.FeederHomepages',
        'plugin.Feeder.CustomerWishlistItems',
        'plugin.Feeder.CustomerWishlistItems',
        'plugin.Feeder.FeederHeroItems',
        'plugin.Feeder.CustomerAddresses',
        'plugin.EbayCheckout.EbayCheckouts',
        'plugin.EbayCheckout.EbayActions',
        'plugin.EbayCheckout.EbayAccountTypes',
        'plugin.EbayCheckout.EbayAccounts',
        'plugin.EbayCheckout.EbayCredentials',
        'plugin.EbayCheckout.EbayCheckoutSessionItemShippings',
        'plugin.EbayCheckout.EbayCheckoutSessionShippingAddresses',
        'plugin.EbayCheckout.EbayCheckoutSessionBillingAddresses',
        'plugin.EbayCheckout.EbayCheckoutSessionTotals',
        'plugin.EbayCheckout.EbayCheckoutSessionPayments',
        'plugin.Ebay.EbayCredentialRestrictions',
        'app.Core/TranslationCoreCountries',
        'plugin.EbayCheckout.EbayRestApiAccessTokens',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes',
        'plugin.UrlRewrite.UrlRewriteRedirects'
    ];
    const CURRENT_URL = '/checkout/fb058b6c-7fbb-43b4-8680-a4c9ec62f114';
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
            'EbayCheckout.session_token' =>   '9635cb8c83bc8f5ddfca284cfdbe6129f7ea07b836def3869531727356314e435275f09130073d78bd4b3a3c091ea5337a5e',
            'Auth' => [
                'User' => $this->coreUser
            ]
        ]);

        //$this->testAddItem();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testAddItem()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'qty'                => 1,
            'attributes'         => ["Farbe" => "Rot"],
            'itemId'             => 'v1|323593478001|512609413917',
            'ebayGlobalId'       => 'EBAY-US',
            'countryCode'        => 'US',
            'widgetType'         => '',
            'wrapperLayout'      => '',
            'variantPrice'       => '7.42',
            'originalPriceValue' => '',
            'tags'               => ["almost-sold-out" => "Fast ausverkauft"]
        ];
        $this->post(self::CURRENT_URL . '/session/addItem', $data);
        $this->assertResponseSuccess();
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
        if (isset($this->_controller) && $this->_controller->name == 'EbayCheckoutSessions') {
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

            $orderApiResponse = [];
            
            $componentRegistry = new ComponentRegistry($this->_controller);
            $getApiComponent = $this->getMockBuilder('Ebay\Controller\Component\EbayBuyApiComponent')
                ->setMethods(['callOrderApi'])
                ->setConstructorArgs([$componentRegistry, []])
                ->getMock();
            $getApiComponent->expects($this->any())->method('callOrderApi')->will(
                $this->returnValue($orderApiResponse)
            );
            //dd($getApiComponent);
            $this->_controller->EbayBuyApi = $getApiComponent;
        }
        

    }

    public function testAddItems()
    {


        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'item' => [
                [
                    'qty'                => 1,
                    'attributes'         => ["Farbe" => "Rot"],
                    'itemId'             => 'v1|323593478001|512609413917',
                    'ebayGlobalId'       => 'EBAY-DE',
                    'countryCode'        => 'de',
                    'widgetType'         => 'LB',
                    'wrapperLayout'      => 'test',
                    'variantPrice'       => '7.42',
                    'originalPriceValue' => '',
                    'tags'               => ["almost-sold-out" => "Fast ausverkauft"]
                ], [
                    'qty'                => null,
                    'attributes'         => ["Farbe" => "Rot"],
                    'itemId'             => null,
                    'ebayGlobalId'       => 'EBAY-DE',
                    'countryCode'        => 'de',
                    'widgetType'         => '',
                    'wrapperLayout'      => '',
                    'variantPrice'       => '7.42',
                    'originalPriceValue' => '',
                    'tags'               => ["almost-sold-out" => "Fast ausverkauft"]
                ],[]
            ]
        ];
        $this->post(self::CURRENT_URL . '/session/addItems', $data);

        $this->assertResponseSuccess();
    }

    public function testView()
    {
    
        $this->get(self::CURRENT_URL . '/session');
        $this->assertResponseOk();
    }

    public function testCart()
    {
        $this->get(self::CURRENT_URL.'/cart');
        $this->assertResponseOk();
    }


    public function testUnDeleteItem()
    {
        $this->get(self::CURRENT_URL . '/session/undeleteItem/1');
        $this->assertResponseCode(302);
    }

    public function testDeleteItem()
    {
        $this->get(self::CURRENT_URL . '/session/deleteItem/1');
        $this->assertResponseOk();
    }

    public function testSubmit()
    {
            $this->enableCsrfToken();
            $this->enableSecurityToken();
            $this->enableRetainFlashMessages();
            $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
                'X-Requested-With' => 'XMLHttpRequest',
            ]
        ]);
        
        $this->post(self::CURRENT_URL . '/session/submit?key=3d92161d3be2c65a7169bc1a98ad3d');
        $this->assertResponseOk();
    } 

    public function testRemoveItem()
    {
        $this->get(self::CURRENT_URL . '/session/removeItem/324086594399');
        $this->assertResponseCode(302);
    }

    public function testProductView()
    {
        //this function likened with ebayCheckoutItemsController
        $this->get(self::CURRENT_URL . '/product/view/324086594399');
        $this->assertResponseOk();
        
    }

    public function testProductViewByCountry()
    {
        $this->get(self::CURRENT_URL . '/product/view/324086594399/DE');
        $this->assertResponseOk();
    }

    public function testSaveQty()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
       
        $data = [
            'itemId'    => '1',
            'qty'       =>  1,
        ];
        $this->post(self::CURRENT_URL .'/session/saveQty?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testSaveQtyError()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
       
        $data = [
        ];
        $this->post(self::CURRENT_URL .'/session/saveQty?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testGetTotals()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [
           
        ];
        $this->post(self::CURRENT_URL .'/session/getTotals?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }
    public function testSavePayment()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [
           'payment_method_type'    => 'WALLET',
        ];
        $this->post(self::CURRENT_URL .'/session/savePayment?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testSavePaymentEmpty()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [
           
        ];
        $this->post(self::CURRENT_URL .'/session/savePayment?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testGetPayment()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [
           
        ];
        $this->post(self::CURRENT_URL .'/session/getPayment?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testGetApplyCoupon()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [
           
        ];
        $this->post(self::CURRENT_URL .'/session/getApplyCoupon?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testApplyCoupon()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [
           'redemption_code'    => '24',
           
        ];
        $this->post(self::CURRENT_URL .'/session/applyCoupon?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testSaveShippingAddress()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [
            'id'                                => '1',
            'ebay_checkout_session_id'          => '1',
            'recipient'                         => 'fdgfdg dfdsfsdfdsf',
            'address_line_1'                    => 'fdgfdg',
            'address_line_2'                    => '',
            'city'                              => 'sdfdsfdsf',
            'country'                           => 'DE',
            'phone_number'                      => '34234324234',
            'random_phone_number'               => '0',
            'postal_code'                       => '234234',
            'state_or_province'                 => 'sdfdsf',
            'modified'                          => '2019-09-05 17:04:53',
            'created'                           => '2019-09-05 15:22:22',
            'save_address'  => 'agsi test test',
            'first_name'    => 'Raza',
            'last_name'     =>  'Umer',
            'email'         =>  'test@raza.com',
           
        ];
        $this->post(self::CURRENT_URL .'/session/saveShippingAddress?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testSaveShipping()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [
           'itemId' => '1',
           'shippingId' => 'Sparversand aus dem Ausland'
           
        ];
        $this->post(self::CURRENT_URL .'/session/saveShipping?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }

    public function testSaveShippingError()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $this->configRequest([
            'headers' => [
                'Accept'            => 'application/json',
                'X-Requested-With'  => 'XMLHttpRequest',
            ]
        ]);
        $data = [           
        ];
        $this->post(self::CURRENT_URL .'/session/saveShipping?key=3d92161d3be2c65a7169bc1a98ad3d', $data);
        $this->assertResponseOk();
    }
}
