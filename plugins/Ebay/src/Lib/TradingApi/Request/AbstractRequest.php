<?php

namespace Ebay\Lib\TradingApi\Request;

use Ebay\Lib\TradingApi\Entity\BaseComplexType;

class AbstractRequest extends BaseComplexType
{

    protected $callNameXmlAttribute = "xmlns";
    protected $callNameXmlAttributeValue = "urn:ebay:apis:eBLBaseComponents";
    protected $warningLevel;
    protected $callName;
    protected $errorLanguage;
    protected $version;
    protected $messageId;
    protected $requesterCredentials;

    public function setCallNameXmlAttribute($callNameXmlAttribute)
    {
        return $this->callNameXmlAttribute = $callNameXmlAttribute;
    }

    public function getCallNameXmlAttribute()
    {
        return $this->callNameXmlAttribute;
    }

    public function setCallNameXmlAttributeValue($callNameXmlAttributeValue)
    {
        return $this->callNameXmlAttributeValue = $callNameXmlAttributeValue;
    }

    public function getCallNameXmlAttributeValue()
    {
        return $this->callNameXmlAttributeValue;
    }

    public function setCallName($callName)
    {
        $this->callName = $callName;
    }

    public function getCallName()
    {
        return $this->callName;
    }

    public function setWarningLevel($warningLevel)
    {
        $this->warningLevel = $warningLevel;
    }

    public function getWarningLevel()
    {
        return $this->warningLevel;
    }

    public function setErrorLanguage($errorLanguage)
    {
        $this->errorLanguage = $errorLanguage;
    }

    public function getErrorLanguage()
    {
        return $this->errorLanguage;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setMessageID($messageId)
    {
        $this->messageId = $messageId;
    }

    public function getMessageID()
    {
        return $this->messageId;
    }

    public function setRequesterCredentials($requesterCredentials)
    {
        $this->requesterCredentials = $requesterCredentials;
    }

    public function getRequesterCredentials()
    {
        return $this->requesterCredentials;
    }

    public function __construct()
    {
        parent::__construct();
        if (!isset(self::$_elements[$this->getClassName(__CLASS__)])) {
            self::$_elements[$this->getClassName(__CLASS__)] =
                [
                    'RequesterCredentials' => [
                        'type' => 'RequesterCredentials',
                        'endNode' => false
                    ],
                    'WarningLevel' => [
                        'type' => 'string',
                        'endNode' => true
                    ],
                    'ErrorLanguage' => [
                        'type' => 'string',
                        'endNode' => true
                    ],
                    'Version' => [
                        'type' => 'number',
                        'endNode' => true
                    ],
                    'MessageID' => [
                        'type' => 'string',
                        'endNode' => true
                    ]
                ];
        }
    }
}