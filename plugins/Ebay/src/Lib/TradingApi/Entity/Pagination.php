<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 07.09.15
 * Time: 13:28
 */

namespace Ebay\Lib\TradingApi\Entity;

use Ebay\Lib\TradingApi\Entity\BaseComplexType;

class Pagination extends BaseComplexType
{

    protected $entriesPerPage;
    protected $pageNumber;

    /**
     * setEntriesPerPage
     *
     * @param $entriesPerPage
     */
    public function setEntriesPerPage($entriesPerPage)
    {
        $this->entriesPerPage = $entriesPerPage;
    }

    /**
     * getEntriesPerPage
     *
     * @return $entriesPerPage
     */
    public function getEntriesPerPage()
    {
        return $this->entriesPerPage;
    }

    /**
     * setPageNumber
     *
     * @param $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * getPageNumber
     *
     * @return $pageNumber
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    public function __construct()
    {
        parent::__construct();
        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
                'EntriesPerPage' => [
                    'type' => 'number',
                    'endNode' => true
                ],
                'PageNumber' => [
                    'type' => 'number',
                    'endNode' => true
                ]
            ];
        }
    }
}