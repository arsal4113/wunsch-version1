<?php

namespace Ebay\Lib\BuyApi\OrderApi\Request;

use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Entity\GrantType;

class AbstractRequest
{

    /**
     * @deprecated will be removed in the next version. Use tokenType instead.
     * @var string
     */
    protected $granType = GrantType::CLIENT_CREDENTIALS;
    protected $requestMethod = 'get';
    protected $tokenType = AccessTokenType::APPLICATION;
    protected $scope = 'https://api.ebay.com/oauth/api_scope/buy.guest.order';

    /**
     * @deprecated will be removed in the next version. Use tokenType instead.
     * @return mixed
     */
    public function getGrantType()
    {
        return $this->granType;
    }

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

    public function getRequestBody()
    {
        return false;
    }

    public function toArray()
    {
        $tmp = [];
        foreach ((array)$this as $property => $value) {
            $property = trim(str_replace(get_class($this), '', $property));
            if (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }
            $tmp[$property] = $value;
        }

        return $tmp;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}