<?php

namespace Feeder\View\Helper;

use Cake\Cache\Cache;
use Cake\View\Helper;
use Feeder\Controller\ProductsController;

class FeederHelper extends Helper
{
    public function averageCustomerReviews($rating)
    {
        $roundCustomerReviews = round($rating * 2) / 2;
        switch ($roundCustomerReviews) {
            case 4.5:
                return "star-4-5";
                break;
            case 5:
                return "star-5";
                break;
        }
    }

    public function htmlAttributeSafe($text)
    {
        return str_replace("'", '', str_replace('"', '', strip_tags($text)));
    }

    public function parseColor($color)
    {
        $color = trim($color, '#');
        $colorLength = strlen($color);
        if ($colorLength == 3 || $colorLength == 6) {
            $color = '#' . $color;
        }
        return $color;
    }

    public function color2rgba($color, $opacity)
    {

        $opacity = $opacity / 100;
        $output = null;

        // standard 147 HTML color names
        $colorsName = array(
            'aliceblue' => 'F0F8FF',
            'antiquewhite' => 'FAEBD7',
            'aqua' => '00FFFF',
            'aquamarine' => '7FFFD4',
            'azure' => 'F0FFFF',
            'beige' => 'F5F5DC',
            'bisque' => 'FFE4C4',
            'black' => '000000',
            'blanchedalmond ' => 'FFEBCD',
            'blue' => '0000FF',
            'blueviolet' => '8A2BE2',
            'brown' => 'A52A2A',
            'burlywood' => 'DEB887',
            'cadetblue' => '5F9EA0',
            'chartreuse' => '7FFF00',
            'chocolate' => 'D2691E',
            'coral' => 'FF7F50',
            'cornflowerblue' => '6495ED',
            'cornsilk' => 'FFF8DC',
            'crimson' => 'DC143C',
            'cyan' => '00FFFF',
            'darkblue' => '00008B',
            'darkcyan' => '008B8B',
            'darkgoldenrod' => 'B8860B',
            'darkgray' => 'A9A9A9',
            'darkgreen' => '006400',
            'darkgrey' => 'A9A9A9',
            'darkkhaki' => 'BDB76B',
            'darkmagenta' => '8B008B',
            'darkolivegreen' => '556B2F',
            'darkorange' => 'FF8C00',
            'darkorchid' => '9932CC',
            'darkred' => '8B0000',
            'darksalmon' => 'E9967A',
            'darkseagreen' => '8FBC8F',
            'darkslateblue' => '483D8B',
            'darkslategray' => '2F4F4F',
            'darkslategrey' => '2F4F4F',
            'darkturquoise' => '00CED1',
            'darkviolet' => '9400D3',
            'deeppink' => 'FF1493',
            'deepskyblue' => '00BFFF',
            'dimgray' => '696969',
            'dimgrey' => '696969',
            'dodgerblue' => '1E90FF',
            'firebrick' => 'B22222',
            'floralwhite' => 'FFFAF0',
            'forestgreen' => '228B22',
            'fuchsia' => 'FF00FF',
            'gainsboro' => 'DCDCDC',
            'ghostwhite' => 'F8F8FF',
            'gold' => 'FFD700',
            'goldenrod' => 'DAA520',
            'gray' => '808080',
            'green' => '008000',
            'greenyellow' => 'ADFF2F',
            'grey' => '808080',
            'honeydew' => 'F0FFF0',
            'hotpink' => 'FF69B4',
            'indianred' => 'CD5C5C',
            'indigo' => '4B0082',
            'ivory' => 'FFFFF0',
            'khaki' => 'F0E68C',
            'lavender' => 'E6E6FA',
            'lavenderblush' => 'FFF0F5',
            'lawngreen' => '7CFC00',
            'lemonchiffon' => 'FFFACD',
            'lightblue' => 'ADD8E6',
            'lightcoral' => 'F08080',
            'lightcyan' => 'E0FFFF',
            'lightgoldenrodyellow' => 'FAFAD2',
            'lightgray' => 'D3D3D3',
            'lightgreen' => '90EE90',
            'lightgrey' => 'D3D3D3',
            'lightpink' => 'FFB6C1',
            'lightsalmon' => 'FFA07A',
            'lightseagreen' => '20B2AA',
            'lightskyblue' => '87CEFA',
            'lightslategray' => '778899',
            'lightslategrey' => '778899',
            'lightsteelblue' => 'B0C4DE',
            'lightyellow' => 'FFFFE0',
            'lime' => '00FF00',
            'limegreen' => '32CD32',
            'linen' => 'FAF0E6',
            'magenta' => 'FF00FF',
            'maroon' => '800000',
            'mediumaquamarine' => '66CDAA',
            'mediumblue' => '0000CD',
            'mediumorchid' => 'BA55D3',
            'mediumpurple' => '9370D0',
            'mediumseagreen' => '3CB371',
            'mediumslateblue' => '7B68EE',
            'mediumspringgreen' => '00FA9A',
            'mediumturquoise' => '48D1CC',
            'mediumvioletred' => 'C71585',
            'midnightblue' => '191970',
            'mintcream' => 'F5FFFA',
            'mistyrose' => 'FFE4E1',
            'moccasin' => 'FFE4B5',
            'navajowhite' => 'FFDEAD',
            'navy' => '000080',
            'oldlace' => 'FDF5E6',
            'olive' => '808000',
            'olivedrab' => '6B8E23',
            'orange' => 'FFA500',
            'orangered' => 'FF4500',
            'orchid' => 'DA70D6',
            'palegoldenrod' => 'EEE8AA',
            'palegreen' => '98FB98',
            'paleturquoise' => 'AFEEEE',
            'palevioletred' => 'DB7093',
            'papayawhip' => 'FFEFD5',
            'peachpuff' => 'FFDAB9',
            'peru' => 'CD853F',
            'pink' => 'FFC0CB',
            'plum' => 'DDA0DD',
            'powderblue' => 'B0E0E6',
            'purple' => '800080',
            'red' => 'FF0000',
            'rosybrown' => 'BC8F8F',
            'royalblue' => '4169E1',
            'saddlebrown' => '8B4513',
            'salmon' => 'FA8072',
            'sandybrown' => 'F4A460',
            'seagreen' => '2E8B57',
            'seashell' => 'FFF5EE',
            'sienna' => 'A0522D',
            'silver' => 'C0C0C0',
            'skyblue' => '87CEEB',
            'slateblue' => '6A5ACD',
            'slategray' => '708090',
            'slategrey' => '708090',
            'snow' => 'FFFAFA',
            'springgreen' => '00FF7F',
            'steelblue' => '4682B4',
            'tan' => 'D2B48C',
            'teal' => '008080',
            'thistle' => 'D8BFD8',
            'tomato' => 'FF6347',
            'turquoise' => '40E0D0',
            'violet' => 'EE82EE',
            'wheat' => 'F5DEB3',
            'white' => 'FFFFFF',
            'whitesmoke' => 'F5F5F5',
            'yellow' => 'FFFF00',
            'yellowgreen' => '9ACD32'
        );

        if (isset($colorsName[$color])) {
            $color = '#' . $colorsName[$color];
        }

        if ($color[0] == '#') {
            $color = substr($color, 1);

            if (strlen($color) == 6) {
                $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
            } elseif (strlen($color) == 3) {
                $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
            } else {
                return $color;
            }
            //Convert hexadec to rgb
            $rgb = array_map('hexdec', $hex);
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';

        } elseif (preg_match("(rgb|(...))", $color)) {
            preg_match('#\((.*?)\)#', $color, $match);
            $rgbstr = str_replace(array(','), ':', $match[1]);
            $rgbarr = explode(":", $rgbstr);
            $output = 'rgba(' . $rgbarr[0] . ',' . $rgbarr[1] . ',' . $rgbarr[2] . ',' . $opacity . ')';
        } else {
            return false;
        }
        //Return rgba color string
        return $output;
    }

