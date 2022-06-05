<?php

namespace Ebay\Lib\TradingApi\Request;

/**
 * GetCategoriesRequest
 *
 */
class GetCategoriesRequest extends AbstractRequest
{

    /**
     * Category Site ID
     * @var integer
     */
    protected $categorySiteId;

    /**
     * Detail Level
     *
     * @var string
     */
    protected $detailLevel;

    /**
     * Get Category Site ID
     *
     * @return integer
     */
    public function getCategorySiteId()
    {
        return $this->categorySiteId;
    }

    /**
     * Set Category Site ID
     *
     * @param integer $categorySiteId
     */
    public function setCategorySiteId($categorySiteId)
    {
        $this->categorySiteId = $categorySiteId;
    }

    /**
     * Get Detail Level
     *
     * @return string
     */
    public function getDetailLevel()
    {
        return $this->detailLevel;
    }

    /**
     * Set Detail Level
     *
     * @param string $detailLevel
     */
    public function setDetailLevel($detailLevel)
    {
        $this->detailLevel = $detailLevel;
    }

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setCallName($this->getClassName($this));

        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
                'CategorySiteID' => [
                    'type' => 'integer',
                    'endNode' => true
                ],
                'DetailLevel' => [
                    'type' => 'string',
                    'endNode' => true
                ]
            ];

            self::$_elements[$this->getClassName($this)] = array_merge(
                self::$_elements[$this->getClassName(get_parent_class())],
                self::$_elements[$this->getClassName($this)]
            );
        }
    }
}
