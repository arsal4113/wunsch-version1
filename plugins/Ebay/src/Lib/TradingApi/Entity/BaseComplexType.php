<?php

namespace Ebay\Lib\TradingApi\Entity;

use Ebay\Lib\TradingApi\Entity\BaseSimpleType;

class BaseComplexType extends BaseSimpleType
{
    protected static $_elements = [];
    protected $cdataTypes = ['string'];
    protected $namespace = __NAMESPACE__;


    public function toXml($xmlDefinition = true)
    {
        $xml = '';
        if ($xmlDefinition === true) {
            $xml = '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL;
        }

        $xml .= '<' . $this->getCallName() . ' ' . $this->getCallNameXmlAttribute() . '="' . $this->getCallNameXmlAttributeValue() . '">' . PHP_EOL;
        $metaDataElements = $this->getMetaDataElements();
        if (!empty($metaDataElements)) {
            foreach ($this->getMetaDataElements() as $childElementName => $settings) {
                $elementValue = $this->{"get" . $childElementName}();
                $xml .= $this->serializer($childElementName, $elementValue, $settings);
            }
        }
        $xml .= "</" . $this->getCallName() . ">";
        return $xml;
    }

    public function serializer($elementName, $elementValue, $settings)
    {
        $ret = "";
        if (!empty($settings['endNode'])) {
            if (!is_null($elementValue)) {
                if (is_array($elementValue)) {
                    if (!empty($elementValue)) {
                        foreach ($elementValue as $value) {
                            $ret .= BaseSimpleType::serialize($elementName, $value, ((in_array(strtolower($settings['type']), $this->cdataTypes)) ? true : false));
                        }
                    }
                } else {
                    $ret .= BaseSimpleType::serialize($elementName, $elementValue, ((in_array(strtolower($settings['type']), $this->cdataTypes)) ? true : false));
                }
            }
        } else {
            if (!is_null($elementValue)) {
                $metaDataElements = $this->getMetaDataElements($settings['type']);
                if (!empty($metaDataElements)) {
                    $isArray = false;
                    if (is_array($elementValue)) {
                        $isArray = true;
                        foreach ($elementValue as $value) {
                            $ret .= "<" . $elementName . ">" . PHP_EOL;
                            foreach ($metaDataElements as $childElementName => $settings) {
                                $newElementValue = $value->{"get" . $childElementName}();
                                $ret .= $this->serializer($childElementName, $newElementValue, $settings);
                            }
                            $ret .= "</" . $elementName . ">" . PHP_EOL;
                        }
                    } else {
                        foreach ($metaDataElements as $childElementName => $settings) {
                            $newElementValue = $elementValue->{"get" . $childElementName}();
                            $ret .= $this->serializer($childElementName, $newElementValue, $settings);
                        }
                    }
                    if ($isArray === false) {
                        $ret = "<" . $elementName . ">" . PHP_EOL . $ret . "</" . $elementName . ">" . PHP_EOL;
                    }
                }
            }
        }
        return $ret;
    }

    public function getMetaDataElements($class = null)
    {
        if (is_null($class)) {
            $class = $this->getClassName($this);
        }
        if (!isset(self::$_elements[$class])) {
            return false;
        }
        return self::$_elements[$class];
    }

    public function __construct()
    {
        self::$_elements[__CLASS__] = [];
    }

    public function fillFromArray($data)
    {
        if (isset(self::$_elements[$this->getClassName($this)])) {
            foreach (self::$_elements[$this->getClassName($this)] as $propertyName => $settings) {
                if (isset($data[$propertyName])) {
                    if ($settings['endNode'] == true) {
                        $this->{'set' . $propertyName}($data[$propertyName]);
                    } else {
                        $className = $this->namespace . '\\' . $propertyName;
                        $object = new $className();
                        $object->fillFromArray($data[$propertyName]);
                        $this->{'set' . $propertyName}($object);
                    }
                }
            }
        }
    }
}