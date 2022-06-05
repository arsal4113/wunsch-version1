<?php

namespace Ebay\Lib\BuyApi\OrderApi\Entity;

class CreditCard extends AbstractEntity
{
    protected $accountHolderName;
    protected $billingAddress;
    protected $brand;
    protected $cardNumber;
    protected $cvvNumber;
    protected $expireMonth;
    protected $expireYear;

    public function getAccountHolderName()
    {
        return $this->accountHolderName;
    }

    public function setAccountHolderName($accountHolderName)
    {
        $this->accountHolderName = $accountHolderName;
        return $this;
    }

    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function getCvvNumber()
    {
        return $this->cvvNumber;
    }

    public function setCvvNumber($cvvNumber)
    {
        $this->cvvNumber = $cvvNumber;
        return $this;
    }

    public function getExpireMonth()
    {
        return $this->expireMonth;
    }

    public function setExpireMonth($expireMonth)
    {
        $this->expireMonth = $expireMonth;
        return $this;
    }

    public function getExpireYear()
    {
        return $this->expireYear;
    }

    public function setExpireYear($expireYear)
    {
        $this->expireYear = $expireYear;
        return $this;
    }
}