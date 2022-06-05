<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 31.08.18
 * Time: 10:52
 */

namespace ItoolCustomer\Controller;

use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\I18n\Number;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Request;
use Cake\Routing\Router;
use Ebay\Controller\Component\EbayBuyApiComponent;
use Ebay\Model\Table\EbayAccountsTable;
use EbayCheckout\Model\Entity\EbayCheckoutSession;
use EbayCheckout\Model\Table\EbayCheckoutSessionsTable;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use Feeder\Model\Entity\FeederHeroItem;
use Feeder\Model\Entity\FeederInterestSubcategory;
use Feeder\Model\Table\FeederCategoriesTable;
use Feeder\Model\Table\FeederHeroItemsTable;
use \Feeder\Model\Table\FeederInterestsTable;
use \Feeder\Model\Table\FeederInterestSubcategoriesTable;
use function foo\func;
use ItoolCustomer\Controller\Component\WishlistComponent;
use ItoolCustomer\Model\Entity\Customer;
use ItoolCustomer\Model\Table\CustomerAddressesTable;
use ItoolCustomer\Model\Table\CustomersTable;
use ItoolCustomer\Model\Table\CustomerWishlistConfigurationsTable;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

/**
 * Class AccountController
 * @package ItoolCustomer\Controller
 * @property CustomersTable $Customers
 * @property EbayCheckoutSessionsTable $EbayCheckoutSessions
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 * @property CustomerWishlistConfigurationsTable $CustomerWishlistConfigurations
 * @property CustomerAddressesTable $CustomerAddresses
 * @property EbayAccountsTable $EbayAccounts
 * @property EbayBuyApiComponent $EbayBuyApi
 * @property FeederCategoriesTable $FeederCategories
 * @property FeederHeroItemsTable $FeederHeroItems
 * @property FeederInterestsTable $FeederInterests
 * @property FeederInterestSubcategoriesTable $FeederInterestSubcategories
 * @property WishlistComponent $Wishlist
 */
class AccountController extends AppController
{
    const CACHE_PRODUCT_KEY = 'ebay_checkout_item_';

