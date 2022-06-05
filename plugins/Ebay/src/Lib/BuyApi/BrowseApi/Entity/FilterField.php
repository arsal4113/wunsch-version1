<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Entity;

/**
 * Class FilterField
 * @package Ebay\Lib\BuyApi\BrowseApi\Entity
 */
class FilterField
{
    private $field;
    private $negated;
    private $range;
    private $set = [];
    private $value;

    /**
     * FilterField constructor.
     * @param string $fieldName
     */
    public function __construct($fieldName = '')
    {
        if (!empty($fieldName)) {
            $this->setField($fieldName);
        }
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
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
     * @return mixed
     */
    public function getNegated()
    {
        return $this->negated;
    }

    /**
     * @param $negated
     * @return $this
     */
    public function setNegated($negated)
    {
        $this->negated = $negated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param $range
     * @return $this
     */
    public function setRange($range)
    {
        $this->range = $range;
        return $this;
    }

    /**
     * @return array
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * @param $set
     * @return $this
     */
    public function setSet($set)
    {
        $this->set = $set;
        return $this;
    }

    /**
     * @param $set
     * @return $this
     */
    public function appendSet($set)
    {
        $this->set[] = $set;
        return $this;
    }

    /**
     * @param $index
     * @return $this
     */
    public function removeSet($index)
    {
        array_splice($this->set, $index, 1);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $value = $this->value;
        $set = $this->formatSet();
        $range = $this->formatRange();

        if (!empty($value) || !empty($set) || !empty($range)) {
            return $string = $this->field . ':' . $value . $set . $range;
        }
    }

    /**
     * @return string
     */
    protected function formatRange()
    {
        $result = '';
        if (!empty($this->range)) {
            $result = $this->range->toString();
        }
        return $result;
    }

    /**
     * @return string
     */
    protected function formatSet()
    {
        $result = '';
        if (!empty($this->set)) {
            $result = "{";
            foreach ($this->set as $key => $value) {
                $result .= $value;
                if ($key < count($this->set) - 1) {
                    $result .= "|";
                }
            }
            $result .= "}";
        }
        return $result;
    }
}
