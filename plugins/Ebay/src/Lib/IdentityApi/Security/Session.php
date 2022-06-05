<?php

namespace Ebay\Lib\IdentityApi\Security;

use Cake\Http\Client;
use Ebay\Lib\IdentityApi\Entity\EbaySite;
use Ebay\Lib\IdentityApi\Entity\RequestType;


/**
 *
 * Class Session
 * @package Ebay\Lib\IdentityApi\Security
 */
class Session
{
    const ENDPOINTS = [
        RequestType::AUTHORIZE =>
            [
                'live' => 'https://auth.{{domain}}/oauth2/authorize',
                'sandbox' => 'https://auth.sandbox.{{domain}}/oauth2/authorize'
            ],
        RequestType::GENERATE_TOKEN =>
            [
                'live' => 'https://api.ebay.com/identity/v1/oauth2/token',
                'sandbox' => 'https://api.sandbox.ebay.com/identity/v1/oauth2/token'
            ]
    ];

    private $mode = 'sandbox';
    private $request;
    private $client;
    private $ebayGlobalId = 'EBAY-US';
    private $ebaySite;
    private $accessToken;
    private $appId;
    private $appSecret;
    private $requestHeader = [
        'headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]
    ];

    public function __construct()
    {
        $this->ebaySite = new EbaySite();
    }

    public function setEbayGlobalId($ebayGlobalId)
    {
        if ($this->ebaySite->isValid($ebayGlobalId)) {
            $this->ebayGlobalId = $ebayGlobalId;
        }
        return $this;
    }

    public function getEbayGlobalId()
    {
        return $this->ebayGlobalId;
    }

    public function getDomain()
    {
        return $this->ebaySite->getDomain($this->getEbayGlobalId());
    }

    public function setMode($mode)
    {
        $this->mode = strtolower(trim($mode));
        return $this;
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setAppId($appId)
    {
        $this->appId = trim($appId);
        return $this;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setAppSecret($appSecret)
    {
        $this->appSecret = trim($appSecret);
        return $this;
    }

    public function getAppSecret()
    {
        return $this->appSecret;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getEndpoint()
    {
        if (empty($this->getRequest())) {
            throw new \Exception(__('Please set the request body first.'));
        }
        $endpoint = self::ENDPOINTS[$this->getRequest()->getRequestType()][$this->getMode()] ?? '';
        if (empty($endpoint)) {
            throw new \Exception(__('Unknown combination of requestType {0} and requestMode {1}', [$this->getRequest()->getRequestType(), $this->getMode()]));
        }
        return str_replace('{{domain}}', $this->getDomain(), $endpoint);
    }

    public function getRequestHeader()
    {
        $this->buildRequestHeader();
        return $this->requestHeader;
    }

    private function buildRequestHeader()
    {
        $this->requestHeader['headers']['authorization'] = "Basic " . base64_encode($this->getAppId() . ':' . $this->getAppSecret());
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
        $header = $this->getRequestHeader();
        $requestObject = $this->getRequest();
        if (empty($this->client)) {
            $this->client = new Client();
        }
        $response = $this->client->{$requestObject->getRequestMethod()}($this->getEndpoint(), $requestObject->getRequestBody(), $header);
        if (!empty($response)) {
            return $response->body;
        }
        return false;
    }
}