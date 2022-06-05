<?php

namespace Ebay\Lib\BuyApi\OrderApi\Entity;

class AbstractEntity
{
    public function toArray()
    {
        $tmp = [];

        $properties = get_object_vars($this);
        foreach ($properties as $property => $value) {
            $propertyClass = trim(str_replace(get_class($this), '', $property));

            if (is_object($value)) {
                $value = $this->getNestedPropertyValues($value);
            }

            if (is_array($value)) {
                foreach ($value as $key => $data) {
                    if (is_null($data)) {
                        unset($value[$key]);
                    }
                }
            }
            if (!is_null($value)) {
                $tmp[$propertyClass] = $value;
            }
        }
        return $tmp;
    }

    protected function getNestedPropertyValues($property)
    {
        $propertyValues = get_object_vars($property);
        if (is_object($propertyValues)) {
            $propertyValues = $this->getNestedPropertyValues($propertyValues);
            if (is_object($propertyValues)) {
                $propertyValues = $this->getNestedPropertyValues($propertyValues);
            }
        }

        foreach ($propertyValues as $propertyKey => $propertyValue) {
            if (is_null($propertyValue)) {
                unset($propertyValues[$propertyKey]);
            }
        }

        return $propertyValues;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}