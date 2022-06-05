<?php

namespace Feeder\Controller;

use App\Model\Table\CoreConfigurationsTable;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Number;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use Feeder\Model\Table\FeederInterestsTable;
use ItoolCustomer\Model\Table\CustomersTable;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

/**
 * Interests Controller
 * @property CustomersTable $Customers
 * @property FeederInterestsTable $FeederInterests
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 * @property CoreConfigurationsTable $CoreConfigurations
 *
 * @method \Feeder\Model\Entity\Interest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InterestsController extends AppController
{
    const CONFIG_GROUP = 'FeederInterests';
    const META_TITLE_CONFIG_PATH = 'interests/metaTitle';
    const META_DESCRIPTION_CONFIG_PATH = 'interests/metaDescription';

    /**
     * @throws \Exception
     */
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     * @param Event $event
     * @return \Cake\Http\Response|void|null
     * @throws \Exception
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'view',
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
        //$this->set('feederHomepage', $this->FeederHomepages->get(1));
    }

    /**
     * View method
     *
     * @return \Cake\Http\Response|void
     */
    public function view()
    {
        $filter = [
            'page' => h($this->request->getQuery('page', 1)),
            'limit' => h($this->request->getQuery('limit', 30))
        ];

        $account = $this->Auth->user();
        if($account === null){
            return $this->redirect([
                'plugin' => 'ItoolCustomer',
                'controller' => 'Login',
                'action' => 'login',
                '/interests'
            ]);
        }
        $account = (object)$account;
        $this->loadModel('ItoolCustomer.Customers');
        $customer = $this->Customers->get($account->id, [
            'contain' => ['FeederInterestSubcategories']
        ]);

        $ebaySiteCurrency = 'EUR';

        $searchRequest = new SearchItemsRequest();
        $this->loadModel('Feeder.FeederInterests');
        foreach ($customer->feeder_interest_subcategories as $subcategory) {
            $searchItemFilter = new SearchItemFilter();
            $searchItemFilter->setEbayGlobalId('EBAY-DE');
            $searchItemFilter->setCurrency($ebaySiteCurrency);
            if($subcategory->sale_only){
                $searchItemFilter->setOriginalPriceFrom(0.1);
            }
            if ($subcategory->type === "items") {
                $searchItemFilter->setItemLegacyIds(explode(';', str_replace(',', ';', $subcategory->ids)));
            } else {
                $searchItemFilter->setCategoryIds(explode(';', str_replace(',', ';', $subcategory->ids)));
            }
            $searchRequest->appendSearchItemFilter($searchItemFilter);
        }
        $searchRequest->setLimit($filter['limit']);
        $searchRequest->setPage($filter['page']);
        $session = new Session();
        $session->setRequest($searchRequest);
        $session->setAccessToken(Configure::read('eis.token'));
        $response = $session->sendRequest();

        foreach ($response->Result as &$item) {
            //Ei caramba! @TODO: Rework
            @$item->{"display_price"} = Number::currency($item->price, $item->currency);
            @$item->{"display_original_price"} = null;
            if (strpos($item->image_url, 'i.ebayimg.com') !== false) {
                $urlArray = explode('/', $item->image_url);
                $imageId = $urlArray[count($urlArray) - 2] ?? null;
                if (strlen($imageId) > 6 && $imageId) {
                    @$item->{"thumbnail_url"} = 'https://i.ebayimg.com/images/g/' . $imageId . '/s-l300.jpg';
                }
            }
        }

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('empty');
        }

        $wishlistItems = [];
        if ($customer) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItems = $this->CustomerWishlistItems->getWishlistItemsForCustomer($customer);
        }
        $customer->wishlist_items_count = empty($wishlistItems) ? 0 : count($wishlistItems) - 1;

        $this->loadModel('CoreConfigurations');
        $uuid = Configure::read('dealsguru.uuid', false);
        $metaTitle = null;
        $metaDescription = null;
        if ($uuid) {
            $this->loadModel('CoreSellers');
            $coreSeller = $this->CoreSellers->find('all')->where(['uuid' => $uuid])->first();
            $metaTitle = $this->CoreConfigurations->loadSellerConfiguration($coreSeller->id, self::CONFIG_GROUP . '/' . self::META_TITLE_CONFIG_PATH, null);
            $metaDescription = $this->CoreConfigurations->loadSellerConfiguration($coreSeller->id, self::CONFIG_GROUP . '/' . self::META_DESCRIPTION_CONFIG_PATH, null);
        }

        $this->set('metaTitle', $metaTitle);
        $this->set('metaDescription', $metaDescription);
        $this->set('wishlistItems', $wishlistItems);
        $this->set('items', $response->Result);
        $this->set('filter', $filter);
        $this->set('authUser', $customer);
        $this->set('isAjax', $this->request->is('ajax'));
    }
}
