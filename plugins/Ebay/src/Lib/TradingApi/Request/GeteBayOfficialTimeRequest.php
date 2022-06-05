<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 01.09.15
 * Time: 11:51
 */

namespace Ebay\Lib\TradingApi\Request;

class GeteBayOfficialTimeRequest extends AbstractRequest
{

    public function __construct()
    {
        parent::__construct();
        $this->setCallName($this->getClassName($this));

        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
            ];

            self::$_elements[$this->getClassName($this)] = array_merge(
                self::$_elements[$this->getClassName(get_parent_class())],
                self::$_elements[$this->getClassName($this)]
            );
        }
    }
}