<?php

namespace Feeder\View\Cell;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\I18n\Number;
use Cake\View\Cell;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use Feeder\Model\Entity\FeederHomepage;

/**
 * SurpriseItems cell
 */
class SurpriseItemsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = ['itemIds', 'shuffle', 'wishlistItems', 'feederHomepage'];

    /**
     * Default display method.
     *
     * @param null $itemIds
     * @param bool $shuffle
     * @param array $wishlistItems
     * @param FeederHomepage $feederHomepage
     */
    public function display($itemIds = null, $shuffle = false, $wishlistItems = [], FeederHomepage $feederHomepage = null)
    {
        $cacheKey = 'feeder_surprise_items_' . md5(json_encode($itemIds));
        $cacheConfig = Configure::read('dealsguru.cache.browse', 'default');
        $items = Cache::read($cacheKey, $cacheConfig);

        if (!$itemIds) {
            $itemIds = $this->getItemIdsFromFeederHomepage($feederHomepage);
        }

        if ($itemIds && !$items) {
            if (!is_array($itemIds)) {
                $itemIds = explode(';', str_replace(',', ';', $itemIds));
            }
            if (!empty($itemIds)) {
                $searchRequest = new SearchItemsRequest();
                $searchItemFilter = new SearchItemFilter();
                $searchItemFilter->setEbayGlobalId('EBAY-DE');
                $searchItemFilter->setItemLegacyIds($itemIds);
                $searchRequest->setSearchItemFilter($searchItemFilter);
                $searchRequest->setLimit(200);
                $session = new Session();
                $session->setRequest($searchRequest);
                $session->setAccessToken(Configure::read('eis.token'));
                $response = $session->sendRequest();
                if (isset($response->Result) || (isset($response->Status) && $response->Status == 'Success')) {
                    $items = $response->Result ?? [];
                    foreach ($items as &$item) {
                        @$item->{"display_price"} = Number::currency($item->price, $item->currency);
                        if (strpos($item->image_url, 'i.ebayimg.com') !== false) {
                            $urlArray = explode('/', $item->image_url);
                            $imageId = $urlArray[count($urlArray) - 2] ?? null;
                            if (strlen($imageId) > 6 && $imageId) {
                                @$item->{"thumbnail_url"} = 'https://i.ebayimg.com/images/g/' . $imageId . '/s-l300.jpg';
                            }
                        }
                    }
                }
                Cache::write($cacheKey, $items, $cacheConfig);
            }
        }
        if ($shuffle) {
            shuffle($items);
        }
        $this->set('wishlistItems', $wishlistItems);
        $this->set('items', $items);
    }

    /**
     * @param FeederHomepage|null $feederHomepage
     * @return string|null
     */
    protected function getItemIdsFromFeederHomepage(FeederHomepage $feederHomepage = null)
    {
        return $feederHomepage->surprise_item_ids ?? null;
    }
}
