<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 26.04.18
 * Time: 17:19
 */

namespace Ebay\Lib\Rest\BuyApi\MarketingApi\Request;


class GetAlsoBoughtByProductRequest extends AbstractRequest
{
    private $requestUrl = '/merchandised_product/get_also_bought_products?';
    private $epid;
    private $gtin;
    private $mpn;
    private $brand;

    public function setEpid(String $epid)
    {
        $this->epid = $epid;
        return $this;
    }

    public function getEpid()
    {
        return $this->epid;
    }

    public function setGtin(String $gtin)
    {
        $this->gtin = $gtin;
        return $this;
    }

    public function getGtin()
    {
        return $this->gtin;
    }

    public function setMpn(String $mpn)
    {
        $this->mpn = $mpn;
        return $this;
    }

    public function getMpn()
    {
        return $this->mpn;
    }

    public function setBrand(String $brand)
    {
        $this->brand = $brand;
        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }


    public function getRequestUrl()
    {
        $query = [
            'brand' => $this->getBrand(),
            'mpn' => $this->getMpn(),
            'gtin' => $this->getGtin(),
            'epid' => $this->getEpid()
        ];

        $query = array_filter($query, function ($value) {
            return !empty($value);
        });
        return $this->requestUrl . http_build_query($query);
    }
}