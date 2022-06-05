<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-12-03
 * Time: 16:00
 */

namespace Ebay\Lib\IdentityApi\Request;

use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Entity\GrantType;
use Ebay\Lib\IdentityApi\Entity\RequestType;

class GetUserTokenRequest extends AbstractRequest
{
    protected $tokenType = AccessTokenType::USER;
    protected $requestType = RequestType::GENERATE_TOKEN;
    protected $grantType = GrantType::AUTHORIZATION_CODE;
    protected $requestMethod = 'post';


    /**
     * The RuName value for the environment you're targeting.
     * @var
     */
    protected $redirectUri;
    protected $authorizationCode;


    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
        return $this;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
        return $this;
    }

    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }


    public function getRequestBody()
    {
        return [
            'grant_type' => $this->getGrantType(),
            'code' => $this->getAuthorizationCode(),
            'redirect_uri' => $this->getRedirectUri()
        ];
    }
}