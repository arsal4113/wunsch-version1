<?php
namespace Ebay\Lib\TradingApi\Request;

/**
 * GetApiAccessRulesRequest
 *
 */
class GetApiAccessRulesRequest extends AbstractRequest
{
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
            ];

            self::$_elements[$this->getClassName($this)] = array_merge(
                self::$_elements[$this->getClassName(get_parent_class())],
                self::$_elements[$this->getClassName($this)]
            );
        }
    }
}
