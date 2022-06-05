<?php
namespace ItoolCustomer\Controller;

use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use ItoolCustomer\Controller\AppController;
use ItoolCustomer\Model\Table\CustomerWishlistConfigurationsTable;

/**
 * CustomerWishlistConfiguration Controller
 * @package ItoolCustomer\Controller
 *
 * @property \ItoolCustomer\Model\Table\CustomerWishlistConfigurationsTable $CustomerWishlistConfigurations
 */
class CustomerWishlistConfigurationController extends \App\Controller\AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['configure', 'index']);
        $this->loadModel('ItoolCustomer.CustomerWishlistConfigurations');
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->setTheme('Inspiria');
    }

    public function index(){
        $customerWishlistConfigurations = $this->paginate($this->CustomerWishlistConfigurations);

        $this->set(compact('customerWishlistConfigurations'));
    }

    public function configure()
    {
        $id = 1;
        try {
            $customerWishlistConfiguration = $this->CustomerWishlistConfigurations->get($id, [
                'contain' => []
            ]);
        } catch (RecordNotFoundException $e) {
            $customerWishlistConfiguration = $this->CustomerWishlistConfigurations->newEntity();
            $customerWishlistConfiguration->id = $id;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customerWishlistConfiguration = $this->CustomerWishlistConfigurations->patchEntity($customerWishlistConfiguration, $this->request->getData());
            if ($this->CustomerWishlistConfigurations->save($customerWishlistConfiguration)) {
                $this->Flash->success(__('The Wishlist configurations have been saved.'));
                return $this->redirect(['action' => 'configure']);
            } else {
                $this->Flash->error(__('The Wishlist configurations could not be saved. Please try again.'));
            }
        }
        $this->set(compact('customerWishlistConfiguration'));
        $this->set('_serialize', ['customerWishlistConfiguration']);
        $this->set('defaultSmallBannerPos', CustomerWishlistConfigurationsTable::BANNER_SMALL_POSITIONS);
        $this->set('defaultLargeBannerPos', CustomerWishlistConfigurationsTable::BANNER_LARGE_POSITIONS);
        $this->set('defaultProductsFactor', CustomerWishlistConfigurationsTable::BANNER_PRODUCTS_FACTOR);
    }
}