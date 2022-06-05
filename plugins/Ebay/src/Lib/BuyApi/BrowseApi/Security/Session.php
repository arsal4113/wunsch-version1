<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Security;

use Cake\Http\Client;

class Session
{
    const ENDPOINT_LIVE = "https://api.ebay.com/buy/browse/v1/";
    const ENDPOINT_SANDBOX = "https://api.sandbox.ebay.com/buy/browse/v1/";

    private $mode = "sandbox";
    private $endpoint;
    private $requestBody;
    private $client;
    private $accessToken;
    private $ebayGlobalId;
    private $userLocation;
    private $timeout = 30;

    private $requestHeader = [
        'Content-Type' => 'application/json',
        'Accept-Encoding' => 'gzip'
    ];

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->endpoint = self::ENDPOINT_SANDBOX;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setHeaderValue($key, $value)
    {
        $this->requestHeader[$key] = $value;
        return $this;
    }

    /**
     * @param $mode
     * @return $this
     */
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

    /**
     * @param $ebayGlobalId
     * @return $this
     */
    public function setEbayGlobalId($ebayGlobalId)
    {
        $this->ebayGlobalId = $ebayGlobalId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEbayGlobalId()
    {
        return $this->ebayGlobalId;
    }

    /**
     * @param $country
     * @param null $postalCode
     * @return $this
     */
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

    /**
     * @return mixed
     */
    public function getUserLocation()
    {
        return $this->userLocation;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param $requestBody
     * @return $this
     */
    public function setRequestBody($requestBody)
    {
        $this->requestBody = $requestBody;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * @return array
     */
    public function getRequestHeader()
    {
        return $this->buildRequestHeader();
    }

    /**
     * @return array
     */
    private function buildRequestHeader()
    {
        if ($this->getAccessToken()) {
            $this->setHeaderValue('authorization', 'Bearer ' . $this->getAccessToken());
        }

        if ($this->getEbayGlobalId()) {
            $this->setHeaderValue('X-EBAY-C-MARKETPLACE-ID', $this->getEbayGlobalId());
        }

        if ($this->getUserLocation()) {
            $this->setHeaderValue('X-EBAY-C-ENDUSERCTX', $this->getUserLocation());
        }
        return ['headers' => $this->requestHeader];
    }

    public function setTimeout(int $timeout = 30)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return bool|mixed
     */
    public function sendRequest()
    {
        $body = $this->getRequestBody();
        if (empty($this->client)) {
            $this->client = new Client(['timeout' => $this->timeout]);
        }
        $response = $this->client->{$body->getRequestMethod()}($this->getEndpoint() . $body->getCallName(), $body->getRequestBody(), $this->getRequestHeader());
        if (!empty($response)) {
            return json_decode($response->body);
        }
        return false;
    }
}
