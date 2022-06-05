<?php

$items_number = 0;
if (!empty($ebayCheckoutSession->ebay_checkout_session_items)) {
    foreach ($ebayCheckoutSession->ebay_checkout_session_items as $item) {
        $items_number += $item->quantity;
    }
}

$cart_total = $cart_subtotal = $cart_shipping = 0;
if (!empty($ebayCheckoutSession->ebay_checkout_session_totals)) {
    foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) {
        if ($total->code == 'total') { // priceSubtotal, tax..
            $cart_total = $total->value;
        } else if ($total->code == 'priceSubtotal') {
            $cart_subtotal = $total->value;
        } else if ($total->code == 'deliveryCost') {
            $cart_shipping = $total->value;
        }
    }
}

?>

<div class="row totals priceSubtotal-totals">
    <div class="col-8 total-name"><?= __('Items ({0})', $items_number) ?></div>
    <div class="col-4 total-price">€<?= number_format($cart_subtotal, 2) ?></div>
</div>
<div class="row totals deliveryCost-totals">
    <div class="col-8 total-name"><?= __('ShippingCost') ?></div>
    <div class="col-4 total-price">€<?= number_format($cart_shipping, 2) ?></div>
</div>
<div class="row totals total-totals">
    <div class="col-8 total-name"><strong><?= __('Total') ?></strong> <?= __('incl. tax') ?></div>
    <div class="col-4 total-price">€<?= number_format($cart_total, 2) ?></div>
</div>
