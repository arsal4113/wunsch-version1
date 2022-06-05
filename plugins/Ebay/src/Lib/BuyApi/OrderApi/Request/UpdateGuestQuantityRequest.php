<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

class UpdateGuestQuantityRequest extends AbstractRequest
{
    protected $requestMethod = 'post';
    protected $checkoutSessionId;
    protected $lineItemId;
    protected $quantity;

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
        return "guest_checkout_session/" . $this->getCheckoutSessionId() . "/update_quantity";
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

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getRequestBody()
    {
        return json_encode(
            [
                'lineItemId' => $this->getLineItemId(),
                'quantity' => $this->getQuantity()
            ]
        );
    }
}