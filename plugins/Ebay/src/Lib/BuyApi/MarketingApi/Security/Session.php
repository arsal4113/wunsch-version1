<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 26.04.18
 * Time: 17:20
 */

namespace Ebay\Lib\Rest\BuyApi\MarketingApi\Security;

use Cake\Network\Http\Client;

class Session
{
    const ENDPOINTS = [
        'live' => 'https://api.ebay.com/buy/marketing/v1_beta',
        'sandbox' => 'https://api.sandbox.ebay.com/buy/marketing/v1_beta'
    ];

    private $mode = 'sandbox';
    private $endpoint;
    private $request;
    private $accessToken;
    private $client;
    private $ebayGlobalId;
    private $requestHeader = [
        'Accept-Encoding' => 'application/gzip',
    ];

    public function __construct()
    {
        $this->endpoint = self::ENDPOINTS[$this->mode];
    }

    public function setHeaderValue($key, $value)
    {
        $this->requestHeader[$key] = $value;
        return $this;
    }

    public function setMode($mode)
    {
        $mode = strtolower(trim($mode));
        if (isset(self::ENDPOINTS[$mode])) {
            $this->mode = $mode;
            $this->endpoint = self::ENDPOINTS[$this->mode];
        }
        return $this;
    }

    public function getMode()
    {
        return $this->mode;
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

    public function setEbayGlobalId($ebayGlobalId)
    {
        $this->ebayGlobalId = $ebayGlobalId;
        return $this;
    }

    public function getEbayGlobalId()
    {
        return $this->ebayGlobalId;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getRequestHeader()
    {
        $this->buildRequestHeader();
        return $this->requestHeader;
    }

    private function buildRequestHeader()
    {
        if ($this->getAccessToken()) {
            $this->setHeaderValue('authorization', 'Bearer ' . $this->getAccessToken());
        }

        if ($this->getEbayGlobalId()) {
            $this->setHeaderValue('X-EBAY-C-MARKETPLACE-ID', $this->getEbayGlobalId());
        }
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function sendRequest()
    {
        $request = $this->getRequest();
        if (empty($this->client)) {
            $this->client = new Client();
        }

        $response = $this->client->{$request->getRequestMethod()}(
            $this->getEndpoint() . $request->getRequestUrl(),
            $request->getRequestBody(),
            [
                'headers' => $this->getRequestHeader()
            ]
        );
        if (!empty($response)) {
            return json_decode($response->body);
        }
        return false;
    }
}