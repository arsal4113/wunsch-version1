<?php

namespace Ebay\Lib\CommerceApi\IdentityApi\Request;

/**
 * Class GetUserRequest
 * @package Ebay\Lib\CommerceApi\IdentityApi\Request
 */
class GetUserRequest extends AbstractRequest
{
    protected $scope = 'https://api.ebay.com/oauth/api_scope/commerce.identity.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.address.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.email.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.name.readonly https://api.ebay.com/oauth/api_scope/commerce.identity.phone.readonly';

    /**
     * @return string
     */
    public function getCallName()
    {
        return '/user';
    }
}