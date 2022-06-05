<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Entity;

/**
 * Class RangeValue
 * @package Ebay\Lib\BuyApi\BrowseApi\Entity
 */
class RangeValue
{
    private $end;
    private $range;
    private $start;

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param $end
     * @return $this
     */
    public function setEnd($end)
    {
        $this->end = $end;
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
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param $start
     * @return $this
     */
    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $string = '';
        if (!empty($this->start) || !empty($this->end)) {
            $string .= '[' . $this->start;
            if (isset($this->end)) {
                $string .= '..' . $this->end;
            }
            $string .= ']';
        }
        return $string;
    }
}
