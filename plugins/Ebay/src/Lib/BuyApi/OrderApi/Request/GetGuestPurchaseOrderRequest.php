<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

class GetGuestPurchaseOrderRequest extends AbstractRequest
{
    protected $requestMethod = 'get';
    protected $purchaseOrderId;
    const ENDPOINT_LIVE = "https://api.ebay.com/buy/order/v1/";
    const ENDPOINT_SANDBOX = "https://api.sandbox.ebay.com/buy/order/v1/";

    public function setGuestPurchaseOrderId($purchaseOrderId)
    {
        $this->purchaseOrderId = $purchaseOrderId;
        return $this;
    }

    public function getGuestPurchaseOrderId()
    {
        return $this->purchaseOrderId;
    }

    public function getCallName()
    {
        return "guest_purchase_order/" . $this->getGuestPurchaseOrderId();
    }

    public function getRequestBody()
    {
        return '{}';
    }

    public function getEndpoint($mode)
    {
        $mode = strtolower(trim($mode));
        if ($mode == 'live') {
            return self::ENDPOINT_LIVE;
        }
        return self::ENDPOINT_SANDBOX;
    }
}
