<?php

namespace Feeder\View\Cell;

use App\Application;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\View\Cell;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;

/**
 * Class SimilarItemsCell
 * @package Feeder\View\Cell
 */
class SimilarItemsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = ['wishlistItems'];

    /**
     * @param int $ebayCategoryId
     * @param int $limit
     * @param int $page
     * @param int $maxItemPrice
     * @param array $wishlistItems
     */
    public function display(int $ebayCategoryId, $limit = 10, $page = 1, $maxItemPrice = 100, $wishlistItems = [])
    {
        $eisApiToken = Configure::read('eis.token');
        $cacheKey = 'similar_items_' . $ebayCategoryId . '_' . $limit . '_' . $page . '_' . $maxItemPrice;

        $similarItems = Cache::read($cacheKey, Application::SHORT_TERM_CACHE);

        if (!$similarItems) {
            $searchItemFilter = (new SearchItemFilter())
                ->setEbayGlobalId('EBAY-DE')
                ->setCategoryId($ebayCategoryId)
                ->setPriceTo($maxItemPrice)
                ->setQuantityFrom(1);

            $searchRequest = (new SearchItemsRequest())
                ->setSearchItemFilter($searchItemFilter)
                ->setLimit($limit)
                ->setPage($page);

            $response = (new Session())
                ->setRequest($searchRequest)
                ->setAccessToken($eisApiToken)
                ->sendRequest();

            if (isset($response->Result) || (isset($response->Status) && $response->Status == 'Success')) {
                $items = $response->Result ?? [];
                foreach ($items as $item) {
                    $similarItems[] = $item;
                }
                Cache::write($cacheKey, $similarItems, Application::SHORT_TERM_CACHE);
            }
        }
        $this->set('wishlistItems', $wishlistItems);
        $this->set('similarItems', $similarItems);
    }

    public function json(int $ebayCategoryId, $limit = 10, $page = 1, $maxItemPrice = 100, $wishlistItems = [])
    {
        $this->display($ebayCategoryId, $limit, $page, $maxItemPrice, $maxItemPrice, $wishlistItems);
    }
}
