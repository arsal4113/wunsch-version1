<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 27.07.15
 * Time: 14:58
 */

namespace Ebay\Lib\TradingApi\Request;

class FetchTokenRequest extends AbstractRequest
{

    protected $sessionId;

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setCallName($this->getClassName($this));

        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
                'SessionID' => [
                    'type' => 'string',
                    'endNode' => true
                ]];

            self::$_elements[$this->getClassName($this)] = array_merge(
                self::$_elements[$this->getClassName(get_parent_class())],
                self::$_elements[$this->getClassName($this)]
            );
        }
    }
}