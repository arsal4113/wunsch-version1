<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-12-03
 * Time: 16:48
 */

namespace Ebay\Lib\IdentityApi\Request;


use Cake\Utility\Security;
use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Entity\GrantType;
use Ebay\Lib\IdentityApi\Entity\RequestType;

class AuthorizeUserTokenRequest extends AbstractRequest
{
    protected $tokenType = AccessTokenType::USER;
    protected $requestType = RequestType::AUTHORIZE;
    protected $grantType = GrantType::AUTHORIZATION_CODE;
    protected $requestMethod = 'get';
    protected $scope;
    protected $minStateLength = 32;

    /**
     * The client_id value for the environment you're targeting.
     * @var
     */
    protected $appId;
    /**
     * The RuName value for the environment you're targeting.
     * @var
     */
    protected $redirectUri;

    /**
     * An opaque value used by the client to maintain state between the request and callback.
     * CSRF protection token as described in https://tools.ietf.org/html/rfc6749#section-10.12
     * @var string
     */
    protected $state;

    /**
     * Set to "code" to have eBay generate and return an authorization code.
     * @var string
     */
    protected $responseType = 'code';

    /**
     * Set this optional query parameter to login to force the user to log in each time the consent request is made, even if a user session already exists for the associated user.
     * @var string
     */
    protected $prompt = 'login';


    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
        return $this;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    public function setResponseType($responseType)
    {
        $this->responseType = $responseType;
        return $this;
    }

    public function getResponseType()
    {
        return $this->responseType;
    }

    public function setState($state)
    {
        if (strlen($state) < $this->minStateLength) {
            throw new \Exception('state length is to short. Min characters count is ' . $this->minStateLength . ', provided characters count is ' . strlen($state));
        }
        $this->state = $state;
        return $this;
    }

    public function getState()
    {
        if (empty($this->state)) {
            $this->state = $this->generateState();
        }
        return $this->state;
    }

    protected function generateState()
    {
        return bin2hex(Security::randomBytes($this->minStateLength));
    }

    public function getPrompt()
    {
        return $this->prompt;
    }

    public function getRequestBody()
    {
        $query = [
            'client_id' => $this->getAppId(),
            'redirect_uri' => $this->getRedirectUri(),
            'response_type' => $this->getResponseType(),
            'scope' => $this->getScope(),
            'state' => $this->getState(),
            'prompt' => $this->getPrompt()
        ];

        $query = array_filter($query, function ($value) {
            return !empty($value);
        });
        return http_build_query($query);
    }
}