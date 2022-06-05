<?php

namespace Ebay\Lib\BuyApi\OrderApi\Entity;

class Wallet extends AbstractEntity
{
    protected $paymentToken;

    public function getPaymentToken()
    {
        return $this->paymentToken;
    }

    public function setPaymentToken($paymentToken)
    {
        $this->paymentToken = $paymentToken;
        return $this;
    }
}
