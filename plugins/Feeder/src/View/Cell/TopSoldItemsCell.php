<?php

namespace Feeder\View\Cell;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\View\Cell;
use EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;

/**
 * Class TopSoldItemsCell
 * @package Feeder\View\Cell
 * @property EbayCheckoutSessionItemsTable $EbayCheckoutSessionItems
 */
class TopSoldItemsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = ['wishlistItems', 'ebayCategoryPath'];

    /**
     * @param array $wishlistItems
     * @param string $ebayCategoryPath
     */
    public function display($wishlistItems = [], $ebayCategoryPath = null)
    {
        $defaultPage = 1;
        $defaultSellPeriodInDays = 7;
        $defaultLimit = 24;
        $limit = trim($this->request->getQuery('limit'));
        if(empty($limit) || !is_numeric($limit)) {
            $limit = $defaultLimit;
        }

        $page = trim($this->request->getQuery('page', $defaultPage));
        if(empty($page) || !is_numeric($page)) {
            $page = $defaultPage;
        }
        $sellPeriodInDays = trim($this->request->getQuery('sellPeriodInDays', $defaultSellPeriodInDays));
        if(empty($sellPeriodInDays) || !is_numeric($sellPeriodInDays)) {
            $sellPeriodInDays = $defaultSellPeriodInDays;
        }

        $this->loadModel('EbayCheckout.EbayCheckoutSessionItems');
        $topSoldItems = $this->EbayCheckoutSessionItems->getTopSoldList($limit, $page, $sellPeriodInDays, $ebayCategoryPath);

        //Fallback to global top sold items
        if (empty($topSoldItems) && ($page == 1 && !empty($ebayCategoryPath))) {
            $topSoldItems = $this->EbayCheckoutSessionItems->getTopSoldList($limit, $page, $sellPeriodInDays);
        }

        $this->set('topSoldItems', $topSoldItems);
    }

    public function json($wishlistItems = [], $ebayCategoryPath = null)
    {
        $this->display($wishlistItems, $ebayCategoryPath);
    }
}
