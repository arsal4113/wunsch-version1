<?php

namespace CatchTheme\Controller;

use App\Application;
use Cake\Auth\Storage\SessionStorage;
use Cake\Controller\ErrorController as BaseErrorController;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Core\Configure;
use Feeder\Model\Table\FeederHomepagesTable;

/**
 * Class ErrorController
 * @package CatchTheme\Controller
 * @property FeederHomepagesTable $FeederHomepages
 */
class ErrorController extends BaseErrorController
{
    public function initialize()
    {
        parent::initialize();
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

    /**
     * @param Event $event
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->setTheme('CatchTheme');
        $this->viewBuilder()->setHelpers(['EbayCheckout.EbayCheckout', 'Feeder.Feeder']);
        I18n::setLocale(Configure::read('defaultLanguageCode'));
        $customer = $this->Auth->user();
        if ($customer && $customer->is_active && !isset($customer->wishlist_items_count)) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItemsCount = $this->CustomerWishlistItems->find('all')->where(['customer_id' => $customer->id])->count();
            $customer->wishlist_items_count = $wishlistItemsCount;
            $this->Auth->setUser($customer);
        }
        $this->set('frontUser', $this->Auth->user());
        $this->set('authUser', $this->Auth->user());
        $hideFaceBookChat = false;
        $controller = $this->request->getParam('controller');
        $hideOnController = [
            'EbayCheckoutSessions' => true
        ];
        if (isset($hideOnController[$controller])) {
            $hideFaceBookChat = true;
        }
        $this->set('hideFacebookChat', $hideFaceBookChat);

        $this->loadModel('Feeder.FeederHomepages');
        $feederHomepage = $this->FeederHomepages->find()
            ->cache('homepage_first', Application::SHORT_TERM_CACHE)
            ->first();

        $this->set('catchLogo', $this->FeederHomepages->getCatchLogo($feederHomepage));
    }
}
