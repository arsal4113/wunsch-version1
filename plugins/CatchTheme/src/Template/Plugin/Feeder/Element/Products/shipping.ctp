<?php

$currency_mappings = [
    'USD' => [
        'symbol' => "$",
        'pattern' => "#,###.00",
    ],
    'GBP' => [
        'symbol' => "£",
        'pattern' => "#.###,00",
    ],
    'EUR' => [
        'symbol' => "€",
        'pattern' => "#.###,00",
    ]
];

?>

<div class="product-shipping">
    <p>
        <strong><?= __('Shipping') ?></strong>
    </p>
    <?php
    if (isset($ebayItem['items'])) {

        foreach ($ebayItem['items'][0]['shipping_options'] as $shipping_option) {
            if ($shipping_option['shipping_service'] == 'eBayPlus') continue;
            if (isset($currency_mappings[$shipping_option['shipping_cost']['currency']])) {
                ?>
                <p>
                    <?= '<span class="shipping-price">' . $shipping_option['shipping_cost']['amount'] . ' ' . $currency_mappings[$shipping_option['shipping_cost']['currency']]['symbol'] . '</span>, ' . $shipping_option['shipping_service'] ?>
                </p>
                <?php
            }
        }

        if (isset($ebayItem['items'][0]['ship_to_locations']['region_excluded'])) {
            echo '<br /><strong>' . __('Shipping is excluded after') . '</strong>: ';
            $regions = [];
            foreach ($ebayItem['items'][0]['ship_to_locations']['region_excluded'] as $key => $values) {
                $regions[] = $values['region_name'];
            }
            echo implode($regions, ', ');
        }
    } 
    else
        echo __("NO DATA");
    ?>
</div>
