<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

class GetGuestCheckoutSessionRequest extends AbstractRequest
{
    protected $requestMethod = 'get';
    protected $checkoutSessionId;

    public function setCheckoutSessionId($checkoutSessionId)
    {
        $this->checkoutSessionId = $checkoutSessionId;
        return $this;
    }

    public function getCheckoutSessionId()
    {
        return $this->checkoutSessionId;
    }

    public function getCallName()
    {
        return "guest_checkout_session/" . $this->getCheckoutSessionId();
    }
}