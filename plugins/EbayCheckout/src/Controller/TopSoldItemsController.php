<?php

namespace EbayCheckout\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use EbayCheckout\Controller\Component\TopSoldItemsComponent;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

/**
 * TopSoldItems Controller
 *
 *
 * @method \EbayCheckout\Model\Entity\TopSoldItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property TopSoldItemsComponent $TopSoldItems
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 */
class TopSoldItemsController extends AppController
{
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
        $this->Auth->allow(['getTopSoldItemsList']);
    }

    /**
     * BeforeRender
     *
     * @param Event $event
     * @return empty
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $theme = Configure::read('ebayCheckout.theme', null) ?? 'EbayCheckout';
        $this->viewBuilder()->setTheme($theme);
        $this->viewBuilder()->setHelpers(['EbayCheckout.EbayCheckout', 'Feeder.Feeder']);
    }

    /**
     * getTopSoldItemsList
     */
    public function getTopSoldItemsList()
    {
        $ajax = false;
        if ($this->request->is('ajax') || $this->request->getQuery('type') === 'react') {
            $ajax = true;
            $this->viewBuilder()->setLayout('ajax');
        }

        $this->set('ajax', $ajax);

        $customer = $this->Auth->user();
        $wishlistItems = [];
        if ($customer) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItems = $this->CustomerWishlistItems->getWishlistItemsForCustomer($customer);
        }

        $ebayCategoryPath = $this->request->getQuery('ebayCategoryPath');

        $this->set('ajax', $ajax);
        $this->set('wishlistItems', $wishlistItems);
        $this->set('ebayCategoryPath', $ebayCategoryPath);
    }
}
