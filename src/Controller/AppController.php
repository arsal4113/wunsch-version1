<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Application;
use App\Model\Table\CoreLanguagesTable;
use App\Model\Table\CoreSellersTable;
use Cake\Auth\Storage\SessionStorage;
use Cake\Core\Configure;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Routing\Router;
use Feeder\Model\Table\FeederCategoriesTable;
use Feeder\Model\Table\FeederHomepagesTable;
use ItoolCustomer\Controller\Component\NewsletterHelperComponent;
use Acl\Controller\Component\AclComponent;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 *
 * @property AclComponent $Acl
 * @property CoreLanguagesTable $CoreLanguages
 * @property FeederCategoriesTable $FeederCategories
 * @property NewsletterHelperComponent $NewsletterHelper
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 * @property FeederHomepagesTable $FeederHomepages
 * @property CoreSellersTable $CoreSellers
 */
class AppController extends Controller
{

    /**
     * Default language code
     *
     * @var string
     */
    public $defaultLanguageCode = '';

    /**
     * Selected language code
     *
     * @var string
     */
    public $selectedLanguageCode = '';

    /**
     * Current user data
     *
     * @var array
     */
    public $currentUser = [];

    public $availableLanguageCodes = [];
    public $feederHomepage;
    public $mainLogo;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
        $this->loadComponent('Acl.Acl');
        $this->loadComponent('Flash');

        if (!isset($this->isFrontend) || !$this->isFrontend) {
            $this->loadComponent('Auth', [
                'loginAction' => [
                    'controller' => 'CoreUsers',
                    'action' => 'login',
                    'admin' => false,
                    'plugin' => false
                ],
                'authorize' => [
                    'AclManager.ActionsMulti' => [
                        'actionPath' => null,
                        'userModel' => 'App\Model\Table\CoreUsersTable'
                    ]
                ],
                'authError' => __('Unfortunately the authentication has failed.'),
                'authenticate' => [
                    'Form' => [
                        'userModel' => 'CoreUsers',
                        'fields' => [
                            'username' => 'email'
                        ]
                    ]
                ],
                'loginRedirect' => [
                    'controller' => 'Dashboards',
                    'action' => 'index',
                    'admin' => false,
                    'plugin' => 'Dashboard'
                ],
                'logoutRedirect' => [
                    'controller' => 'CoreUsers',
                    'action' => 'login',
                    'admin' => false,
                    'plugin' => false
                ]
            ]);
        } else {
            $this->loadComponent('Auth', [
                'loginAction' => [
                    'controller' => 'Login',
                    'action' => 'login',
                    'plugin' => 'ItoolCustomer'
                ],
                'authorize' => [
                    'AclManager.ActionsMulti' => [
                        'actionPath' => null,
                        'userModel' => 'ItoolCustomer\Model\Table\CustomersTable'
                    ]
                ],
                'authError' => __('Unfortunately the authentication has failed.'),
                'authenticate' => [
                    'Form' => [
                        'userModel' => 'ItoolCustomer.Customers',
                        'fields' => [
                            'username' => 'email'
                        ]
                    ]
                ],
                'loginRedirect' => [
                    'controller' => 'Account',
                    'action' => 'edit',
                    'plugin' => 'ItoolCustomer'
                ],
                'logoutRedirect' => [
                    'controller' => 'Login',
                    'action' => 'logout',
                    'plugin' => 'ItoolCustomer'
                ]
            ]);
            $sessionStorage = new SessionStorage($this->request, $this->response, ['key' => 'Auth.Customer']);
            $this->Auth->storage($sessionStorage);
            $this->Auth->allow();
        }

