<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Request;

/**
 * Class GetItemByLegacyIdRequest
 * @package Ebay\Lib\BuyApi\BrowseApi\Request
 */
class GetItemByLegacyIdRequest extends AbstractRequest
{
    protected $requestMethod = 'get';
    private $legacyItemId;
    private $legacyVariationId;
    private $legacyVariationSku;

    /**
     * @param $legacyVariationSku
     * @return $this
     */
    public function setLegacyVariationSku($legacyVariationSku)
    {
        $this->legacyVariationSku = $legacyVariationSku;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLegacyVariationSku()
    {
        return $this->legacyVariationSku;
    }

    /**
     * @param $legacyVariationId
     * @return $this
     */
    public function setLegacyVariationId($legacyVariationId)
    {
        $this->legacyVariationId = $legacyVariationId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLegacyVariationId()
    {
        return $this->legacyVariationId;
    }

    /**
     * @param $legacyItemId
     * @return $this
     */
    public function setLegacyItemId($legacyItemId)
    {
        $this->legacyItemId = $legacyItemId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLegacyItemId()
    {
        return $this->legacyItemId;
    }

    /**
     * @return string
     */
    public function getCallName()
    {
        $callName = "item/get_item_by_legacy_id?";
        $params = [];
        if ($this->getLegacyItemId()) {
            $params[] = 'legacy_item_id=' . urlencode($this->getLegacyItemId());
        }
        if ($this->getLegacyVariationId()) {
            $params[] = 'legacy_variation_id=' . urlencode($this->getLegacyVariationId());
        }
        if ($this->getLegacyVariationSku()) {
            $params[] = 'legacy_variation_sku=' . urlencode($this->getLegacyVariationSku());
        }
        if (!empty($params)) {
            $callName .= implode('&', $params);
        }
        return $callName;
    }
}
