<?php
namespace Ebay\Lib\TradingApi\Entity;


class NameValueList extends BaseComplexType
{

    protected $name;
    protected $value;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
                'Name' => [
                    'type' => 'string',
                    'endNode' => true
                ],
                'Value' => [
                    'type' => 'string',
                    'endNode' => true
                ]
            ];
        }
    }
}