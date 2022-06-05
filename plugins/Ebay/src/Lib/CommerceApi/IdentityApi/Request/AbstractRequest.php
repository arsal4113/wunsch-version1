<?php

namespace Ebay\Lib\CommerceApi\IdentityApi\Request;

use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Entity\GrantType;

/**
 * Class AbstractRequest
 * @package Ebay\Lib\CommerceApi\IdentityApi\Request
 */
class AbstractRequest
{
    protected $granType = GrantType::CLIENT_CREDENTIALS;
    protected $tokenType = AccessTokenType::USER;
    protected $requestMethod = 'get';
    protected $scope = 'https://api.ebay.com/oauth/api_scope/commerce.identity.readonly';

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

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function getRequestBody()
    {
        return false;
    }
}