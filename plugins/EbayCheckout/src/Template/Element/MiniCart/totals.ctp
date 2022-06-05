<?php
/** @var \EbayCheckout\Model\Entity\EbayCheckoutSession $ebayCheckoutSession */
$qty = 0;
foreach($ebayCheckoutSession->ebay_checkout_session_items ?? [] as $item) {
    $qty += $item->quantity;
}
?>
<?php foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) : ?>
    <?php if (($total->value && $total->value !== "0.00")) : ?>
        <div class="row totals <?= $total->code; ?>-totals">
            <div class="col-6 total-name"><?= $total->label ?? $this->EbayCheckout->formatTotalCode($total->code, $qty); ?></div>
            <div class="col-6 total-price"><?= \Cake\I18n\Number::currency($total->value, $total->currency) ?></div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
