<?php

namespace Feeder\Controller;

use App\Application;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\Routing\Router;
use Feeder\Model\Table\FeederHomepageMidpageContainersTable;
use Feeder\Model\Table\FeederHomepagesTable;
use ItoolCustomer\Model\Entity\Customer;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

/**
 * FeederHomepages Controller
 *
 * @property FeederHomepagesTable $FeederHomepages
 * @property Customer $currentUser
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 *
 * FeederHomepageMidpageContainers Controller
 * @property FeederHomepageMidpageContainersTable $FeederHomepageMidpageContainers
 *
 * @method \Feeder\Model\Entity\FeederHomepageMidpageContainer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomepageController extends AppController
{
    /**
     * @throws \Exception
     */
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     * BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return \Cake\Http\Response|void|null
     * @throws \Exception
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'index',
        ]);
    }

    /**
     * BeforeRender
     *
     * @param Event $event
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $theme = Configure::read('ebayCheckout.theme', null) ?? 'Feeder';
        $this->viewBuilder()->setTheme($theme);
        $this->viewBuilder()->setHelpers(['Feeder.Feeder']);
    }

    /**
     * index
     */
    public function index()
    {
        $customer = $this->Auth->user();
        $wishlistItems = [];
        if ($customer) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItems = $this->CustomerWishlistItems->getWishlistItemsForCustomer($customer);
        }

        $this->set('feederHomepageMidpageContainer', $this->feederHomepage->feeder_homepage_midpage_container ?? null);
        $this->set('wishlistItems', $wishlistItems);
        $this->set('searchUrl', Router::url([
            'controller' => 'Browse',
            'action' => 'search',
            'plugin' => 'Feeder'
        ]));
    }
}
