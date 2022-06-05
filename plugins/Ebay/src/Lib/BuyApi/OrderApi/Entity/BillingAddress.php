<?php

namespace Ebay\Lib\BuyApi\OrderApi\Entity;


class BillingAddress extends AbstractEntity
{
    protected $addressLine1;
    protected $addressLine2;
    protected $city;
    protected $country;
    protected $county;
    protected $firstName;
    protected $lastName;
    protected $postalCode;
    protected $stateOrProvince;

    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
        return $this;
    }

    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function getCounty()
    {
        return $this->county;
    }

    public function setCounty($county)
    {
        $this->county = $county;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getStateOrProvince()
    {
        return $this->stateOrProvince;
    }

    public function setStateOrProvince($stateOrProvince)
    {
        $this->stateOrProvince = $stateOrProvince;
        return $this;
    }
}