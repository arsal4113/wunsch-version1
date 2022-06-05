<?php


namespace Ebay\Lib\CommerceApi\IdentityApi\Security;


use Cake\Network\Http\Client;

/**
 * Class Session
 * @package Ebay\Lib\CommerceApi\IdentityApi\Security
 */
class Session
{
    const ENDPOINT_LIVE = "https://apiz.ebay.com/commerce/identity/v1";
    const ENDPOINT_SANDBOX = "https://apiz.sandbox.ebay.com/commerce/identity/v1";

    private $mode = "live";
    private $endpoint;
    private $requestBody;
    private $client;
    private $accessToken;
    private $ebayGlobalId;
    private $requestHeader = [
        'Content-Type' => 'application/json',
    ];

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->endpoint = self::ENDPOINT_LIVE;
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
        return ['headers' => $this->requestHeader];
    }

    /**
     * @return bool|mixed
     */
    public function sendRequest()
    {
        $body = $this->getRequestBody();
        if (empty($this->client)) {
            $this->client = new Client();
        }

        $options = [
            'ssl_verify_peer' => false,
            'ssl_verify_peer_name' => false,
            'ssl_verify_host' => false
        ];
        $options = array_merge($options, $this->getRequestHeader());

        $response = $this->client->{$body->getRequestMethod()}($this->getEndpoint() . $body->getCallName(), $body->getRequestBody(), $options);

        if (!empty($response)) {
            return json_decode($response->body);
        }
        return false;
    }
}