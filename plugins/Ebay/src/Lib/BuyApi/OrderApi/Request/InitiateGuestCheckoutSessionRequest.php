<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

use \Ebay\Lib\BuyApi\OrderApi\Entity\JSON;

class InitiateGuestCheckoutSessionRequest extends AbstractRequest
{
    protected $requestMethod = 'post';
    protected $contactEmail;
    protected $contactFirstName;
    protected $contactLastName;
    protected $creditCard;
    protected $lineItemInputs = [];
    protected $shippingAddress;


    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
        return $this;
    }

    public function getContactEmail()
    {
        return $this->conctactEmail;
    }

    public function setContactFirstName($contactFirstName)
    {
        $this->contactFirstName = $contactFirstName;
        return $this;
    }

    public function getContactFirstName()
    {
        return $this->conctactFirstName;
    }


    public function setContactLastName($contactLastName)
    {
        $this->contactLastName = $contactLastName;
        return $this;
    }

    public function getContactLastName()
    {
        return $this->conctactLastName;
    }

    public function setCreditCard($creditCard)
    {
        $this->creditCard = $creditCard;
        return $this;
    }

    public function getCreditCard()
    {
        return $this->creditCard;
    }

    public function getCallName()
    {
        return "guest_checkout_session/initiate";
    }

    public function getLineItemInputs()
    {
        return $this->lineItemInputs;
    }

    public function setLineItemInputs($lineItemInputs)
    {
        $this->lineItemInputs = $lineItemInputs;
        return $this;
    }

    public function appendLineItemInput($lineItemInput)
    {
        $this->lineItemInputs[] = $lineItemInput;
        return $this;
    }

    public function removeLineItemInput($index)
    {
        array_splice($this->lineItemInputs, $index, 1);
        return $this;
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
        $tmp = [];
        if (isset($this->contactEmail)) $tmp['contactEmail'] = $this->contactEmail;
        if (isset($this->contactFirstName)) $tmp['contactFirstName'] = $this->contactFirstName;
        if (isset($this->contactLastName)) $tmp['contactLastName'] = $this->contactLastName;
        if (isset($this->creditCard)) $tmp['creditCard'] = $this->creditCard->toArray();
        if (isset($this->shippingAddress)) $tmp['shippingAddress'] = $this->shippingAddress->toArray();
        if (!empty($this->lineItemInputs)) $tmp['lineItemInputs'] = [];

        foreach ($this->lineItemInputs as $key => $value) {
            array_push($tmp['lineItemInputs'], $value->toArray());
        }
        return json_encode($tmp);
    }
}