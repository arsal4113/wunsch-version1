<?php

namespace Ebay\Lib\BuyApi\OrderApi\Security;

use Cake\Log\Log;
use Cake\Network\Http\Client;

class Session
{
    const ENDPOINT_LIVE = "https://apix.ebay.com/buy/order/v1/";
    const ENDPOINT_SANDBOX = "https://api.sandbox.ebay.com/buy/order/v1/";

    private $mode = "sandbox";
    private $endpoint;
    private $requestBody;
    private $client;
    private $callName;
    private $accessToken;
    private $ebayGlobalId;
    private $userLocation;
    private $affiliateReference;

    private $requestHeader = [
        'Content-Type' => 'application/json'
    ];


    public function __construct()
    {
        $this->endpoint = self::ENDPOINT_SANDBOX;
    }

    public function setHeaderValue($key, $value)
    {
        $this->requestHeader[$key] = $value;
        return $this;
    }

    public function appendHeaderValue($key, $value)
    {
        if (isset($this->requestHeader[$key]) && !empty($this->requestHeader[$key])) {
            $this->requestHeader[$key] .= ',' . $value;
        } else {
            $this->requestHeader[$key] = $value;
        }
        return $this;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function setMode($mode)
    {
        $mode = strtolower(trim($mode));
        if ($mode == 'live') {
            $this->endpoint = self::ENDPOINT_LIVE;
        } else {
            $this->endpoint = self::ENDPOINT_SANDBOX;
        }
        $this->mode = $mode;
        return $this;
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setEbayGlobalId($ebayGlobalId)
    {
        $this->ebayGlobalId = $ebayGlobalId;
        return $this;
    }

    public function getEbayGlobalId()
    {
        return $this->ebayGlobalId;
    }

    public function setUserLocation($country, $postalCode = null)
    {
        $location = [];
        if (!empty($country)) {
            $location['country'] = $country;
        }
        if (!empty($postalCode)) {
            $location['zip'] = $postalCode;
        }

        if (!empty($location)) {
            $this->userLocation = 'contextualLocation=' . http_build_query($location, '', ',');
        }
        return $this;
    }

    public function getUserLocation()
    {
        return $this->userLocation;
    }

    public function setAffiliateReference($referenceId, $campaignId = null)
    {
        $affiliateReference = [];
        if (!empty($referenceId)) {
            $affiliateReference['affiliateReferenceId'] = $referenceId;
        }
        if (!empty($campaignId)) {
            $affiliateReference['affiliateCampaignId'] = $campaignId;
        }

        if (!empty($affiliateReference)) {
            $this->affiliateReference = http_build_query($affiliateReference, '', ',');
        }
        return $this;
    }

    public function getAffiliateReference()
    {
        return $this->affiliateReference;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setCallName($callName)
    {
        $this->callName = $callName;
        return $this;
    }

    public function getCallName()
    {
        return $this->callName;
    }

    public function setRequestBody($requestBody)
    {
        $this->requestBody = $requestBody;
        return $this;
    }

    public function getRequestBody()
    {
        return $this->requestBody;
    }

    public function getRequestHeader()
    {
        return $this->buildRequestHeader();
    }

    private function buildRequestHeader()
    {
        if ($this->getAccessToken()) {
            $this->setHeaderValue('authorization', 'Bearer ' . $this->getAccessToken());
        }
        if ($this->getEbayGlobalId()) {
            $this->setHeaderValue('X-EBAY-C-MARKETPLACE-ID', $this->getEbayGlobalId());
        }
        if ($this->getUserLocation()) {
            $this->appendHeaderValue('X-EBAY-C-ENDUSERCTX', $this->getUserLocation());
        }
        if ($this->getAffiliateReference()) {
            $this->appendHeaderValue('X-EBAY-C-ENDUSERCTX', $this->getAffiliateReference());
        }

        return ['headers' => $this->requestHeader];
    }

    public function sendRequest()
    {
        $header = $this->getRequestHeader();
        $body = $this->getRequestBody();
        if (empty($this->client)) {
            $this->client = new Client();
        }
        $endpoint = null;
        if (method_exists($body, 'getEndpoint')) {
            $endpoint = $body->getEndpoint($this->getMode());
        } else {
            $endpoint = $this->getEndpoint();
        }

        $response = $this->client->{$body->getRequestMethod()}($endpoint . $body->getCallName(), $body->getRequestBody(), $header);

        if (!empty($response)) {
            $responseBody = json_decode($response->body);

            $rlogid = $response->headers['rlogid'] ?? null;
            if (!empty($rlogid)) {
                $responseBody->rlogid = $rlogid;
            }

            return $responseBody;
        }

        return false;
    }
}
