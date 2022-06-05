<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

class InitiateGuestPaymentRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $requestMethod = 'post';
    /**
     * @var string
     */
    protected $checkoutSessionId;
    /**
     * @var string
     */
    protected $paymentMethodBrandType;
    /**
     * @var string
     */
    protected $paymentMethodType;

    const PAYMENT_METHOD_BRAND_TYPE_PAYPAL_CHECKOUT = 'PAYPAL_CHECKOUT';

    const PAYMENT_METHOD_TYPE_WALLET = 'WALLET';

    /**
     * @return mixed
     */
    public function getPaymentMethodBrandType()
    {
        return $this->paymentMethodBrandType;
    }

    /**
     * @param mixed $paymentMethodBrandType
     * @return InitiateGuestPaymentRequest
     */
    public function setPaymentMethodBrandType($paymentMethodBrandType)
    {
        $this->paymentMethodBrandType = $paymentMethodBrandType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethodType()
    {
        return $this->paymentMethodType;
    }

    /**
     * @param mixed $paymentMethodType
     */
    public function setPaymentMethodType($paymentMethodType)
    {
        $this->paymentMethodType = $paymentMethodType;
    }

    /**
     * @param $checkoutSessionId
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
        return "guest_checkout_session/" . $this->getCheckoutSessionId() . "/initiate_payment";
    }

    /**
     * @return bool|string
     */
    public function getRequestBody()
    {
        $tmp = [];
        if (isset($this->paymentMethodBrandType)) $tmp['paymentMethodBrandType'] = $this->paymentMethodBrandType;
        if (isset($this->paymentMethodType)) $tmp['paymentMethodType'] = $this->paymentMethodType;
        return json_encode($tmp);
    }
}