    public function filterProductData($data, $list = 'Product')
    {
        $output = null;

        if (is_array($data)) {

            $output = [];

            for ($i = 0; $i < count($data); $i++) {
                if ($item = $this->filterProductData($data[$i])) {
                    $item->list = $list;
                    $item->position = $i + 1;
                    $output[$i] = $item;
                }
            }

        } else {
            if (is_object($data)) {

                $output = new \stdClass; // position property will be set by cycle, see upper for details..

                $meta = (isset($data->items) && is_array($data->items) && isset($data->items[0])
                    ? $data->items[0]
                    : null);

                $title = isset($data->title) ? $data->title : null;
                $itemId = (isset($data->item_id)
                    ? $data->item_id
                    : (isset($data->parent_id)
                        ? $data->parent_id
                        : (isset($data->ebay_item_id) // in checkout session fall, in order to retrieve information from session storage on frontend
                            ? $data->ebay_item_id
                            : null)));

                $brand = isset($data->brand) ? $data->brand : null;
                if (!$brand && $meta && isset($meta['attributes'])) {
                    for ($i = 0; $i < count($meta['attributes']); $i++) {
                        if ($meta['attributes'][$i]['name'] == 'Marke') {
                            $brand = $meta['attributes'][$i]['value'];
                        }
                    }
                }
                $location = (isset($data->item_location_country)
                    ? $data->item_location_country
                    : ($meta && isset($meta['location']['country'])
                        ? $meta['location']['country']
                        : null));
                $currencyCode = ($meta && isset($meta['price']['currency'])
                    ? $meta['price']['currency']
                    : (isset($data->currency)
                        ? $data->currency
                        : null));
                $price = (isset($data->base_price)
                    ? $data->base_price
                    : (isset($data->price)
                        ? $data->price
                        : null));
                $quantity = ($meta && isset($meta['quantity'])
                    ? $meta['quantity']
                    : (isset($data->quantity)
                        ? $data->quantity
                        : null));
                $quantityLabel = ($quantity < 3
                    ? __("Almost sold out")
                    : (isset($data->availability)
                        ? $data->availability
                        : null));
                $sellerUsername = ($meta && isset($meta['seller']['username'])
                    ? $meta['seller']['username']
                    : (isset($data->seller_username)
                        ? $data->seller_username
                        : null));
                $avgRating = (isset($data->rating['avg_rating'])
                    ? $data->rating['avg_rating']
                    : (isset($data->rating)
                        ? $data->rating
                        : null));
                
                $freeReturns = ((isset($data->return_shipping_cost_payer)
                					&& ($data->return_shipping_cost_payer == 'SELLER'))
                			 ? 'Y'
                			 : ((isset($meta['return_terms']['return_shipping_cost_payer'])
                					&& ($meta['return_terms']['return_shipping_cost_payer'] == 'SELLER'))
                			   ? 'Y'
                			   : 'N')); // product badge 'Kostenlose Retoure', 'Y' or 'N'

                $returnPeriods = [
                    'YEAR' => 365,
                    'MONTH' => 30,
                    'DAY' => 1,
                    'CALENDAR_DAY' => 1,
                    'BUSINESS_DAY' => 1
                ];
                $returnDays = null;

                $itemReturnPeriod = $data->return_period ?? null;
                $itemReturnPeriodUnit = $data->return_period_unit ?? null;

                if (!is_numeric($itemReturnPeriod) || !isset($returnPeriods[$itemReturnPeriodUnit])) {
                    $itemReturnPeriod = $meta['return_terms']['return_period']['value'] ?? null;
                    $itemReturnPeriodUnit = $meta['return_terms']['return_period']['unit'] ?? null;
                }

                if (is_numeric($itemReturnPeriod) && isset($returnPeriods[$itemReturnPeriodUnit])) {
                    $returnDays = $itemReturnPeriod * $returnPeriods[$itemReturnPeriodUnit];
                }

                $minDaysDelivery = $maxDaysDelivery = $minShippingCosts = null;

                $shippingOptions = ($meta && isset($meta['shipping_options'])
                    ? $meta['shipping_options']
                    : null);
                $deliveryOptions = isset($data->delivery_options) ? $data->delivery_options : null;

                if ($shippingOptions) {
                    $now = new \DateTime();
                    $services = [];
                    foreach ($shippingOptions as $option) {
                        if (!$minShippingCosts || $minShippingCosts > $option['shipping_cost']['amount']) {
                            $minShippingCosts = $option['shipping_cost']['amount'];
                        }
                        if (isset($option['max_delivery_date'], $option['min_delivery_date'])) {

                            $max = new \DateTime($option['max_delivery_date']);
                            $min = new \DateTime($option['min_delivery_date']);
                            $maxDiff = $now->diff($max)->d;
                            $minDiff = $now->diff($min)->d;
                            if (!$maxDaysDelivery || $maxDaysDelivery < $maxDiff) {
                                $maxDaysDelivery = $maxDiff;
                            }
                            if (!$minDaysDelivery || $minDaysDelivery > $minDiff) {
                                $minDaysDelivery = $minDiff;
                            }
                        }
                        $services[] = $option['shipping_service'];
                    }
                    if (!$deliveryOptions) {
                        $deliveryOptions = implode($services, '|');
                    }
                    // assuming all shipping options are available for DE:
                    if (!isset($data->delivery_cost_de)) {
                        $data->delivery_cost_de = $minShippingCosts;
                    }
                    if (!isset($data->delivery_duration_de)) {
                        $data->delivery_duration_de = $maxDaysDelivery + 1;
                    }
                }

                $variants = [];
                if (isset($data->aspects)) {
                    for ($i = 0; $i < count($data->aspects); $i++) {
                        $variants[] = $data->aspects[$i]->value;
                        if (!$brand && $data->aspects[$i]->name == 'Marke') { // 8-S
                            $brand = $data->aspects[$i]->value;
                        }
                    }
                } else {
                    if (isset($data->configurable_attributes)) {
                        foreach ($data->configurable_attributes as $key => $value) {
                            for ($i = 0; $i < count($data->configurable_attributes[$key]); $i++) {
                                $variants[] = $data->configurable_attributes[$key][$i];
                            }
                        }
                    }
                }
                $variants = implode('|', $variants);

                $output->auctTitl = $title; // the item title (shows up in Search and at the top of ViewItem).
                if (in_array($brand, ['Markenlos', 'ohne Marke', 'Brandless'])) { // preprocessing..
                    $brand = null;
                } // as of WD-974
                $output->brand = $brand; // 'murago' (shop name) ... maybe seller?
                $output->category = isset($data->category_id) ? (int)$data->category_id : null; // Contains the (primary, only a single id) leaf category ID that the seller chose for the listing
                $output->currency_code = $currencyCode; // ISO-3 format (USD, GBP, EUR..) fallback is EUR
                preg_match('/(?<=\|)(.*?)(?=\|)/', $itemId, $matches); // preprocessing..
                $output->id = (isset($matches[0])
                    ? $matches[0]
                    : $itemId);
                // old version: $itemId; // the item ID of the listing that was purchased from, Unique SKU identifier
                $output->dimension4 = $quantityLabel; // product label, e.g. 'Fast ausverkauft'
                $output->dimension5 = (isset($data->delivery_cost_de)
                    ? ((float)$data->delivery_cost_de
                        ? 'N'
                        : 'Y')
                    : null); // product badge 'Versandkostenfrei', 'Y' or 'N'
                $output->dimension6 = $avgRating >= 4 ? 'Y' : 'N'; // product badge 'Gut Bewertet', 'Y' or 'N'
                $output->dimension7 = ((isset($data->delivery_duration_de)
                		&& $data->delivery_duration_de <= 3)
                        ? 'Y'
                        : 'N'); // product badge 'Schnelle Lieferung', 'Y' or 'N'
                $output->dimension8 = $quantity < 3 ? 'Y' : 'N'; // product badge 'Fast weg', 'Y' or 'N'
                $output->dimension9 = $freeReturns;
                $output->dimension10 = (is_numeric($returnDays) && $returnDays >= 30) ? 'Y' : 'N'; // ebay warranty, 'Y' or 'N'
                $output->dimension11 = $minDaysDelivery; // days to the first day of expected delivery
                $output->dimension12 = $returnDays; // return period in days
                $output->dimension13 = $deliveryOptions; // delivery option, in case there are more options, pass all separated by pipe "|"
                $output->dimension14 = $location; // product location
                $output->dimension15 = 'new'; // hardcoded (actually, other than new products are trought the API not allowed..) // 'new', // product condition 'new' vs 'used'
                $output->dimension16 = $sellerUsername; // oracle id of the seller
                $output->dimension17 = $itemId; // the item ID of the listing that was purchased from, Unique SKU identifier
                $output->itemVrtnId = $itemId; // the item ID of the listing that was purchased from, Unique SKU identifier
                $output->list = $list; // ATM hardcoded, alternatives are 'Search Results', 'Category', 'Topsellers', 'Recommendations'
                $output->metric1 = $minDaysDelivery; // days to the first day of expected delivery
                $output->metric2 = $maxDaysDelivery; // days to the last day of expected delivery
                $output->metric3 = $returnDays; // return period in days
                $output->metric4 = $avgRating; // shop rating without %, ATM not always available..
                $output->metric5 = (float)$minShippingCosts; // shipping cost
                $output->name = $title; // the name of the product
                $output->price = (float)$price; // the price of the products, float
                $output->quantity = $quantity; // could change at runtime, depending on cart (checkout session status) in webstorage..
                $output->slrId = $sellerUsername; // numeric (???) oracle id of the seller
                $output->variant = $variants; // if the product has a variant (otherwise send undefined or exclude), if the variant consist of multiple attributes, pass all separated by pipe "|"
            }
        }
//var_dump('item#' . $output->id, $output);        
        return $output;
    }

