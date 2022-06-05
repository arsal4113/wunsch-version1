<?php

namespace VisitManager\Model\Behavior;

use Cake\ORM\Behavior;

/**
 * Class ProductUrlBehavior
 * @package VisitManager\Model\Behavior
 */
class ProductUrlBehavior extends Behavior
{
    private $marketplaceProduct;
    private $marketplaceName;
    private $searchTerm;
    private $productPosition;
    private $marketplaceCategory;
    private $reloadCounter;
    const TRACK_PARAMETER_NAME = 'trkdata';

    /**
     * @return mixed
     */
    public function getMarketplaceProduct()
    {
        return $this->marketplaceProduct;
    }

    /**
     * @param mixed $marketplaceProduct
     */
    protected function setMarketplaceProduct($marketplaceProduct)
    {
        $this->marketplaceProduct = $marketplaceProduct;
    }

    /**
     * @return mixed
     */
    public function getMarketplaceName()
    {
        return $this->marketplaceName;
    }

    /**
     * @param mixed $marketplaceName
     */
    protected function setMarketplaceName($marketplaceName)
    {
        $this->marketplaceName = $marketplaceName;
    }

    /**
     * @return mixed
     */
    public function getSearchTerm()
    {
        return $this->searchTerm;
    }

    /**
     * @param mixed $searchTerm
     */
    protected function setSearchTerm($searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }

    /**
     * @return mixed
     */
    public function getProductPosition()
    {
        return $this->productPosition;
    }

    /**
     * @param mixed $productPosition
     */
    protected function setProductPosition($productPosition)
    {
        $this->productPosition = $productPosition;
    }

    /**
     * @return mixed
     */
    public function getMarketplaceCategory()
    {
        return $this->marketplaceCategory;
    }

    /**
     * @param mixed $marketplaceCategory
     */
    protected function setMarketplaceCategory($marketplaceCategory)
    {
        $this->marketplaceCategory = $marketplaceCategory;
    }

    /**
     * @return mixed
     */
    public function getReloadCounter()
    {
        return $this->reloadCounter;
    }

    /**
     * @param mixed $reloadCounter
     */
    protected function setReloadCounter($reloadCounter)
    {
        $this->reloadCounter = $reloadCounter;
    }

    /**
     * @param $urlQuery
     * @return bool|string
     */
    private function decodeUrl($urlQuery)
    {
        return base64_decode(urldecode($urlQuery));
    }

    /**
     * @param $urlQuery
     * @return string
     */
    private function encodeUrl($urlQuery)
    {
        if (is_array($urlQuery)) {
            $urlQuery = $this->buildQueryString($urlQuery);
        }
        return urlencode(base64_encode($urlQuery));
    }

    /**
     * @param $urlQuery
     * @return string
     */
    private function buildQueryString($urlQuery)
    {
        return http_build_query($urlQuery);
    }

    /**
     * @param $searchTerm
     * @param $marketplaceProduct
     * @param $productPosition
     * @param $marketPlaceName
     * @param $marketPlaceCategory
     */
    private function setData($searchTerm, $marketplaceProduct, $productPosition, $marketPlaceName, $marketPlaceCategory)
    {
        $this->setSearchTerm($searchTerm);
        $this->setMarketplaceProduct($marketplaceProduct);
        $this->setProductPosition($productPosition);
        $this->setMarketplaceName($marketPlaceName);
        $this->setMarketplaceCategory($marketPlaceCategory);
    }

    /**
     * @param $searchTerm
     * @param $marketplaceProduct
     * @param $productPosition
     * @param $marketPlaceName
     * @param $marketPlaceCategory
     * @return array
     */
    private function getQueryString($searchTerm, $marketplaceProduct, $productPosition, $marketPlaceName, $marketPlaceCategory)
    {
        $queryString = [];
        $this->setData($searchTerm, $marketplaceProduct, $productPosition, $marketPlaceName, $marketPlaceCategory);
        foreach ($this as $key => $value) {
            if (!(substr($key, 0, 1) == '_')) {
                $queryString[$key] = $value;
            }
        }
        return $queryString;
    }

    /**
     * @param $searchTerm
     * @param $marketplaceProduct
     * @param null $productPosition
     * @param string $marketPlaceName
     * @param int $marketPlaceCategory
     * @return string
     */
    public function generateUrlQueryFromParameters($searchTerm, $marketplaceProduct, $productPosition = null, $marketPlaceName = '', $marketPlaceCategory = 0)
    {
        $queryString = $this->getQueryString($searchTerm, $marketplaceProduct, $productPosition, $marketPlaceName, $marketPlaceCategory);
        $encodedUrl = $this->encodeUrl($queryString);
        $encodedQueryString = new \stdClass();
        $encodedQueryString->{self::TRACK_PARAMETER_NAME} = $encodedUrl;
        return $this->buildQueryString($encodedQueryString);
    }

    /**
     * @param $urlParameter
     * @return mixed
     */
    public function generateParametersFromQuery($urlParameter)
    {
        $decodedUrl = $this->decodeUrl($urlParameter);
        parse_str(urldecode($decodedUrl), $decodedData);
        return $decodedData;
    }
}
