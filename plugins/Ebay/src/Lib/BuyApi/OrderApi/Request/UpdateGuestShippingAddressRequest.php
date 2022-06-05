<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

class UpdateGuestShippingAddressRequest extends AbstractRequest
{
    protected $requestMethod = 'post';
    protected $checkoutSessionId;
    protected $shippingAddress;


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
        return "guest_checkout_session/" . $this->getCheckoutSessionId() . "/update_shipping_address";
    }

    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    public function getRequestBody()
    {
        return json_encode($this->shippingAddress->toArray());
    }
}