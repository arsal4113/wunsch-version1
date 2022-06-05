<?php

namespace EbayCheckout\Controller\Component;

use Cake\Cache\Cache;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Ebay\Controller\Component\EbayBuyApiComponent;

class GetItemComponent extends Component
{
    const CACHE_PRODUCT_KEY = 'ebay_checkout_item_';
    const IMAGE_SIZE = 12;

    /**
     * Get Item
     *
     * @param $itemId
     * @param $raw
     * @return mixed
     */
    public function get($itemId, $raw = false)
    {
        /** @var EbayBuyApiComponent $ebayBuyApi */
        $ebayBuyApi = $rawItem = $this->_registry->getController()->EbayBuyApi;
        $itemGroupId = $ebayBuyApi->extractItemGroupId($itemId);
        if ($itemGroupId) {
            $cacheKey = self::CACHE_PRODUCT_KEY . str_replace('|', '_', $itemGroupId);
        } else {
            $cacheKey = self::CACHE_PRODUCT_KEY . str_replace('|', '_', $itemId);
        }
        $item = null;
        $cacheConfig = Configure::read('dealsguru.cache.product', 'default');
        try {
            $item = Cache::read($cacheKey, $cacheConfig);
        } catch (\Exception $exp) {
            $this->_registry->getController()->log($exp->getFile() . ': ' . $exp->getLine() . ': ' . $exp->getMessage());
        }
        if (!empty($item)) {
            if ($raw) {
                $item = json_decode(gzdecode($item), false);
                if (!empty($item->raw)) {
                    return $item->raw;
                }
            } else {
                $item = json_decode(gzdecode($item), true);
                if (!empty($item['item'])) {
                    return $item['item'];
                }
            }
            $item = null;
        }

        if (empty($item)) {
            $rawItem = $this->_registry->getController()->EbayBuyApi->getRawItem($itemId);
            $item = [
                'raw' => $rawItem,
                'item' => $this->_registry->getController()->EbayBuyApi->convertItem($rawItem, self::IMAGE_SIZE)
            ];
            try {
                Cache::write($cacheKey, gzencode(json_encode($item), 9), $cacheConfig);
            } catch (\Exception $exp) {
                $this->_registry->getController()->log($exp->getFile() . ': ' . $exp->getLine() . ': ' . $exp->getMessage());
            }
        }
        if ($raw) {
            return $item['raw'];
        }
        return $item['item'];
    }
}
