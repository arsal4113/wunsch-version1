<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-12-03
 * Time: 15:43
 */

namespace Ebay\Lib\IdentityApi\Request;


use Cake\Utility\Security;

class AbstractRequest
{
    protected $tokenType;
    protected $requestType;
    protected $grantType;
    protected $requestMethod;
    protected $scope;

    public function getGrantType()
    {
        return $this->grantType;
    }

    public function getTokenType()
    {
        return $this->tokenType;
    }

    public function getRequestType()
    {
        return $this->requestType;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    public function getScope()
    {
        return $this->scope;
    }
}