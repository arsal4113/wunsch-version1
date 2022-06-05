<?php

namespace Feeder\View\Cell;

use Cake\View\Cell;

/**
 * Class ProductMarkupCell
 * @package Feeder\View\Cell
 */
class ProductMarkupCell extends Cell
{
    /**
     * @param $ebayItem
     */
    public function display($ebayItem)
    {
        $productMarkup = [];
        if (isset($ebayItem['items'][0])) {
            if (strtoupper($ebayItem['type']) === 'SIMPLE') {
                $productMarkup = $this->getItemMarkup($ebayItem['items'][0], $ebayItem);
            } elseif (strtoupper($ebayItem['type']) === 'CONFIGURABLE') {
                foreach ($ebayItem['items'] as $item) {
                    $productMarkup[] = $this->getItemMarkup($item, $ebayItem);
                }
            }
        }
        $this->set('productMarkup', $productMarkup);
    }

    /**
     * @param $item
     * @param $offer
     * @return array
     */
    protected function getItemMarkup($item, $offer)
    {
        $markup = [
            '@context' => 'http://schema.org/',
            '@type' => 'Product',
            'sku' => $item['id'],
            'productID' => $item['id'],
            'name' => $offer['title'],
            'description' => $item['short_description'],
            'image' => $item['images'][0] ?? '',
            'offers' => [
                '@type' => 'Offer',
                'url' => 'https://catch.app/itm/' . $item['id'],
                'priceCurrency' => $item['price']['currency'],
                'price' => $item['price']['amount'],
                'itemCondition' => 'http://schema.org/NewCondition',
                'availability' => $item['quantity'] > 0 ? 'http://schema.org/InStock' : 'http://schema.org/OutOfStock'
            ]
        ];
        if (isset($offer['rating']['rating_count']) && $offer['rating']['rating_count'] > 0) {
            $markup['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => $offer['rating']['avg_rating'] ?? '',
                'reviewCount' => $offer['rating']['rating_count'] ?? ''
            ];
        }
        return $markup;
    }
}
