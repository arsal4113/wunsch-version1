<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Entity;

/**
 * Class SortField
 * @package Ebay\Lib\BuyApi\BrowseApi\Entity
 */
class SortField
{
    private $ascending;
    private $field;

    /**
     * @param $ascending
     * @return $this
     */
    public function setAscending($ascending)
    {
        $this->ascending = $ascending;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAscending()
    {
        return $this->ascending;
    }

    /**
     * @param $field
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return ($this->ascending ? '' : '-') . $this->field;
    }
}