        if (empty($this->defaultLanguageCode)) {
            $this->loadModel('CoreLanguages');

            $this->defaultLanguageCode = strtolower(substr($this->request->getEnv('HTTP_ACCEPT_LANGUAGE'), 0, 2));

            $this->availableLanguageCodes = $this->CoreLanguages->find('list', [
                'keyField' => 'id',
                'valueField' => 'iso_code'
            ])
                ->cache('available_language_codes', Application::MEDIUM_TERM_CACHE)
                ->toArray();

            $this->defaultLanguageCode = Configure::read('defaultLanguageCode');
        }
    }

    /**
     * @param Event $event
     * @return null
     */
    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->setTheme('Inspiria');

        $coreLanguageCodes = $this->availableLanguageCodes;
        $currentLanguageCode = $this->selectedLanguageCode;

        $this->set(compact('currentLanguageCode', 'coreLanguageCodes'));
        if (isset($this->isFrontend) && $this->isFrontend) {
            $customer = $this->Auth->user();
            if ($customer && $customer->is_active && !isset($customer->wishlist_items_count)) {
                $this->loadModel('ItoolCustomer.CustomerWishlistItems');
                $wishlistItemsCount = $this->CustomerWishlistItems->find('all')->where(['customer_id' => $customer->id])->count();
                $customer->wishlist_items_count = $wishlistItemsCount;
                $this->Auth->setUser($customer);
            }
            $this->set('frontUser', $this->Auth->user());

            $hideFaceBookChat = false;
            $controller = $this->request->getParam('controller');
            $hideOnController = [
                'EbayCheckoutSessions' => true
            ];
            if (isset($hideOnController[$controller])) {
                $hideFaceBookChat = true;
            }
            $this->set('hideFacebookChat', $hideFaceBookChat);

            $this->loadHomepageConfig();
        }
        if (!isset($this->viewVars['bodyClass'])) {
            $bodyClass = '';
            if ($this->request->getParam('plugin')) {
                $bodyClass .= strtolower($this->request->getParam('plugin') . ' ');
            }
            if ($this->request->getParam('controller')) {
                $bodyClass .= strtolower($this->request->getParam('controller') . ' ');
            }
            if ($this->request->getParam('action')) {
                $bodyClass .= strtolower($this->request->getParam('action'));
            }
            $this->set('bodyClass', $bodyClass);
        }
    }

    /**
     * loadHomepageConfig
     */
    protected function loadHomepageConfig()
    {
        $this->loadModel('Feeder.FeederHomepages');
        $this->feederHomepage = $this->FeederHomepages->find()
            ->contain([
                    'FeederCategories',
                    'FeederHomepageBanners',
                    'FeederHomepageMidpageContainers'
                ]
            )
            ->cache('homepage_first', Application::SHORT_TERM_CACHE)
            ->first();

        $this->set('feederHomepage', $this->feederHomepage);
        $this->mainLogo = $this->FeederHomepages->getCatchLogo($this->feederHomepage);
        $this->set('catchLogo', $this->mainLogo);
    }

    /**
     * CakePHP beforeFilter
     *
     * @param Event $event
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function beforeFilter(Event $event)
    {
        $this->saveUtmParameters();
        $this->saveGclidParameter();

        $this->setSecurityHeaders();

        if (Configure::read('forceSSL')) {
            $this->Security->requireSecure();
            $this->forceSSL();
        }

        $this->Auth->allow(['display', 'setLanguage', 'doNotShowFeatureInfoBox']);

        $lang = strtolower(trim($this->request->getQuery('lang')));
        if (!empty($lang)) {
            $this->setLanguage($lang);
            $redirect = [
                'plugin' => $this->request->getParam('plugin'),
                'controller' => $this->request->getParam('controller'),
                'action' => $this->request->getParam('action')
            ];
            return $this->redirect($redirect);
        }
        $this->setSelectedLanguage();

        if (Configure::read('maintenance.status')) {
            $plugin = Configure::read('maintenance.plugin');
            $controller = Configure::read('maintenance.controller');
            $action = Configure::read('maintenance.action');

            if (strtolower($plugin) != strtolower($this->request->getParam('plugin')) || strtolower($controller) != strtolower($this->request->getParam('controller')) ||
                strtolower($action) != strtolower($this->request->getParam('action'))
            ) {
                return $this->redirect(['controller' => $controller, 'action' => $action, 'plugin' => $plugin]);
            }
        }
        $this->setEbayAffiliateParams();

        $this->currentUser = $this->Auth->user();

        $emailInUse = false;
        if (isset($this->currentUser) && isset($this->currentUser->email)) {
            $this->loadComponent('ItoolCustomer.NewsletterHelper');
            $emailInUse = $this->NewsletterHelper->checkIfSubscribed($this->currentUser->email);
        }

        $this->set('showNewsletterField', !$emailInUse);
        $this->set('authUser', $this->Auth->user());
        if ($this->request->getParam('controller') == 'Browse') {
            $id = $this->request->getParam('id', null);

        } elseif ($this->request->getParam('controller') == 'Products') {
            $id = $this->request->getQuery('categoryId', null);
        } else {
            $id = null;
        }

        $homeUrl = '/';
        $searchUrl = null;
        $childCategories = [];
        $customerSegment = null;
        $this->loadModel('Feeder.FeederCategories');

        $under = $this->request->getQuery('under', false);
        $upper = $this->request->getQuery('upper', false);

        if ($id !== null) {
            $customerSegment = $this->FeederCategories->getCustomerSegment($id);
            if (isset($customerSegment->child_feeder_categories[0]->id)) {
                $homeUrl = Router::url([
                    'controller' => 'Browse',
                    'action' => 'view',
                    'plugin' => 'Feeder',
                    $customerSegment->id,
                    \Cake\Utility\Text::slug($customerSegment->name)
                ]);
            }
        }
        $searchUrl = Router::url([
            'controller' => 'Browse',
            'action' => 'search',
            'plugin' => 'Feeder'
        ]);
        # $childCategories = $this->FeederCategories->getChildCategories($id);

        $this->set('under', $under);
        $this->set('upper', $upper);
        $this->set('selectedCategoryId', $id);
        $this->set('childCategories', $childCategories);
        $this->set('customerSegment', $customerSegment);
        $this->set('searchUrl', $searchUrl);
        $this->set('homeUrl', $homeUrl);
    }

    /**
     * setSecurityHeaders
     */
    public function setSecurityHeaders()
    {
        $this->response = $this->response->withHeader('X-Frame-Options', 'SAMEORIGIN');
        $this->response = $this->response->withHeader('X-Content-Type-Options', 'nosniff');
        $this->response = $this->response->withHeader('X-XSS-Protection', '1');
    }

    /**
     * Force SSL
     *
     * @return \Cake\Http\Response|null
     */
    public function forceSSL()
    {
        // internet explorer POST requests are redirected to the same page if we don't do this check
        if ($this->request->scheme() !== 'https') {
            return $this->redirect('https://' . env('SERVER_NAME') . $this->request->getUri()->getPath());
        }
    }

    /**
     * Set selected language
     *
     * @return string
     */
    public function setSelectedLanguage()
    {
        $this->selectedLanguageCode = $this->request->getSession()->read('core_language_iso_code');
        if (!isset($this->selectedLanguageCode) || empty($this->selectedLanguageCode)) {
            $this->selectedLanguageCode = $this->defaultLanguageCode;
        }
        I18n::setLocale($this->selectedLanguageCode);
    }

    /**
     * Set language
     *
     * @param $language
     */
    public function setLanguage($language)
    {
        $this->autoRender = false;
        if (in_array($language, $this->availableLanguageCodes)) {
            $this->request->getSession()->write('core_language_iso_code', $language);
        }
        $this->selectedLanguageCode = $this->request->getSession()->read('core_language_iso_code');
    }

    /**
     * setEbayAffiliateParams
     */
    public function setEbayAffiliateParams()
    {
        $affiliateRefId = $this->request->getQuery('affRefId');
        $affiliateCampId = $this->request->getQuery('affCampId');

        if (!empty($affiliateRefId) && !empty($affiliateCampId)) {
            $this->request->getSession()->write('EbayAffiliateValidTo', time() + 86400);
            $this->request->getSession()->write('EbayAffiliateReferenceId', $affiliateRefId);
            $this->request->getSession()->write('EbayAffiliateCampaignId', $affiliateCampId);
        } else {
            $affiliateTimestamp = $this->request->getSession()->read('EbayAffiliateValidTo');
            if (!empty($affiliateTimestamp) && ($affiliateTimestamp < time())) {
                $this->request->getSession()->delete('EbayAffiliateValidTo');
                $this->request->getSession()->delete('EbayAffiliateReferenceId');
                $this->request->getSession()->delete('EbayAffiliateCampaignId');
            }
        }
    }

    /**
     * saveUtmParameters
     */
    protected function saveUtmParameters()
    {
        $utmParameters = [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_content'
        ];

        if (!empty(array_intersect(array_keys($this->request->getQueryParams()), $utmParameters))) {
            $this->request->getSession()->write('utm_timestamp', time());
            foreach ($utmParameters as $utmParameter) {
                if (!empty($this->request->getQuery($utmParameter))) {
                    $this->request->getSession()->write($utmParameter, $this->request->getQuery($utmParameter));
                } else {
                    $this->request->getSession()->delete($utmParameter);
                }
            }
        }
    }

    /**
     * saveGclidParameter
     */
    protected function saveGclidParameter()
    {
        if (!empty($this->request->getQuery('gclid'))) {
            $this->request->getSession()->write('utm_timestamp', time());
            $this->request->getSession()->write('utm_source', 'gclid');
            $this->request->getSession()->write('utm_campaign', $this->request->getQuery('gclid'));
        }
    }
}
