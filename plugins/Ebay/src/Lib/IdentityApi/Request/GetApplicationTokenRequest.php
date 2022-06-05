<?php

namespace Ebay\Lib\IdentityApi\Request;

use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Entity\ApplicationAccessTokenType;
use Ebay\Lib\IdentityApi\Entity\GrantType;
use Ebay\Lib\IdentityApi\Entity\RequestType;

class GetApplicationTokenRequest extends AbstractRequest
{
    protected $tokenType = AccessTokenType::APPLICATION;
    protected $requestType = RequestType::GENERATE_TOKEN;
    protected $grantType = GrantType::CLIENT_CREDENTIALS;
    protected $requestMethod = 'post';
    protected $redirectUri;
    protected $scope;


    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
        return $this;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    public function getRequestBody()
    {
        $params = [
            'grant_type' => $this->getGrantType(),
            'redirect_uri' => $this->getRedirectUri(),
            'scope' => $this->getScope()
        ];

        return http_build_query(array_filter($params, function ($value) {
            return !empty($value);
        }));
    }
}