<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

class PlaceGuestOrderRequest extends AbstractRequest
{

    protected $requestMethod = 'post';
    protected $checkoutSessionId;
    protected $marketingTerms = [];

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
        return "guest_checkout_session/" . $this->getCheckoutSessionId() . "/place_order";
    }

    public function getMarketingTerms()
    {
        return $this->marketingTerms;
    }

    /**
     * @param $marketingTerms[]
     * @return $this
     */
    public function setMarketingTerms($marketingTerms)
    {
        $this->marketingTerms = $marketingTerms;
        return $this;
    }

    public function appendMarketingTerm($marketingTerms)
    {
        $this->marketingTerms[] = $marketingTerms;
        return $this;
    }

    public function getRequestBody()
    {
        $tmp = [];
        if (!empty($this->marketingTerms)) $tmp['marketingTerms'] = [];
        foreach ($this->marketingTerms as $marketingTerm) {
            array_push($tmp['marketingTerms'], $marketingTerm->toArray());
        }
        return json_encode($tmp);
    }
}
