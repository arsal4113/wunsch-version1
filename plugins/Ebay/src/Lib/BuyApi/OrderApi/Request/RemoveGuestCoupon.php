<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

class RemoveGuestCoupon extends AbstractRequest
{
    protected $requestMethod = 'post';
    protected $checkoutSessionId;
    protected $redemptionCode;

    /**
     * @param string $checkoutSessionId
     * @return $this
     */
    public function setCheckoutSessionId($checkoutSessionId)
    {
        $this->checkoutSessionId = $checkoutSessionId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCheckoutSessionId()
    {
        return $this->checkoutSessionId;
    }

    /**
     * @return string
     */
    public function getCallName()
    {
        return "guest_checkout_session/" . $this->getCheckoutSessionId() . "/remove_coupon";
    }

    /**
     * @return string
     */
    public function getRedemptionCode()
    {
        return $this->redemptionCode;
    }

    /**
     * @param string $redemptionCode
     * @return $this
     */
    public function setRedemptionCode($redemptionCode)
    {
        $this->redemptionCode = $redemptionCode;
        return $this;
    }

    /**
     * @return bool|false|string
     */
    public function getRequestBody()
    {
        return json_encode(
            [
                'redemptionCode' => $this->getRedemptionCode()
            ]
        );
    }

}