    /**
     * BeforeRender
     *
     * @param Event $event
     * @return empty
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        //$this->set('feederHomepage', $this->loadModel('Feeder.FeederHomepages')->get(1));
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        /** @var Customer $customer */
        $customer = $this->Auth->user();
        if ((!$customer || !$customer->id ?? false) && !$this->request->is('ajax')) {
            return $this->redirect(
                $this->Auth->getConfig('loginAction')
                + [
                    '?' =>
                        [
                            'redirect' => $this->request->getRequestTarget()
                        ]
                ]
            );
        }
    }

    public function orders()
    {
        $this->paginate = [
            'limit' => 10,
        ];
        $this->loadComponent('Paginator');

        $customer = $this->Auth->user();
        $ebayCheckoutSessions = [];
        if ($customer && $customer->id ?? false) {
            $this->loadModel('EbayCheckout.EbayCheckoutSessions');
            $ebayCheckoutSessions = $this->EbayCheckoutSessions->find('all')->where([
                'customer_id' => $customer->id,
                'purchase_order_id IS NOT' => null
            ])->contain(
                [
                    'EbayCheckoutSessionItems.SelectedEbayCheckoutSessionItemShippings',
                    'EbayCheckoutSessionTotals'
                ]
            )->order(['EbayCheckoutSessions.created' => 'desc']);
        }
        $this->set('ebayCheckoutSessions', $this->paginate($ebayCheckoutSessions));

    }

    public function orderView($id = null)
    {
        $this->viewBuilder()->setHelpers(['EbayCheckout.EbayCheckout']);
        $customer = $this->Auth->user();
        $ebayCheckoutSession = false;
        $ebayCheckoutSessionItemsBySeller = [];
        if ($customer && $customer->id ?? false) {
            $this->loadModel('EbayCheckout.EbayCheckoutSessions');
            /** @var EbayCheckoutSession $ebayCheckoutSession */
            $ebayCheckoutSession = $this->EbayCheckoutSessions->find('all')
                ->where(['customer_id' => $customer->id, 'purchase_order_id' => $id])
                ->contain([
                    'EbayCheckoutSessionItems',
                    'EbayCheckoutSessionItems.SelectedEbayCheckoutSessionItemShippings',
                    'EbayCheckoutSessionTotals',
                    'EbayCheckoutSessionShippingAddresses',
                    'SelectedEbayCheckoutSessionPayments'
                ])
                ->first();
            if ($ebayCheckoutSession && !empty($ebayCheckoutSession->ebay_checkout_session_items)) {
                foreach ($ebayCheckoutSession->ebay_checkout_session_items as $ebayCheckoutSessionItem) {
                    if (!isset($ebayCheckoutSessionItemsBySeller[$ebayCheckoutSessionItem->seller_username])) {
                        $ebayCheckoutSessionItemsBySeller[$ebayCheckoutSessionItem->seller_username] = [];
                    }
                    $ebayCheckoutSessionItemsBySeller[$ebayCheckoutSessionItem->seller_username][] = $ebayCheckoutSessionItem;
                }
            }
        }
        $this->set('ebayCheckoutSessionItemsBySeller', $ebayCheckoutSessionItemsBySeller);
        $this->set('ebayCheckoutSession', $ebayCheckoutSession);
    }

    public function wishlist()
    {
        $customer = $this->Auth->user();
        /** @var Customer $customer */
        if ($customer && !empty($customer->id)) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItemsCount = $this->CustomerWishlistItems->find('all')->where(['customer_id' => $customer->id])->count();
            $customer->wishlist_items_count = $wishlistItemsCount;
            $this->Auth->setUser($customer);
            $wishlistItems = [];
            $this->loadModel('Feeder.FeederCategories');
            $this->loadModel('Feeder.FeederHeroItems');
            $this->loadModel('ItoolCustomer.CustomerWishlistConfigurations');
            $smallBanners = [];
            $largeBanners = [];
            $smallBannerSlots = [];
            $smallShownBanners = [];
            $largeBannerSlots = [];
            $largeShownBanners = [];
            $feederHeroItems = $this->FeederHeroItems->find('all');

            if ($customer->gender == 'M') {
                $feederHeroItems->where(['gender_id' => 2]);
            } elseif ($customer->gender == 'F') {
                $feederHeroItems->where(['gender_id' => 3]);
            } else {
                $feederHeroItems->where(['gender_id' => 1]);
            }

            try {
                $customerWishlistConfiguration = $this->CustomerWishlistConfigurations->get(1, [
                    'contain' => []
                ]);
            } catch (RecordNotFoundException $e) {
                $customerWishlistConfiguration = false;
            }

            $qty = $customerWishlistConfiguration->banner_products_factor ?? CustomerWishlistConfigurationsTable::BANNER_PRODUCTS_FACTOR;
            foreach ($feederHeroItems ?? [] as $feederHeroItem) {
                if (empty($feederHeroItem->is_active) && empty($feederHeroItem->url)) {
                    continue;
                }
                if ($feederHeroItem->type == 1) {
                    $smallBanners[] = $feederHeroItem;
                } elseif ($feederHeroItem->type == 2) {
                    $largeBanners[] = $feederHeroItem;
                }
            }
            if ($customerWishlistConfiguration && $customerWishlistConfiguration->randomize) {
                shuffle($smallBanners);
                shuffle($largeBanners);
            }

            $smallBannerPositions = null;
            $largeBannerPositions = null;
            if ($customerWishlistConfiguration ?? false) {
                $smallBannerPositions = $this->getBannerSlots($customerWishlistConfiguration->banner_small_positions, CustomerWishlistConfigurationsTable::BANNER_SMALL_POSITIONS);
                $largeBannerPositions = $this->getBannerSlots($customerWishlistConfiguration->banner_large_positions, CustomerWishlistConfigurationsTable::BANNER_LARGE_POSITIONS);
            }

            $page = $this->request->getQuery('page', 1);
            if ($smallBannerPositions != null || $largeBannerPositions != null) {
                $bannerStartSlot = $this->FeederCategories->getBannerStartSlot($qty, $page, $qty);

                $slots = $this->FeederCategories->getBannerSlots($qty, $bannerStartSlot, $smallBannerPositions,
                    $largeBannerPositions, $qty, $smallBanners, $largeBanners);
                $smallBannerSlots = $slots['smallBannerSlots'] ?? [];
                $largeBannerSlots = $slots['largeBannerSlots'] ?? [];

                $smallBannerShown = $this->FeederCategories->getBannerShownCount($qty, $page, $smallBannerPositions,
                    $qty);
                $largeBannerShown = $this->FeederCategories->getBannerShownCount($qty, $page, $largeBannerPositions,
                    $qty);

                if (!empty($smallBanners)) {
                    $smallShownBanners = $this->FeederCategories->getShownBanners($smallBanners, $smallBannerShown,
                        count($smallBannerSlots));
                }

                if (!empty($largeBanners)) {
                    $largeShownBanners = $this->FeederCategories->getShownBanners($largeBanners, $largeBannerShown,
                        count($largeBannerSlots));
                }
                if (!empty($smallBanners) || !empty($largeBanners)) {
                    $qty -= (count($smallBannerSlots) + (count($largeBannerSlots) * 2));
                }
            }

            if (!empty($smallBanners) || !empty($largeBanners)) {
                $itemCount = $qty + (count($smallBannerSlots) + (count($largeBannerSlots)));
            } else {
                $itemCount = $qty;
            }

            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItems = $this->CustomerWishlistItems->find('all')->where(['customer_id' => $customer->id])->toArray();
            if (count($wishlistItems) > 0) {
                if (($smallBannerPositions != null || $largeBannerPositions != null) && $itemCount != $qty) {
                    $smallCount = 0;
                    $largeCount = 0;
                    $bannerArray = [];
                    for ($i = 0; $i <= count($wishlistItems); $i++) {
                        if ($smallCount < count($slots['smallBannerSlots']) && $slots['smallBannerSlots'][$smallCount] == $i) {
                            $bannerArray['type'] = 'smallBanner';
                            array_splice($wishlistItems, $i, 0, $bannerArray);
                            $smallCount++;
                        } else {
                            if ($largeCount < count($slots['largeBannerSlots']) && $slots['largeBannerSlots'][$largeCount] == $i) {
                                $bannerArray['type'] = 'largeBanner';
                                array_splice($wishlistItems, $i, 0, $bannerArray);
                                $largeCount++;
                            }
                        }
                    }
                }
            }
            $filter = [
                'page' => h($this->request->getQuery('page', 0)),
                'limit' => h($this->request->getQuery('limit', 50))
            ];
            $wishlistItemsLimit = array_chunk( $wishlistItems, $filter['limit'], true);
            $this->set('itemCount', $itemCount);
            $this->set('filter', $filter);
            $this->set('banner_page', null);
            $this->set('smallBannerSlots', $smallBannerSlots);
            $this->set('smallShownBanners', $smallShownBanners);
            $this->set('largeBannerSlots', $largeBannerSlots);
            $this->set('page', $page);
            $this->set('largeShownBanners', $largeShownBanners);
        }

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('empty');
        }
        $this->set('wishlistItems', $wishlistItemsLimit[$filter['page']]);
    }

    public function wishlistAdd($ebayItemId)
    {
        $customer = $this->Auth->user();
        $success = false;
        if ($customer && !empty($customer->id)) {
            $this->loadComponent('ItoolCustomer.Wishlist');
            $wishlistItem = $this->Wishlist->addItemToWishlist($customer, $ebayItemId);
            if ($wishlistItem) {
                $customer->wishlist_items_count = $customer->wishlist_items_count + 1;
                $success = true;
            } else {
                $this->Flash->error(__('Item not found'));
            }
            if ($this->request->is('ajax')) {
                $this->viewBuilder()->setClassName('Json');
                $this->viewBuilder()->setLayout('ajax');
                preg_match('/(?<=\|)(.*?)(?=\|)/', $wishlistItem->ebay_item_id, $matches); // preprocessing..
                $ebay_item_id = (isset($matches[0])
                    ? $matches[0]
                    : $wishlistItem->ebay_item_id);
                $this->set('response', [
                    'success' => $success,
                    'item_name' => $wishlistItem->name ?? null,
                    'item_sku' => $ebay_item_id ?? null
                ]);
                $this->set('_serialize', ['response']);
            } else {
                $this->redirect(['action' => 'wishlist']);
            }
        }
    }

    public function wishlistRemove($ebayItemId)
    {
        $customer = $this->Auth->user();
        $success = false;
        if ($customer && !empty($customer->id)) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItem = $this->CustomerWishlistItems->find('all')->where([
                'customer_id' => $customer->id,
                'ebay_item_id' => $ebayItemId
            ])->first();
            if ($wishlistItem) {
                if ($this->CustomerWishlistItems->delete($wishlistItem)) {
                    $success = true;
                    $customer->wishlist_items_count = $customer->wishlist_items_count - 1;
                    $this->Auth->setUser($customer);
                }
            }
            if ($this->request->is('ajax')) {
                $this->viewBuilder()->setClassName('Json');
                $this->viewBuilder()->setLayout('ajax');
                preg_match('/(?<=\|)(.*?)(?=\|)/', $wishlistItem->ebay_item_id, $matches); // preprocessing..
                $ebay_item_id = (isset($matches[0])
                    ? $matches[0]
                    : $wishlistItem->ebay_item_id);
                $this->set('response', [
                    'success' => $success,
                    'item_name' => $wishlistItem->name ?? null,
                    'item_sku' => $ebay_item_id ?? null
                ]);
                $this->set('_serialize', ['response']);
            } else {
                $this->redirect($this->referer());
            }
        } else {
            if ($this->request->is('ajax')) {
                $this->viewBuilder()->setClassName('Json');
                $this->viewBuilder()->setLayout('ajax');
                $this->set('response', [
                    'redirect' => Router::url($this->Auth->getConfig('loginAction')
                        + [
                            '?' =>
                                [
                                    'redirect' => $this->request->getRequestTarget()
                                ]
                        ])
                ]);
                $this->set('_serialize', ['response']);
            }
        }

    }

    public function interests($viewSetting = null)
    {
        $account = $this->Auth->user();

        if (!$account && !$account->id ?? false) {
            return $this->redirect($this->Auth->getConfig('loginAction'));
        }

        $this->set('customer', $account);

        $this->loadModel('ItoolCustomer.Customers');
        $customer = $this->Customers->get($account->id, [
            'contain' => ['FeederInterestSubcategories']
        ]);

        if ($customer && !empty($customer->id)) {
            $this->loadModel('ItoolCustomer.Customers');
            $customerWithInterest = $this->Customers->get($customer->id, [
                'contain' => ['FeederInterestSubcategories']
            ]);
            if (!empty($customerWithInterest->feeder_interest_subcategories)) {
                if ($viewSetting !== 'override') {
                    return $this->redirect([
                        'controller' => 'Interests',
                        'action' => 'view',
                        'plugin' => 'Feeder'
                    ]);
                }
            }

            $this->loadModel('Feeder.FeederInterests');
            $feederInterests = $this->FeederInterests->find('all', ['contain' => ['FeederInterestSubcategories']])->where([
                //'gender_id' => $customer->gender
            ]);

            $selectedSubCategories = [];
            if(isset($customer->feeder_interest_subcategories)){
                foreach($customer->feeder_interest_subcategories as $feederInterestSubcategory){
                    $parentIds = explode(';', $feederInterestSubcategory->_joinData->feeder_interest_id);
                    foreach($parentIds as $parentId){
                        if(!isset($selectedSubCategories[$parentId])){
                            $selectedSubCategories[$parentId] = [$feederInterestSubcategory->id];
                        }else{
                            array_push($selectedSubCategories[$parentId], $feederInterestSubcategory->id);
                        }
                    }
                }
            }

            $this->set('selectedSubCats', $selectedSubCategories);
            $this->set('feederInterests', $feederInterests);
        }
    }

    public function saveInterests()
    {
        $customer = $this->Auth->user();
        $this->loadModel('ItoolCustomer.Customers');
        $customerEntity = $this->Customers->get($customer->id, [
            'contain' => ['FeederInterestSubcategories']
        ]);

        if ($this->request->is(['post'])) {
            try {
                $categoryIds = $this->request->getData();
                $data['feeder_interest_subcategories'] = [];
                $chosenCategories = json_decode($categoryIds['subcategoryIds']);

                foreach($chosenCategories as $subCatId => $interestIds) {
                    array_push($data['feeder_interest_subcategories'],
                        [
                            'id' => $subCatId,
                            '_joinData' => [
                                'feeder_interest_id' => implode(';', $interestIds)
                            ]
                        ]);
                }
                $customerEntity = $this->Customers->patchEntity($customerEntity, $data);
                if ($this->Customers->save($customerEntity)) {
                    //$this->Flash->success(__('You successfully saved your interests!'));
                }
            } catch (\Exception $e) {
                //$this->Flash->error(__('There was an error saving your interests. Please try again.'));
            }
        }
        return $this->redirect([
            'controller' => 'Interests',
            'action' => 'view',
            'plugin' => 'Feeder'
        ]);
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function edit()
    {
        $customer = $this->Auth->user();

        if (!$customer && !$customer->id ?? false) {
            return $this->redirect($this->Auth->getConfig('loginAction'));
        }

        $this->set('customer', $customer);
        if ($customer && !empty($customer->id)) {
            $this->loadModel('ItoolCustomer.CustomerAddresses');
            $customerAddress = $this->CustomerAddresses->find('all')
                ->where(['CustomerAddresses.customer_id' => $customer->id])
                ->contain(['CoreCountries'])
                ->first();

            if ($this->request->is(['post', 'put'])) {
                $data = $this->request->getData();
                if ($data['type'] == 'password') {
                    $this->loadModel('ItoolCustomer.Customers');
                    $customer = $this->Customers->patchEntity($customer, $this->request->getData(),
                        ['validate' => 'changePassword']);
                    if ($this->Customers->save($customer)) {
                        $this->Flash->success(__d('itool_customer', 'Password changed'), ['key' => 'password_success']);
                        return $this->redirect([
                            'controller' => 'Account',
                            'action' => 'edit',
                            'plugin' => 'ItoolCustomer'
                        ]);
                    } else {
                        $this->Flash->error(__d('itool_customer', 'Ups! This did not work!'),
                            ['key' => 'password_error']);
                    }
                }
                if ($data['type'] == 'customer') {
                    $this->loadModel('ItoolCustomer.Customers');
                    $customer = $this->Customers->patchEntity($customer, $data);
                    if ($this->Customers->save($customer)) {
                        $this->Flash->success(__d('itool_customer', 'Contact data changed'),
                            ['key' => 'customer_success']);
                    } else {
                        $this->Flash->error(__d('itool_customer', 'Ups! This did not work!'),
                            ['key' => 'customer_error']);
                    }
                }
                if ($data['type'] == 'customer_address') {
                    if ($customerAddress) {
                        $customerAddress = $this->CustomerAddresses->patchEntity($customerAddress, $data);
                    } else {
                        $customerAddress = $this->CustomerAddresses->newEntity($data);
                    }
                    $customerAddress->customer_id = $customer->id;
                    $customerAddress->core_country_id = Configure::read('dealsguru.core_country_id', 1);

                    if ($this->CustomerAddresses->save($customerAddress)) {
                        $customerAddress = $this->CustomerAddresses->find('all')
                            ->where(['CustomerAddresses.customer_id' => $customer->id])
                            ->contain(['CoreCountries'])
                            ->first();
                        $this->Flash->success(__d('itool_customer', 'Shipping address changed'),
                            ['key' => 'address_success']);
                    } else {
                        $this->Flash->error(__d('itool_customer', 'Ups! This did not work!'),
                            ['key' => 'address_error']);
                    }
                }
                if ($data['type'] == 'delete') {
                    $this->loadModel('ItoolCustomer.Customers');
                    $customer = $this->Customers->patchEntity($customer, $this->request->getData());
                    if ($this->Customers->save($customer)) {
                        $this->Flash->success(__d('itool_customer', 'Delete Account'), ['key' => 'delete_success']);
                        return $this->redirect([
                            'controller' => 'Account',
                            'action' => 'delete',
                            'plugin' => 'ItoolCustomer'
                        ]);
                    }
                }
            }
            $this->set('customerAddress', $customerAddress);
            $this->set('customer', $customer);
        }
    }

    public function delete()
    {
        $this->autoRender = false;
        $customer = $this->Auth->user();
        if ($customer && !empty($customer->id)) {

            if ($this->request->is(['post', 'delete'])) {
                $this->loadModel('ItoolCustomer.Customers');
                $this->Auth->logout();
                $this->Customers->Newsletters->deleteAll(['customer_id' => $customer->id]);
                if ($this->Customers->delete($customer)) {
                    $this->Flash->deleteSuccess(__d('itool_customer', 'Your account has been removed'));
                    //$this->Flash->success(__d('itool_customer', 'Deleted successfully'));
                }
            }
        }
        //return $this->redirect(Router::url($this->Auth->getConfig('loginAction')));
        return $this->redirect(Router::url('/', true));
    }

    protected function getBannerSlots($bannerPositions, $defaultBannerPositions) {
        if ($bannerPositions === null) {
            return $defaultBannerPositions;
        }
        if (!$bannerPositions && $bannerPositions !== "0") {
            return null;
        }
        return explode(',', $bannerPositions);
    }
}
