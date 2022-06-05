<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-12-03
 * Time: 16:45
 */

namespace Ebay\Lib\IdentityApi\Request;


use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Entity\GrantType;
use Ebay\Lib\IdentityApi\Entity\RequestType;

class RefreshUserTokenRequest extends AbstractRequest
{
    protected $tokenType = AccessTokenType::USER;
    protected $requestType = RequestType::GENERATE_TOKEN;
    protected $grantType = GrantType::REFRESH_TOKEN;
    protected $requestMethod = 'post';
    protected $refreshToken;
    protected $scope;


    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
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

    public function getRequestBody()
    {
        return [
            'grant_type' => $this->getGrantType(),
            'refresh_token' => $this->getRefreshToken(),
            'scope' => $this->getScope()
        ];
    }
}