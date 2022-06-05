<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

class UpdateGuestShippingOptionRequest extends AbstractRequest
{
    protected $requestMethod = 'post';
    protected $checkoutSessionId;
    protected $lineItemId;
    protected $shippingOptionId;

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
        return "guest_checkout_session/" . $this->getCheckoutSessionId() . "/update_shipping_option";
    }

    public function setLineItemId($lineItemId)
    {
        $this->lineItemId = $lineItemId;
        return $this;
    }

    public function getLineItemId()
    {
        return $this->lineItemId;
    }

    public function setShippingOptionId($shippingOptionId)
    {
        $this->shippingOptionId = $shippingOptionId;
        return $this;
    }

    public function getShippingOptionId()
    {
        return $this->shippingOptionId;
    }

    public function getRequestBody()
    {
        return json_encode(
            [
                'lineItemId' => $this->getLineItemId(),
                'shippingOptionId' => $this->getShippingOptionId()
            ]
        );
    }
}