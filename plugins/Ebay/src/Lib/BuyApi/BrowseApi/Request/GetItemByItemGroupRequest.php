<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Request;

/**
 * Class GetItemByItemGroupRequest
 * @package Ebay\Lib\BuyApi\BrowseApi\Request
 */
class GetItemByItemGroupRequest extends AbstractRequest
{
    protected $requestMethod = 'get';
    protected $itemGroupId;

    /**
     * @param $itemGroupId
     * @return $this
     */
    public function setItemGroupId($itemGroupId)
    {
        $this->itemGroupId = $itemGroupId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemGroupId()
    {
        return $this->itemGroupId;
    }

    /**
     * @return string
     */
    public function getCallName()
    {
        return "item/get_items_by_item_group?item_group_id=" . $this->getItemGroupId();
    }

}
