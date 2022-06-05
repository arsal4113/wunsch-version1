<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Request;

/**
 * Class GetItemRequest
 * @package Ebay\Lib\BuyApi\BrowseApi\Request
 */
class GetItemRequest extends AbstractRequest
{
    protected $requestMethod = 'get';
    protected $itemId;
    private $fieldGroups;

    /**
     * @param $itemId
     * @return $this
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param $fieldGroups
     * @return $this
     */
    public function setFieldGroups($fieldGroups)
    {
        $this->fieldGroups = $fieldGroups;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFieldGroups()
    {
        return $this->fieldGroups;
    }

    /**
     * @return string
     */
    public function getCallName()
    {
        $callName = 'item/' . $this->getItemId();
        if ($this->getFieldGroups()) {
            $callName .= '?fieldgroups=' . urlencode($this->getFieldGroups());
        }
        return $callName;
    }
}
