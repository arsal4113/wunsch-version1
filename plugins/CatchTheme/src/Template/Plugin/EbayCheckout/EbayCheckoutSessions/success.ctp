<?php
 /** @var \EbayCheckout\Model\Entity\EbayCheckoutSession $ebayCheckoutSession */

$this->assign('title', 'Thank you for your purchase');

$qty = 0;
foreach ($ebayCheckoutSession->ebay_checkout_session_items ?? [] as $item) {
    $qty += $item->quantity;
}

$formAction = $this->Url->build([
    'controller' => 'EbayCheckoutSessions',
    'action' => 'addItems',
    'plugin' => 'EbayCheckout',
    'uuid' => $coreSeller->uuid
]);
?>

<script>
    pandata.pageType = 'purchase';
</script>

<div id="success"></div>
<script type="text/javascript">
    window.showNewsletter = '<?= $showNewsletter ?>';
    window.cancelledItems = <?= json_encode($cancelledItems) ?>;
    window.shippingAddress = <?= json_encode($ebayCheckoutSession->ebay_checkout_session_shipping_address) ?>;
    window.checkoutItems = <?= json_encode($ebayCheckoutSession->ebay_checkout_session_items) ?>;
    window.checkoutTotals = <?= json_encode($ebayCheckoutSession->ebay_checkout_session_totals) ?>;
    window.userEmail = '<?= $ebayCheckoutSession->email ?>';
    window.newsletterUrl = '<?= \Cake\Routing\Router::url([
        'controller' => 'Newsletter',
        'action' => 'subscribe',
        'plugin' => 'ItoolCustomer'
    ]) ?>';
    window.cartUrl = '<?= \Cake\Routing\Router::url(
        [
            'controller' => 'EbayCheckoutSessions',
            'action' => 'cart',
            'plugin' => 'EbayCheckout',
            'uuid' => $ebayCheckoutSession->core_seller->uuid
        ]
    );?>';
</script>
<?php
echo $this->React->script('vendor.js');
echo $this->React->script('success.js');
?>

<div class="success-page container-fluid">
    <div class="row">
        <div class="col-12 catch-zenloop-container">
            <script
                id="zl-website-overlay-loader"
                async
                src="https://zenloop-website-overlay-production.s3.amazonaws.com/loader/zenloop.load.min.js?survey=ZnBmaUNYMWc3WXY2ZnJ1c3YwUFA1L2o2eWExM09xN3RNTE9EYm90ZFhsaz0%3D"
            ></script>
        </div>
    </div>
</div>

<img src="<?= $ebayTrackingPixelSrc ?>">

<script>
    (function ($) {
        $(function () {
            $('body').addClass('success-page-body');

            $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'fancyFade'});

            var transaction_tracking_identifier = "tid_<?= $ebayCheckoutSession->purchase_order_id ?: $session_token ?>",
                document_cookies = document.cookie.split("; "),
                transaction_tracked = false;

            for (var i = 0; i < document_cookies.length; i++) {
                var cookie = document_cookies[i].split("=");
                if (cookie[0] == transaction_tracking_identifier) {
                    transaction_tracked = true;
                }
            }

            if (localStorage.getItem(transaction_tracking_identifier)
                || sessionStorage.getItem(transaction_tracking_identifier)) {
                transaction_tracked = true;
            }

            if (!transaction_tracked) { // doing our tracking if not already done

                <?php
                $total = 0;
                $shipping = 0;
                $itemIds = [];
                foreach ($items as $item) {
                    $itemIds[] = "'" . $item->ebay_item_id . "'";
                    $total += $item->base_price_value * $item->quantity;
                    foreach ($item->ebay_checkout_session_item_shippings as $value) {
                        $shipping += $value->base_delivery_cost_value + $value->additional_unit_cost_value * $item->quantity;
                    }
                }
                ?>

                // i-ways GTM tracking helper
                push2dataLayer({
                    ecomm_prodid: '<?= str_replace("'", '', implode(',', $itemIds)) ?>',
                    ecomm_pagetype: 'Purchase',
                    ecomm_totalvalue: <?= $total ?>,

                    'transactionId': '<?= $ebayCheckoutSession->purchase_order_id ?: $session_token ?>',
                    'transactionTotal': <?= $total ?>,
                    'transactionProducts': [
                            <?php
                            foreach ($items as $item) {
                            ?>{
                            'sku': '<?= $item->ebay_item_id ?>',
                            'name': '<?= isset($item['title']) ? $item['title'] : 'This product is unknown!' ?>',
                            'quantity': <?= $item->quantity ?>,
                            'price': <?= $item->base_price_value ?>
                        },<?php
                        }
                        ?>
                    ],
                    'transactionCoupon': '<?= $ebayCheckoutSession->redemption_code ?>'
                });

                // additional custom conversion for GA
                gtag('event', 'conversion', {
                    'send_to': 'AW-798452524/uSbUCLGVjI8BEKzW3fwC',
                    'value': <?= $total ?>,
                    'currency': 'EUR',
                    'transaction_id': '<?= $ebayCheckoutSession->purchase_order_id ?: $session_token ?>',
                    'coupon': '<?= $ebayCheckoutSession->redemption_code ?>'
                });

                // pandata additional purchase tracking
                pandata.purchaseOrderId = "<?= $ebayCheckoutSession->purchase_order_id ?: $session_token ?>";
                pandata.revenue = "<?= $total ?>";
                pandata.shipping = "<?= $shipping ?>";
                pandata.coupon = "<?= $ebayCheckoutSession->redemption_code ?>";

                <?php
                if (isset($ebayCheckoutSession->ebay_checkout_session_totals)) {
                    foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) {
                        if ($total->code == "tax") {
                            ?>
                            pandata.tax = "<?= $total->value ?>";
                            <?php
                        }
                    }
                }
                ?>
                pushEcommerce('purchase', processProductData(<?= json_encode($this->Feeder->filterProductData($items)) ?>, true));

                // webExtend
                var orderItems = [];
                <?php
                foreach ($items as $item) {
                    ?>
                    orderItems.push({
                        item: '<?= str_replace("|", "%7C", $item->ebay_item_id) ?>',
                        quantity: <?= $item->quantity ?>,
                        price: <?= $item->base_price_value ?>
                    });
                    <?php
                }
                ?>
                ScarabQueue.push(['purchase', {
                    orderId: '<?= $ebayCheckoutSession->purchase_order_id ?: $session_token ?>',
                    items: orderItems
                }]);
                ScarabQueue.push(['go']);

                localStorage.setItem(transaction_tracking_identifier, 'true');
                sessionStorage.setItem(transaction_tracking_identifier, 'true');

                var date = new Date(new Date().setFullYear(new Date().getFullYear() + 1));
                document.cookie = transaction_tracking_identifier + '=tracked; path=/; domain=' + document.location.hostname + '; expires=' + date.toUTCString();
            }
        });
    })(jQuery);
</script>
