<?php

namespace EbayCheckout\Controller;

use App\Application;
use App\Model\Entity\CoreSeller;
use App\Model\Table\CoreSellersTable;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Ebay\Controller\Component\EbayBuyApiComponent;
use Ebay\Model\Entity\EbayAccount;
use Ebay\Model\Table\EbayAccountsTable;
use Ebay\Model\Table\EbayRestApiAccessTokensTable;
use EbayCheckout\Controller\Component\GetItemComponent;
use EbayCheckout\Controller\Component\TopSoldItemsComponent;
use EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable;
use EisSdk\Entity\Aspect;
use EisSdk\Entity\Aspects;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\RefreshItemRequest;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use Feeder\Controller\ProductsController;
use Feeder\Model\Table\FeederHomepagesTable;
use VisitManager\Model\Table\ProductVisitsTable;

/**
 * Class EbayCheckoutItemsController
 * @package EbayCheckout\Controller
 *
 * @property EbayBuyApiComponent $EbayBuyApi
 * @property EbayAccountsTable $EbayAccounts
 * @property CoreSellersTable $CoreSellers
 * @property TopSoldItemsComponent $TopSoldItems
 * @property ProductVisitsTable $ProductVisits
 * @property FeederHomepagesTable $FeederHomepages
 * @property GetItemComponent $GetItem
 */
class EbayCheckoutItemsController extends AppController
{
    /**
     * @var CoreSeller $coreSeller
     */
    protected $coreSeller;

    /**
     * @var EbayAccount $ebayAccount
     */
    protected $ebayAccount;

    /**
     * @var string
     */
    protected $productLayout = 'product';

