<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

use Ebay\Lib\BuyApi\OrderApi\Entity\CreditCard;
use Ebay\Lib\BuyApi\OrderApi\Entity\Wallet;

class UpdateGuestPaymentInfoRequest extends AbstractRequest
{
    protected $requestMethod = 'post';
    protected $checkoutSessionId;
    protected $creditCard;
    protected $wallet;

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
        return "guest_checkout_session/" . $this->getCheckoutSessionId() . "/update_payment_info";
    }

    /**
     * @param CreditCard $creditCard
     * @return $this
     */
    public function setCreditCard($creditCard)
    {
        $this->creditCard = $creditCard;
        return $this;
    }

    /**
     * @return CreditCard|null
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @return Wallet|null
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @param Wallet $wallet
     * @return $this
     */
    public function setWallet($wallet)
    {
        $this->wallet = $wallet;
        return $this;
    }

    public function getRequestBody()
    {
        $payload = [];
        if ($this->getCreditCard()) {
            $payload['creditCard'] = $this->getCreditCard()->toArray();
        }
        if ($this->getWallet()) {
            $payload['wallet'] = $this->getWallet()->toArray();
        }

        return json_encode($payload);
    }
}
