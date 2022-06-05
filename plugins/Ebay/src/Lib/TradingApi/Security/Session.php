<?php
namespace Ebay\Lib\TradingApi\Security;

use Cake\Network\Http\Client;
use Ebay\Lib\TradingApi\Entity\RequesterCredentials;

class Session
{
    const ENDPOINT_LIVE = "https://api.ebay.com/ws/api.dll";
    const ENDPOINT_SANDBOX = "https://api.sandbox.ebay.com/ws/api.dll";

    private $mode = "sandbox";
    private $endpoint;
    private $token;
    private $siteId;
    private $apiVersion;
    private $apiDetailLevel;
    private $appId;
    private $certId;
    private $devId;
    private $callName;
    private $requestBody;
    private $client;

    private $requestHeader = ['headers' => [
        'Content-Type' => 'text/xml',
        'X-EBAY-API-COMPATIBILITY-LEVEL' => '',
        'X-EBAY-API-SITEID' => '',
        'X-EBAY-API-CALL-NAME' => '',
        'X-EBAY-API-DETAIL-LEVEL' => '',
        'X-EBAY-API-APP-NAME' => '',
        'X-EBAY-API-DEV-NAME' => '',
        'X-EBAY-API-CERT-NAME' => ''
    ]];


    public function __construct()
    {
        $this->endpoint = self::ENDPOINT_SANDBOX;
    }

    public function setAppId($appId)
    {
        $this->appId = $appId;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setCertId($certId)
    {
        $this->certId = $certId;
    }

    public function getCertId()
    {
        return $this->certId;
    }

    public function setDevId($devId)
    {
        $this->devId = $devId;
    }

    public function getDevId()
    {
        return $this->devId;
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
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;
    }

    public function getSiteId()
    {
        return $this->siteId;
    }

    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * @param mixed $apiDetailLevel
     */
    public function setApiDetailLevel($apiDetailLevel)
    {
        $this->apiDetailLevel = $apiDetailLevel;
    }

    /**
     * @return mixed
     */
    public function getApiDetailLevel()
    {
        return $this->apiDetailLevel;
    }

    public function setCallName($callName)
    {
        $this->callName = str_replace('Request', '', $callName);
    }

    public function getCallName()
    {
        return $this->callName;
    }

    public function setRequestBody($requestObject)
    {
        $sessionToken = $this->getToken();
        if (!empty($sessionToken)) {
            $requesterCredentials = new RequesterCredentials();
            $requesterCredentials->seteBayAuthToken($sessionToken);
            $requestObject->setRequesterCredentials($requesterCredentials);
        }
        $apiVersion = $this->getApiVersion();
        if (!empty($apiVersion)) {
            $requestObject->setVersion($apiVersion);
        }
        $this->setCallName($requestObject->getCallName());
        $this->requestBody = $requestObject->toXml();
    }

    public function getRequestBody()
    {
        return $this->requestBody;
    }

    public function getRequestHeader()
    {
        $this->buildRequestHeader();
        return $this->requestHeader;
    }

    private function buildRequestHeader()
    {
        $this->requestHeader['headers']['X-EBAY-API-COMPATIBILITY-LEVEL'] = $this->getApiVersion();
        $this->requestHeader['headers']['X-EBAY-API-SITEID'] = $this->getSiteId();
        $this->requestHeader['headers']['X-EBAY-API-CALL-NAME'] = $this->getCallName();
        $this->requestHeader['headers']['X-EBAY-API-DETAIL-LEVEL'] = $this->getApiDetailLevel();
        $this->requestHeader['headers']['X-EBAY-API-APP-NAME'] = $this->getAppId();
        $this->requestHeader['headers']['X-EBAY-API-DEV-NAME'] = $this->getDevId();
        $this->requestHeader['headers']['X-EBAY-API-CERT-NAME'] = $this->getCertId();
        foreach ($this->requestHeader['headers'] as $key => $value) {
            if (empty($value) && $value != '0') {
                unset($this->requestHeader['headers'][$key]);
            }
        }
    }

    public function sendRequest()
    {
        $header = $this->getRequestHeader();
        $body = $this->getRequestBody();

        if (empty($this->client)) {
            $this->client = new Client();
        }

        $response = $this->client->post($this->endpoint, $body, $header);
        if (!empty($response)) {
            return new \SimpleXMLElement(iconv('UTF-8', 'UTF-8//IGNORE', $response->body));
        }
        return false;
    }
}