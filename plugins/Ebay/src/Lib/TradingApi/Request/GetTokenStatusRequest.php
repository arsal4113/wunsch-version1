<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 19.04.17
 * Time: 16:02
 */

namespace Ebay\Lib\TradingApi\Request;

class GetTokenStatusRequest extends AbstractRequest
{
    public function __construct()
    {
        parent::__construct();
        $this->setCallName($this->getClassName($this));

        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = self::$_elements[$this->getClassName(get_parent_class())];
        }
    }
}
