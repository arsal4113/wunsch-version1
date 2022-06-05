<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 26.04.18
 * Time: 16:24
 */

namespace Ebay\Lib\Rest\BuyApi\MarketingApi\Request;


class GetMerchandisedProductsRequest extends AbstractRequest
{
    private $requestUrl = '/merchandised_product?';

    const METRIC_BEST_SELLING = 'BEST_SELLING';

    private $metricName = self::METRIC_BEST_SELLING;
    private $categoryId;
    private $limit;
    private $aspectFilter;

    public function setMetricName(string $metricName)
    {
        $this->metricName = $metricName;
        return $this;
    }

    public function getMetricName()
    {
        return $this->metricName;
    }

    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getRequestUrl()
    {
        $query = [
            'category_id' => $this->getCategoryId(),
            'metric_name' => $this->getMetricName(),
            'limit' => $this->getLimit()
        ];

        $query = array_filter($query, function ($value) {
            return !empty($value);
        });

        return $this->requestUrl . http_build_query($query);
    }
}