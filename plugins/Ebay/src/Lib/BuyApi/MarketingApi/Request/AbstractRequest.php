<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 26.04.18
 * Time: 17:26
 */

namespace Ebay\Lib\Rest\BuyApi\MarketingApi\Request;

use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Entity\GrantType;

class AbstractRequest
{
    /**
     * @deprecated will be removed in the next version. Use tokenType instead.
     * @var string
     */
    protected $granType = GrantType::CLIENT_CREDENTIALS;
    protected $tokenType = AccessTokenType::APPLICATION;
    protected $requestMethod = 'get';
    protected $scope = 'https://api.ebay.com/oauth/api_scope/buy.marketing';


    public function getTokenType()
    {
        return $this->tokenType;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @deprecated will be removed in the next version. Use tokenType instead.
     * @return mixed
     */
    public function getGrantType()
    {
        return $this->granType;
    }

    public function getRequestBody()
    {
        return false;
    }
}