    /**
     * @var string
     */
    protected $countryCodeShown;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $ebayGlobalId;

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
     * initialize
     */
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
        $this->Auth->allow(['view', 'description']);
        $this->loadComponent('EbayCheckout.GetItem');
    }

    /**
     *  BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return \App\Controller\empty|void
     * @throws \Exception
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if (!$this->coreSeller) {
            $uuid = $this->request->getParam('uuid');

            if (!$uuid) {
                throw new NotFoundException(__('CoreSellerCode not found.'));
            }

            $this->loadModel('CoreSellers');
            $this->coreSeller = $this->CoreSellers->find()
                ->where(['CoreSellers.uuid' => $uuid])
                ->cache('ebayCheckoutItemCoreSeller' . $uuid, Application::SHORT_TERM_CACHE)
                ->first();

            if (!$this->coreSeller) {
                throw new NotFoundException(__('CoreSeller not found.'));
            }
        }

        $this->loadModel('Ebay.EbayAccounts');
        $this->loadComponent('Ebay.EbayBuyApi');

        if (!$this->ebayAccount) {
            $mode = Configure::read('disco.' . $uuid . '.mode');
            $accountId = Configure::read('disco.' . $uuid . '.ebay.' . $mode . '_account_id');
            $this->ebayAccount = $this->EbayAccounts->find()
                ->where(['EbayAccounts.id' => $accountId])
                ->contain(['EbayCredentials', 'EbayAccountTypes', 'EbayRestApiAccessTokens'])
                ->cache(EbayRestApiAccessTokensTable::CACHE_KEY_PREFIX . $accountId, Application::SHORT_TERM_CACHE)
                ->first();
        }
    }

    /**
     * description
     */
    public function description()
    {
        $this->viewBuilder()->setLayout('empty');
        $itemId = $this->request->getParam('itemId');
        if (!$itemId) {
            throw new BadRequestException(__('Item Id not found.'));
        }

        $countryCode = $this->request->getParam('countryCode');

        $ebayGlobalId = $this->request->getParam('ebayGlobalId');


        $this->EbayBuyApi->setAccount($this->ebayAccount);
        if ($countryCode) {
            $this->EbayBuyApi->setLocationCountryCode($countryCode);
        }

        if ($ebayGlobalId) {
            $this->EbayBuyApi->setEbayGlobalId($ebayGlobalId);
        }

        $item = $this->GetItem->get($itemId);

        $this->set('ebayItem', $item);
    }

    /**
     * @throws \Exception
     */
    public function view()
    {
        $type = 'itemId';
        $this->viewBuilder()->setLayout($this->productLayout);

        $itemId = $this->request->getParam('itemId');
        $gtin = $this->request->getParam('gtin');

        if ($gtin) {
            $type = 'gtin';
            $cacheKey = ProductsController::CACHE_PRODUCT_KEY . 'gtin_to_item_id_' . $gtin;
            $itemId = Cache::remember($cacheKey, function () use ($gtin) {
                /** @var EbayCheckoutSessionItemsTable $EbayCheckoutSessionItems */
                $EbayCheckoutSessionItems = TableRegistry::getTableLocator()->get('EbayCheckout.EbayCheckoutSessionItems');
                return $EbayCheckoutSessionItems->searchItemWithGtin($gtin);
            }, Application::SHORT_TERM_CACHE);
        }

        if (!$itemId && !$gtin) {
            throw new BadRequestException(__('Item Id not found.'));
        }

        //Cleanup item Id from FB dynamic ad manager e.q https://catch.app/itm/111983488866_479
        if (strpos($itemId, '_') !== false) {
            $modifiedItemId = explode('_', $itemId);
            if (isset($modifiedItemId[0]) && (is_numeric($modifiedItemId[0]) || strpos($modifiedItemId[0], 'v') !== false)) {
                $itemId = $modifiedItemId[0];
            }
        }

        $uuid = $this->request->getParam('uuid');

        $countryCode = $this->request->getParam('countryCode');

        $ebayGlobalId = $this->request->getParam('ebayGlobalId');

        if (!$ebayGlobalId) {
            $ebayGlobalId = $this->ebayGlobalId;
        }

        if (!$countryCode) {
            $countryCode = $this->countryCode;
        }

        $widgetType = $this->request->getParam('widgetType');

        $wrapperLayout = $this->request->getParam('wrapperLayout');

        $this->EbayBuyApi->setAccount($this->ebayAccount);

        $epnCampaignId = $this->request->getSession()->read('EbayAffiliateCampaignId');
        $epnReferenceId = $this->request->getSession()->read('EbayAffiliateReferenceId');

        if (empty($epnCampaignId) && empty($epnCampaignId)) {
            $epnData = explode(',', $this->ebayAccount->epn_identifier);
            $epnReferenceId = $epnData[0] ?? '';
            $epnCampaignId = $epnData[1] ?? '';
        }

        if ($countryCode) {
            $this->EbayBuyApi->setLocationCountryCode($countryCode);
        }

        if ($ebayGlobalId) {
            $this->EbayBuyApi->setEbayGlobalId($ebayGlobalId);
        }

        $item = $this->GetItem->get($itemId);

        /**
         *search for the shortest and longest delivery times of that item and set them in the shippingArray
         */
        $minDate = null;
        $maxDate = null;
        if (isset($item['items'])) {
            foreach ($item['items'] as $shippingItem) {
                if (isset($shippingItem['shipping_options'])) {
                    foreach ($shippingItem['shipping_options'] as $option) {
                        if (isset($option['min_delivery_date']) && $option['min_delivery_date'] != '') {
                            $shippingMinDate = date('Y-m-d', strtotime($option['min_delivery_date']));
                            if ($minDate == null || $minDate > $shippingMinDate) {
                                $minDate = $shippingMinDate;
                            }
                        }
                        if (isset($option['max_delivery_date']) && $option['max_delivery_date'] != '') {
                            $shippingMaxDate = date('Y-m-d', strtotime($option['max_delivery_date']));
                            if ($maxDate == null || $maxDate < $shippingMaxDate) {
                                $maxDate = $shippingMaxDate;
                            }
                        }
                    }
                }
            }
        }
        if ($minDate != null || $maxDate != null) {
            $shippingArray = array('maxDate' => $maxDate, 'minDate' => $minDate);
        } else {
            $shippingArray = false;
        }

        /**
         * populate the item array with all the items from the database and some of their values
         */
        $items = array();
        $itemsPresent = false;
        $oneItemAvailable = false;
        $enabledForGuestCheckout = false;
        $eligibleForInlineCheckout = false;
        if (isset($item['items'])) {
            $itemsPresent = true;
            for ($a = 0; $a < count($item['items']); $a++) {
                $databaseItem = $item['items'][$a];
                array_push($items, array());
                $items[$a]['id'] = $databaseItem['id'];
                $items[$a]['price'] = array(
                    'amount' => $databaseItem['price']['amount'],
                    'currency' => $databaseItem['price']['currency'],
                    'display_price' => $databaseItem['price']['display_price']
                );
                $items[$a]['quantity'] = $databaseItem['quantity'];
                $items[$a]['availability_status'] = $databaseItem['availability_status'];
                $items[$a]['sold_quantity'] = $databaseItem['sold_quantity'];
                $items[$a]['quantity_type'] = $databaseItem['quantity_type'];
                $items[$a]['attr'] = array();
                $items[$a]['energy_efficiency_class'] = $databaseItem['energy_efficiency_class'];
                $items[$a]['unit_pricing_measure'] = $databaseItem['unit_pricing_measure'];
                $items[$a]['unit_price'] = $databaseItem['unit_price'];
                $items[$a]['enabled_for_guest_checkout'] = $databaseItem['enabled_for_guest_checkout'] ?? false;
                $items[$a]['eligible_for_inline_checkout'] = $databaseItem['eligible_for_inline_checkout'] ?? false;
                $items[$a]['marketing_price'] = $databaseItem['marketing_price'];
                $items[$a]['unit_price_display'] = !empty($databaseItem['unit_price']['value']) ? '(' . $databaseItem['unit_price']['currency'] . ' ' . str_replace('.', ',', $databaseItem['unit_price']['value']) . '/' . $databaseItem['unit_pricing_measure'] . ')' : '';
                foreach ($databaseItem['attributes'] as $attribute) {
                    $items[$a]['attr'][$attribute['name']] = $attribute['value'];
                }
                $items[$a]['images'] = $databaseItem['images'];
                if ($items[$a]['enabled_for_guest_checkout'] ?? false) {
                    $enabledForGuestCheckout = true;
                }
                if ($items[$a]['eligible_for_inline_checkout'] ?? false) {
                    $eligibleForInlineCheckout = true;
                }
                $itemEnded = false;
                if (isset($databaseItem['item_end_date'])) {
                    $itemEndDate = strtotime($databaseItem['item_end_date']);
                    $now = (Time::now('UTC'))->toUnixString();
                    $itemEnded = $now > $itemEndDate;
                }

                if (
                    !$oneItemAvailable
                    && $databaseItem['availability_status'] == 'IN_STOCK'
                    && !$itemEnded
                ) {
                    $oneItemAvailable = true;
                }
            }
        }

        /**set the string for the feedback section*/
        $feedbackPercentage = 'No Feedback';
        if (isset($item['items'])) {
            if (isset($item['items'][0]['seller'])) {
                if (isset($item['items'][0]['seller']['username'])) {
                    $seller = $item['items'][0]['seller']['username'] . ' (' .
                        $item['items'][0]['seller']['feedback_score'] . ')';
                    $feedbackPercentage = $item['items'][0]['seller']['feedback_percentage'];
                } else {
                    $seller = 'NoName' . ' (' . $item['items'][0]['seller']['feedback_score'] . ')';
                }
            } else {
                $seller = 'No seller specified';
            }
        } else {
            $seller = 'Invalid Item! No seller description';
        }
        $sellerArray = array('seller' => $seller, 'feedback' => $feedbackPercentage);

        $ratingCount = 0;
        if (isset($item['rating'])) {
            for ($a = 0; $a < 5; $a++) {
                $ratingCount += $item['rating']['histogram'][$a]['count'];
            }
        } else {
            $ratingCount = false;
        }

        /**build the image array which is the source of the image slider*/
        $images = [];

        /** main item */
        if (isset($item['images']) && !empty($item['images'])) {
            foreach ($item['images'] as $itemImage) {
                if (!empty($itemImage)) {
                    $key = sha1(trim($itemImage));

                    if (!isset($images[$key])) {
                        $images[$key] = [
                            'imageArray' => [
                                'imgUrl' => $itemImage
                            ]
                        ];
                    }
                }
            }
        }

        /** variant images */
        foreach ($items as $ebayItem) {
            if (isset($ebayItem['images']) && !empty($ebayItem['images'])) {
                foreach ($ebayItem['images'] as $ebayItemImage) {
                    if (!empty($ebayItemImage)) {
                        $imageKey = sha1(trim($ebayItemImage));

                        if (!isset($images[$imageKey])) {
                            $image = [
                                'imageArray' => [
                                    'imgUrl' => $ebayItemImage,
                                ]
                            ];

                            if (isset($ebayItem['attr']) && !empty($ebayItem['attr'])) {
                                $image['imageArray']['attributes']['itemId'][] = $ebayItem['id'];

                                foreach ($ebayItem['attr'] as $key => $value) {
                                    $image['imageArray']['attributes'][$key] = $value;
                                }
                            }
                            $images[$imageKey] = $image;
                        } else {
                            if (isset($images[$imageKey]['imageArray']['attributes']['itemId'])) {
                                $images[$imageKey]['imageArray']['attributes']['itemId'][] = $ebayItem['id'];
                            }
                        }
                    }
                }
            }
        }
        /** replace hash keys with numerical values */
        sort($images);

        /**build the return terms string*/
        if (isset($item['items'][0]['return_terms'])) {
            if (isset($item['items'][0]['return_terms']['return_accepted'])) {
                if ($item['items'][0]['return_terms']['return_accepted']) {
                    $returnPeriod = ucfirst(strtolower(Inflector::humanize($item['items'][0]['return_terms']['return_period']['unit'])));
                    $returnTerms = __('Returns are accepted within') . ' ' .
                        $item['items'][0]['return_terms']['return_period']['value'] . ' ';
                    if ($item['items'][0]['return_terms']['return_period']['value'] > 1) {
                        $returnTerms .= __(Inflector::pluralize($returnPeriod)) . '.';
                    } else {
                        $returnTerms .= __($returnPeriod) . '.';
                    }
                    $returnTerms .= ' ' . __('The corresponding return costs have to be paid by the ') .
                        __(strtolower($item['items'][0]['return_terms']['return_shipping_cost_payer'])) . '.';
                } else {
                    $returnTerms = __('Returns are not accepted.');
                }
            } else {
                $returnTerms = __('No return terms specified.');
            }
        } else {
            $returnTerms = __('Invalid Item');
        }

        $optionAvailable = array();
        if (isset($item['configurable_attributes'])) {
            foreach ($item['configurable_attributes'] as $confAttrKey => $confAttrItem) {
                for ($a = 0; $a < count($items); $a++) {
                    $option = $items[$a]['attr'][$confAttrKey] ?? null;

                    if ($option !== null) {
                        if (isset($optionAvailable[$option])) {
                            if ($items[$a]['quantity'] > 0) {
                                $optionAvailable[$option] = true;
                            }
                        } else {
                            $optionAvailable[$option] = $items[$a]['quantity'] !== 0;
                        }
                    }
                }
            }
        }

        $confAttributes = array();
        $attributeArray = array();
        if (isset($item['configurable_attributes'])) {
            foreach ($item['configurable_attributes'] as $confAttrKey => $confAttrItem) {
                array_push($confAttributes, $confAttrKey);
            }

            foreach ($item['configurable_attributes'] as $confAttrKey => $confAttrItem) {
                $tempArrayLevel1 = array();
                for ($a = 0; $a < count($confAttrItem); $a++) {
                    $tempArrayLevel2 = array();
                    //iteriere durch alle items
                    for ($b = 0; $b < count($items); $b++) {
                        //finde items, die dem gesuchten wert entsprechen
                        if (isset($items[$b]['attr'][$confAttrKey]) && $items[$b]['attr'][$confAttrKey] === $confAttrItem[$a]) {
                            foreach ($items[$b]['attr'] as $attrKey => $attrValue) {
                                if ($attrKey !== $confAttrKey && in_array($attrKey, $confAttributes)) {
                                    $tempArrayLevel2[$attrKey] = array();
                                    for ($c = 0; $c < count($items); $c++) {
                                        if (isset($items[$c]['attr'][$confAttrKey]) && $items[$c]['attr'][$confAttrKey] === $confAttrItem[$a]) {
                                            if (isset($items[$c]['attr'][$attrKey])) {
                                                if (!isset($tempArrayLevel2[$attrKey][$items[$c]['attr'][$attrKey]])) {
                                                    $tempArrayLevel2[$attrKey][$items[$c]['attr'][$attrKey]] = $items[$c]['quantity'] !== 0;
                                                } else if (!$tempArrayLevel2[$attrKey][$items[$c]['attr'][$attrKey]] && $items[$c]['quantity'] !== 0) {
                                                    $tempArrayLevel2[$attrKey][$items[$c]['attr'][$attrKey]] = true;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $tempArrayLevel1[$confAttrItem[$a]] = $tempArrayLevel2;
                }
                $attributeArray[$confAttrKey] = $tempArrayLevel1;
            }
        }

        /**build the src link for the tracking pixel depending on countryCode*/
        $trackingPixelSrc = 'https://rover.ebay.com/roverimp/1/';
        $countryCodeShowed = $this->countryCodeShown;
        if ($countryCode === 'us') {
            $trackingPixelSrc .= '711-241098-21580-0/4?step=item_viewed';
            $countryCodeShowed = 'us';
        } else {
            if ($countryCode === 'gb') {
                $trackingPixelSrc .= '710-236938-21580-0/4?step=item_viewed';
                $countryCodeShowed = 'uk';
            } else {
                if ($countryCode === 'uk') {
                    $trackingPixelSrc .= '710-236938-21580-0/4?step=item_viewed';
                    $countryCodeShowed = 'uk';
                }
            }
        }

        array_walk_recursive($images, function (&$item, $key) {
            if ($key === 'imgUrl') {
                $item = preg_replace('/^http:\/\/i\.ebayimg\.com\//ui', 'https://i.ebayimg.com/', $item);
            }
        });

        $trackingPixelSrc .= '&widget_type=' . $widgetType;

        $trackingPixelSrc .= '&wrapper_layout=' . $wrapperLayout;


        if (empty($item['title']) || !$oneItemAvailable) {
            try {
                $refreshItemRequest = new RefreshItemRequest();
                switch ($type) {
                    case 'itemId' :
                        $refreshItemRequest->setItemId($itemId);
                        break;
                    case 'gtin':
                        $refreshItemRequest->setGtin($gtin);
                        break;
                }

                $refreshItemRequest->setEbayGlobalId($ebayGlobalId);

                $session = new Session();
                $session->setAccessToken(Configure::read('eis.token'));
                $session->setRequest($refreshItemRequest);
                $session->sendRequest();
            } catch (\Exception $exp) {
                $this->log(__('Error while sending item refresh request. ErrorMessage "{0}", ItemId "{1}", eBayGlobalId "{2}", File "{3}", CodeLine "{4}"', [
                    $exp->getMessage(),
                    $itemId,
                    $ebayGlobalId,
                    $exp->getFile(),
                    $exp->getLine()
                ]));
            }

            $this->set('bodyClass', 'feeder products view unknown');
        }
        //$eligibleForInlineCheckout = false;

        $checkoutUrl = \Cake\Routing\Router::url([
            'controller' => 'EbayCheckoutSessions',
            'action' => 'view',
            'plugin' => 'EbayCheckout',
            'uuid' => $this->coreSeller->uuid
        ]);

        $cartUrl = \Cake\Routing\Router::url([
            'controller' => 'EbayCheckoutSessions',
            'action' => 'cart',
            'plugin' => 'EbayCheckout',
            'uuid' => $this->coreSeller->uuid
        ]);
        /** Log Visit - Under Development */
        $trackingData = $this->request->getQuery('trkdata');
        $userAgent = $this->getRequest()->getHeaderLine('User-Agent');

        if (stripos($userAgent, 'bot') === false && Plugin::loaded('VisitManager')) {
            $this->loadModel('VisitManager.ProductVisits');
            if (empty($trackingData)) {
                $trackingData = base64_encode(http_build_query([
                    'marketplaceProduct' => $itemId,
                    'userGroup' => 'Catch',
                    'productPosition' => 1
                ]));
            }
            $this->ProductVisits->logVisit($trackingData);
        }
        /** Log Visit - Under Development */

        /** create $breadcrumbs for use in layout */
        $breadcrumbs = [];
        array_push($breadcrumbs, [
            'name' => __('Homepage'),
            'url' => \Cake\Routing\Router::url([
                'controller' => 'Homepage',
                'action' => 'index',
                'plugin' => 'Feeder'
            ])
        ]);
        $categoryId = $this->request->getQuery('category', false);
        if ($categoryId) {
            $this->loadModel('Feeder.FeederCategories');
            $feederCategory = $this->FeederCategories->find()
                ->where(['FeederCategories.id' => $categoryId])
                ->contain(['ParentFeederCategories'])
                ->cache('breadcrumbFeederCategory' . $categoryId, Application::SHORT_TERM_CACHE)
                ->first();
            if ($feederCategory) {
                if ($feederCategory->parent_feeder_category->id ?? false) {
                    array_push($breadcrumbs, [
                        'name' => $feederCategory->parent_feeder_category->name,
                        'url' => \Cake\Routing\Router::url([
                            'controller' => 'Browse',
                            'action' => 'view',
                            'plugin' => 'Feeder',
                            $feederCategory->parent_feeder_category->id
                        ])
                    ]);
                }
                array_push($breadcrumbs, [
                    'name' => $feederCategory->name,
                    'url' => \Cake\Routing\Router::url([
                        'controller' => 'Browse',
                        'action' => 'view',
                        'plugin' => 'Feeder',
                        $feederCategory->id
                    ])
                ]);
            }
        }

        $roverTimestamp = 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338693998&customid=' . $itemId . '&mpre=';
        $item['item_web_url'] = $roverTimestamp . (isset($item['item_web_url']) ? urlencode($item['item_web_url']) : '');

        if (isset($item['items']) && !empty($item['items'])) {
            foreach ($item['items'] as $key => $itemItem) {
                $item['items'][$key]['item_web_url'] = $roverTimestamp . urlencode($itemItem['item_web_url']);
            }
        }
        if (isset($item['description'])) {
            $item['description'] = $this->filterLinks($item['description'], $itemId);
            $item['description'] = $this->filterImages($item['description'], $itemId);
        }

        $this->set('breadcrumbs', $breadcrumbs);
        $item['item_web_url_for_ebay'] = $item['item_web_url'];
        $item['item_web_url'] = 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338726452&customid=&mpre=' . urlencode($item['item_web_url']);
        $loadMoreBestsellingItemsUrl = \Cake\Routing\Router::url([
            'plugin' => 'EbayCheckout',
            'controller' => 'TopSoldItems',
            'action' => 'getTopSoldItemsList',
        ]);
        $this->set('loadMoreBestsellingItemsUrl', $loadMoreBestsellingItemsUrl);
        $this->set('checkoutUrl', $checkoutUrl);
        $this->set('cartUrl', $cartUrl);
        $this->set('attributeArray', $attributeArray);
        $this->set('optionAvailable', $optionAvailable);
        $this->set('ebayTrackingPixelSrc', $trackingPixelSrc);
        $this->set('itemId', $itemId);
        $this->set('items', $items);
        $this->set('itemPresent', $itemsPresent);
        $this->set('images', $images);
        $this->set('ebayItem', $item);
        $this->set('seller', $sellerArray);
        $this->set('ratingCount', $ratingCount);
        $this->set('returnTerms', $returnTerms);
        $this->set('eligibleForInlineCheckout', $eligibleForInlineCheckout);
        $this->set('enabledForGuestCheckout', $enabledForGuestCheckout);
        $this->set('uuid', $uuid);
        $this->set('shippingArray', $shippingArray);
        $this->set('ebayGlobalId', $ebayGlobalId);
        $this->set('countryCode', $countryCode);
        $this->set('countryCodeShowed', $countryCodeShowed);
        $this->set('widgetType', $widgetType);
        $this->set('wrapperLayout', $wrapperLayout);
        $this->set('coreSeller', $this->coreSeller);
        $this->set('epnPublisherId', $epnReferenceId);
        $this->set('epnCampaignId', $epnCampaignId);
    }

    /**
     * @param $html
     * @return \DOMDocument
     */
    protected function getDOM($html)
    {
        if (is_string($html)) {
            $dom = new \DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        } else {
            $dom = $html;
        }
        return $dom;
    }

    /**
     * @param $html
     * @param $itemId
     * @return \DOMDocument|string
     */
    public function filterLinks($html, $itemId)
    {
        $dom = $this->getDOM($html);
        $processed = false;
        if (!empty($dom)) {
            $links = $dom->getElementsByTagName('a');
            for ($i = 0; $i < $links->length; $i++) {
                $link = $links->item($i);
                $href = strip_tags(trim(str_replace(["\r", "\n"], '', $link->getAttribute('href'))));
                if (stripos($href, '.ebay.') !== false || stripos($href, '.ebaystores.') !== false) {
                    $roverTimestamp = 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338721927&customid=' . $itemId . '&mpre=';
                    $href = $roverTimestamp . urlencode($href);
                    $link->setAttribute('href', $href);
                    $processed = true;
                }
            }
        }
        if (is_string($html)) {
            if ($processed) {
                return $dom->saveHTML();
            } else {

                return $html;
            }
        }
        return $dom;
    }

    /**
     * @param $html
     * @param $itemId
     * @return \DOMDocument|string
     */
    public function filterImages($html, $itemId)
    {
        $dom = $this->getDOM($html);
        $processed = false;

        if(!empty($dom)) {
            $images = $dom->getElementsByTagName('img');
            for ($i = 0; $i < $images->length; $i++) {
                $image = $images->item($i);
                $src = $image->getAttribute('src');
                if (stripos($src, '.ebayimg.') !== false) {
                    $roverTimestamp = 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338721927&customid=' . $itemId . '&mpre=' . urlencode($src);
                    $epnImageLink = $dom->createElement('a');
                    $epnImageLink->setAttribute('href', $roverTimestamp);
                    $epnImageLink->setAttribute('target', '_blank');
                    $image->parentNode->appendChild($epnImageLink);
                    $epnImageLink->appendChild($image);
                    $processed = true;
                }
            }
        }
        if (is_string($html)) {
            if ($processed) {
                return $dom->saveHTML();
            } else {
                return $html;
            }
        }
        return $dom;
    }
}
