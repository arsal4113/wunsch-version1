<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Entity;

use Ebay\Lib\BuyApi\OrderApi\Entity\JSON;

/**
 * Class AspectFilter
 * @package Ebay\Lib\BuyApi\BrowseApi\Entity
 */
class AspectFilter
{
    private $categoryId;
    private $filterFields = [];

    /**
     * @param $filterField
     * @return $this
     */
    public function appendFilterField($filterField)
    {
        $this->filterFields[] = $filterField;
        return $this;
    }

    /**
     * @param $index
     * @return $this
     */
    public function removeFilterField($index)
    {
        array_splice($this->filterFields, $index, 1);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param $categoryId
     * @return $this
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return array
     */
    public function getFilterFields()
    {
        return $this->filterFields;
    }

    /**
     * @param $filterFields
     * @return $this
     */
    public function setFilterFields($filterFields)
    {
        $this->filterFields = $filterFields;
        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $string = 'categoryId:' . $this->categoryId . ',';
        foreach ($this->filterFields as $key => $value) {
            $string .= $value->toString();
            if ($key != count($this->filterFields) - 1) {
                $string .= ',';
            }
        }
        return $string;
    }
}
