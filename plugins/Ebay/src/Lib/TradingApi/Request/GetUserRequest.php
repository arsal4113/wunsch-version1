<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 26.01.16
 * Time: 15:25
 */

namespace Ebay\Lib\TradingApi\Request;

class GetUserRequest extends AbstractRequest
{

    protected $userId;
    protected $detailLevel;


    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserID()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getDetailLevel()
    {
        return $this->detailLevel;
    }

    /**
     * @param mixed $detailLevel
     */
    public function setDetailLevel($detailLevel)
    {
        $this->detailLevel = $detailLevel;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setCallName($this->getClassName($this));

        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
                'UserID' => [
                    'type' => 'string',
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