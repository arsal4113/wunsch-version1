<?php
namespace Ebay\Lib\TradingApi\Entity;

class BaseSimpleType
{

    public function serialize($elementName, $elementValue, $cdata = false)
    {
        $xmlString = "";
        $cdataPrefix = "";
        $cdataSuffix = "";

        if ($cdata === true) {
            $cdataPrefix = "<![CDATA[";
            $cdataSuffix = "]]>";
        }

        if (isset($elementValue)) {
            if (!empty($elementName)) {
                $xmlString .= "<" . $elementName . ">";
                $xmlString .= $cdataPrefix . trim($elementValue) . $cdataSuffix;
                $xmlString .= "</" . $elementName . ">" . PHP_EOL;
            }
        }
        return $xmlString;
    }

    public function getClassName($obj)
    {
        if (is_object($obj)) {
            $className = get_class($obj);
        } else {
            $className = $obj;
        }
        if (preg_match('@\\\\([\w]+)$@', $className, $matches)) {
            $className = $matches[1];
        }
        return $className;
    }
}