    public function prepareDescription($itemId, $description)
    {
        $cacheKey = ProductsController::CACHE_PRODUCT_KEY . str_replace('|', '_', $itemId).'_description';
        return Cache::remember($cacheKey, function () use ($description) {
            $dom = $this->getDOM($description);
            $dom = $this->filterJsOut($dom);
            $dom = $this->filterLinks($dom);
            $dom = $this->filterImages($dom);
            $dom = $this->filterCss($dom);
            return $dom->saveHTML();
        });
    }

    public function filterJsOut($html)
    {
        $dom = $this->getDOM($html);

        $scripts = $dom->getElementsByTagName('script');

        for ($i = 0; $i < $scripts->length; $i++) {
            $item = $scripts->item($i);
            $item->parentNode->removeChild($item);
        }
        if (is_string($html)) {
            return $dom->saveHTML();
        }
        return $dom;
    }

    public function filterLinks($html)
    {
        $dom = $this->getDOM($html);

        $links = $dom->getElementsByTagName('a');

        for ($i = 0; $i < $links->length; $i++) {
            $link = $links->item($i);
            $href = strip_tags(trim(str_replace(["\r", "\n"], '', $link->getAttribute('href'))));
            if (!(is_string($href) && (strpos($href, 'http') === 0) || strpos($href, '//') === 0)) {
                $href = '';
            }
            $link->setAttribute('href', $href);
        }
        if (is_string($html)) {
            return $dom->saveHTML();
        }
        return $dom;
    }

    public function filterImages($html)
    {
        $dom = $this->getDOM($html);

        $images = $dom->getElementsByTagName('img');

        for ($i = 0; $i < $images->length; $i++) {
            $image = $images->item($i);
            $src = $image->getAttribute('src');
            if (!(is_string($src) && (strpos($src, 'http') === 0) || strpos($src, '//') === 0)) {
                $image->parentNode->removeChild($image);
            }

        }
        if (is_string($html)) {
            return $dom->saveHTML();
        }
        return $dom;
    }

    public function filterCss($html)
    {
        $dom = $this->getDOM($html);

        $links = $dom->getElementsByTagName('link');

        for ($i = 0; $i < $links->length; $i++) {
            $link = $links->item($i);
            if ($link->getAttribute('rel') == 'stylesheet') {
                $href = $link->getAttribute('href');
                if (!(is_string($href) && (strpos($href, 'http') === 0) || strpos($href, '//') === 0)) {
                    $link->setAttribute('href', '');
                }
            }
        }
        if (is_string($html)) {
            return $dom->saveHTML();
        }
        return $dom;
    }

    protected function getDOM($html)
    {
        if (is_string($html)) {
            $dom = new \DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        } else {
            $dom = $html;
        }
        return $dom;
    }

}
