<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 23.07.15
 * Time: 16:18
 */

namespace Ebay\Lib\TradingApi\Request;

class GetSessionIDRequest extends AbstractRequest
{

    protected $ruName;

    public function setRuName($ruName)
    {
        $this->ruName = $ruName;
    }

    public function getRuName()
    {
        return $this->ruName;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setCallName($this->getClassName($this));

        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
                'RuName' => [
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