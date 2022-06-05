<?php

namespace Ebay\Lib\TradingApi\Entity;

use Ebay\Lib\TradingApi\Entity\BaseComplexType;

class RequesterCredentials extends BaseComplexType
{

    private $eBayAuthToken;

    public function seteBayAuthToken($eBayAuthToken)
    {
        $this->eBayAuthToken = $eBayAuthToken;
    }

    public function geteBayAuthToken()
    {
        return $this->eBayAuthToken;
    }

    public function __construct()
    {
        parent::__construct();
        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
                'eBayAuthToken' => [
                    'type' => 'token',
                    'endNode' => true
                ],
            ];
        }
    }
}