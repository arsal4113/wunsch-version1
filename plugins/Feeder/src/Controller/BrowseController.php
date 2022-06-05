<?php

namespace Feeder\Controller;

use App\Application;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Routing\Router;
use EisSdk\Entity\AutoComplete;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\AutoCompleteItemsRequest;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use Feeder\Model\Table\FeederCategoriesTable;
use Feeder\Model\Table\FeederFizzyBubblesTable;
use Feeder\Model\Table\FeederHomepagesTable;
use Feeder\Model\Table\FeederPillarPagesTable;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

/**
 * FeederCategories Controller
 * @property FeederFizzyBubblesTable $FeederFizzyBubbles
 * @property FeederCategoriesTable $FeederCategories
 * @property FeederPillarPagesTable $FeederPillarPages
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 * @property FeederHomepagesTable $FeederHomepages
 *
 * @method Feeder\Model\Entity\FeederCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BrowseController extends AppController
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
            'view',
            'search',
            'suggest'
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
     * View method
     *
     * @param null $id
     */
    public function view($id = null)
    {
        $this->loadModel('Feeder.FeederCategories');

        $this->FeederCategories->addBehavior('Feeder.TimeRange');
        $this->FeederCategories->ChildFeederCategories->addBehavior('Feeder.TimeRange');
        $this->FeederCategories->ParentFeederCategories->addBehavior('Feeder.TimeRange');

        $categoryWithItems = $this->FeederCategories->getFeederCategoryWithItems($id, $this->request);

        $items = $categoryWithItems['items'] ?? [];
        $feederCategory = $categoryWithItems['feeder_category'] ?? null;
        $customerSegmentSelected = $categoryWithItems['customer_segment_selected'] ?? null;
        $itemCount = $categoryWithItems['item_count'] ?? $feederCategory->banner_products_factor ?? null;
        $bannerPage = $categoryWithItems['banner_page'] ?? null;
        $smallBannerSlots = $categoryWithItems['small_banner_slots'] ?? [];
        $smallShownBanners = $categoryWithItems['small_shown_banners'] ?? [];
        $largeBannerSlots = $categoryWithItems['large_banner_slots'] ?? [];
        $largeShownBanners = $categoryWithItems['large_shown_banners'] ?? [];
        $filter = $categoryWithItems['filter'] ?? [];

        $ajax = false;
        if ($this->request->is('ajax')) {
            $ajax = true;
            $this->viewBuilder()->setLayout('empty');
        }

        $customer = $this->Auth->user();
        $wishlistItems = [];
        if ($customer) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItems = $this->CustomerWishlistItems->getWishlistItemsForCustomer($customer);
        }

        $this->loadModel('Feeder.FeederFizzyBubbles');

        $feederFizzyBubbles = $this->FeederFizzyBubbles->find()
            ->where([
                'FeederFizzyBubbles.active' => true,
                'OR' => [['FeederFizzyBubbles.use_on' => 'BOTH'], ['FeederFizzyBubbles.use_on' => 'BROWSE']]
            ])
            ->cache(FeederFizzyBubblesTable::FIZZY_BUBBLES_BOTH_BROWSE_CACHE_KEY, Application::SHORT_TERM_CACHE)
            ->orderAsc('sort_order')
            ->toArray();

        $time = Time::now();
        $remove = [];
        foreach ($feederFizzyBubbles as $fizzyBubble) {
            if (($fizzyBubble->start_time > $time || $fizzyBubble->end_time < $time) &&
                ($fizzyBubble->start_time !== null && $fizzyBubble !== null)) {
                array_push($remove, $fizzyBubble);
            }
        }
        if (!empty($remove)) {
            $feederFizzyBubbles = array_diff($feederFizzyBubbles, $remove);
            $feederFizzyBubbles = array_values($feederFizzyBubbles);
        }

        $this->set('fizzyBubbles', $feederFizzyBubbles);
        $this->set('ajax', $ajax);
        $this->set('wishlistItems', $wishlistItems);
        $this->set('feederCategory', $feederCategory);
        $this->set('customerSegmentSelected', $customerSegmentSelected);
        $this->set('under', ((is_numeric($filter['under']) && $filter['under'] <= $feederCategory->price_to)) ? $filter['under'] : $feederCategory->price_to);
        $this->set('upper', ((is_numeric($filter['upper']) && $filter['upper'] >= $feederCategory->price_from)) ? $filter['upper'] : $feederCategory->price_from);
        $this->set('itemCount', $itemCount);
        $this->set('banner_page', $bannerPage);
        $this->set('smallBannerSlots', $smallBannerSlots);
        $this->set('smallShownBanners', $smallShownBanners);
        $this->set('largeBannerSlots', $largeBannerSlots);
        $this->set('page', $filter['page']);
        $this->set('filter', $filter);
        $this->set('largeShownBanners', $largeShownBanners);
        $this->set('search', $filter['search']);
        if (isset($items)) {
            $this->set('items', $items);
        } else {
            $this->set('items', []);
            $this->set('error', true);
        }

        $this->set('searchUrl', Router::url([
            'controller' => 'Browse',
            'action' => 'search',
            'plugin' => 'Feeder'
        ]));

        $this->set('priceLimit', $feederCategory->price_to ?? 20);
        $this->set('priceFrom', $feederCategory->price_from ? $feederCategory->price_from : 1);
    }

    /**
     * @throws \Exception
     */
    public function search()
    {
        $filterPriceTo = 0;
        $filterPriceFrom = null;

        $this->loadModel('Feeder.FeederCategories');
        $this->FeederCategories->addBehavior('Feeder.TimeRange');
        $this->FeederCategories->ChildFeederCategories->addBehavior('Feeder.TimeRange');
        $this->FeederCategories->ParentFeederCategories->addBehavior('Feeder.TimeRange');

        $this->loadComponent('Currency');

        $filter = $this->FeederCategories->getFilterValues($this->request);

        $cacheKey = 'feeder_search_v2_' . md5(json_encode($filter));
        $cacheConfig = Configure::read('dealsguru.cache.browse', 'default');
        $categoryWithItems = Cache::read($cacheKey, $cacheConfig);
        $qty = Configure::read('Catch.search_page.result_items_count');

        if (!$categoryWithItems) {
            $ebaySiteCurrency = 'EUR';

            $searchRequest = new SearchItemsRequest();

            /**
             * @TODO Remove hardcode
             */
            $priceFrom = 0;
            $priceTo = 100;

            if ($priceTo > $filterPriceTo) {
                $filterPriceTo = $priceTo;
            }

            if ($priceFrom < $filterPriceFrom || is_null($filterPriceFrom)) {
                $filterPriceFrom = $priceFrom;
            }

            $searchItemFilter = new SearchItemFilter();
            $searchItemFilter->setEbayGlobalId('EBAY-DE');
            $searchItemFilter->setFullTextSearch($filter['search']);
            $searchItemFilter->setPriceFrom(((is_numeric($filter['upper']) && $filter['upper'] >= $filterPriceFrom)) ? $filter['upper'] : $priceFrom);

            if (is_numeric($filter['under'])) {
                $searchItemFilter->setPriceTo($filter['under']);
            }

            $searchItemFilter = $this->FeederCategories->addFilterToSearchRequest($searchItemFilter, $filter);
            $searchRequest->appendSearchItemFilter($searchItemFilter);

            $searchRequest->setLimit($qty);

            if (is_numeric($filter['page'])) {
                $searchRequest->setPage($filter['page']);
            }

            $session = new Session();
            $session->setRequest($searchRequest);
            $session->setAccessToken(Configure::read('eis.token'));

            $response = $session->sendRequest();

            if (isset($response->Result) || (isset($response->Status) && $response->Status == 'Success')) {
                $items = $response->Result ?? [];

                foreach ($items as &$item) {
                    //Ei caramba! @TODO: Rework
                    @$item->{"display_price"} = $this->Currency->formatCurrency($item->price, $item->currency);
                    @$item->{"display_original_price"} = null;
                    if (strpos($item->image_url, 'i.ebayimg.com') !== false) {
                        $urlArray = explode('/', $item->image_url);
                        $imageId = $urlArray[count($urlArray) - 2] ?? null;
                        if (strlen($imageId) > 6 && $imageId) {
                            @$item->{"thumbnail_url"} = 'https://i.ebayimg.com/images/g/' . $imageId . '/s-l300.jpg';
                        }
                    }
                }
                Cache::write($cacheKey, [
                    'items' => $items,
                    'item_count' => $qty,
                    'filter' => $filter,
                    'price_limit' => $filterPriceTo,
                    'price_from' => $filterPriceFrom
                ], $cacheConfig);
            }
        } else {
            $items = $categoryWithItems['items'];
            $qty = $categoryWithItems['item_count'] ?? $qty;
            $filter = $categoryWithItems['filter'] ?? [];
            $filterPriceTo = $categoryWithItems['price_limit'] ?? null;
            $filterPriceFrom = $categoryWithItems['price_from'] ?? null;
        }

        $ajax = false;
        if ($this->request->is('ajax')) {
            $ajax = true;
            $this->viewBuilder()->setLayout('empty');
        }

        $customer = $this->Auth->user();
        $wishlistItems = [];
        if ($customer) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItems = $this->CustomerWishlistItems->getWishlistItemsForCustomer($customer);
        }
        $this->set('ajax', $ajax);

        $this->set('under', ((is_numeric($filter['under']) && $filter['under'] <= $filterPriceTo)) ? $filter['under'] : $filterPriceTo);
        $this->set('upper', ((is_numeric($filter['upper']) && $filter['upper'] >= $filterPriceFrom)) ? $filter['upper'] : $filterPriceFrom);
        $this->set('itemCount', $qty);
        $this->set('wishlistItems', $wishlistItems);

        $this->set('filter', $filter);
        $this->set('search', $filter['search']);
        if (isset($items)) {
            $this->set('items', $items);
        } else {
            $this->set('items', []);
            $this->set('error', true);
        }

        $this->set('searchUrl', Router::url([
            'controller' => 'Browse',
            'action' => 'search',
            'plugin' => 'Feeder'
        ]));

        $this->set('bodyClass', 'browse search');
        $this->set('priceLimit', $filterPriceTo);
        $this->set('priceFrom', $filterPriceFrom ? $filterPriceFrom : 1);
    }

    /**
     * suggest
     */
    public function suggest()
    {
        $search = $this->request->getQuery('search', null);

        $suggestions = [];
        if ($search) {
            $this->viewBuilder()->setLayout('empty');
            $autoComplete = new AutoComplete();
            $autoComplete->setText($search);
            $autoComplete->setReturnCount(5);
            $autoCompleteRequest = new AutoCompleteItemsRequest();
            $autoCompleteRequest->setAutoComplete($autoComplete);

            $session = new Session();
            $session->setRequest($autoCompleteRequest);
            $session->setAccessToken(Configure::read('eis.token'));
            $response = $session->sendRequest();

            if ($response->Status == "Success" && !empty($response->Result)) {
                $suggestions = $response->Result;
            }
        }
        $this->set('search', $search);
        $this->set('suggestions', $suggestions);

        $this->set('searchUrl', Router::url([
            'controller' => 'Browse',
            'action' => 'search',
            'plugin' => 'Feeder'
        ]));
    }
}
