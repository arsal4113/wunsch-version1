<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Request;

use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Entity\GrantType;

/**
 * Class AbstractRequest
 * @package Ebay\Lib\BuyApi\BrowseApi\Request
 */
class AbstractRequest
{
    /**
     * @deprecated will be removed in the next version. Use tokenType instead.
     * @var string
     */
    protected $granType = GrantType::CLIENT_CREDENTIALS;
    protected $tokenType = AccessTokenType::APPLICATION;
    protected $requestMethod = 'get';
    protected $scope = 'https://api.ebay.com/oauth/api_scope';

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @deprecated will be removed in the next version. Use tokenType instead.
     * @return mixed
     */
    public function getGrantType()
    {
        return $this->granType;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @return bool
     */
    public function getRequestBody()
    {
        return false;
    }
}
