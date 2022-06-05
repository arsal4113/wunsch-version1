<div class="row cart-wrapper">
    <div class="col">
        <div class="row">
            <div class="col">
                <p class="shopping-cart-heading"><?= __("Your Shopping Cart") ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col">
                        <div class="widget-wrapper hidden-generic-widget warning">
                            <p>
                                <strong><?= __('Attention') ?></strong><br/><span class="message"></span>
                            </p>
                        </div>
                        <?php
                        if (count($ebayCheckoutSession->ebay_checkout_session_items) >= $maxItems) { // setting..?
                            ?>
                            <div class="widget-wrapper tight-cart-widget warning">
                                <p>
                                    <strong><?= __('It will be tight in the shopping cart!') ?></strong>
                                    <br/>
                                    <?= __('You can put a maximum of {0} different items in the cart.', $maxItems) ?>
                                </p>
                            </div>
                            <?php
                        }
                        ?>
                        <?php if ($maxItemQuantityError = $this->Flash->render('max_item_quantity')) : ?>
                            <div class="widget-wrapper tight-cart-widget warning">
                                <p>
                                    <strong><?= __('It will be tight in the shopping cart!') ?></strong>
                                    <br/>
                                    <?= __('Max item quantity of {0} reached on one of your items.', $maxItemQuantity) ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <div class="widget-wrapper item-widget">
                            <?php
                            if ($itemsNumber) {
                                ?>
                                <div class="widget-body">
                                    <?php
                                    foreach ($ebayCheckoutSession->ebay_checkout_session_items ?? [] as $item) {//var_dump('<pre>', $item, '</pre>');
                                        $uniqueId = md5($item->id . $item->title);
                                        $delete_url = \Cake\Routing\Router::url(['controller' => 'EbayCheckoutSessions',
                                            'action' => 'deleteItem',
                                            'plugin' => 'EbayCheckout',
                                            'uuid' => $ebayCheckoutSession->core_seller->uuid,
                                            'itemId' => $item->id,
                                            '?' => ['token' => $ebayCheckoutSession->session_token,
                                                'key' => $ebayCheckoutSession->form_key
                                            ]
                                        ]);
                                        $basePrice = $item->base_price_value/* * $item->quantity*/
                                        ;
                                        $originalPrice = $item->original_price_value;
                                        $selectedShippingMethodId = $item->selected_ebay_checkout_session_item_shipping_id ?: 0;
                                        if (isset($item->ebay_checkout_session_item_shippings[$selectedShippingMethodId])) {
                                            $selectedShippingMethod = $item->ebay_checkout_session_item_shippings[$selectedShippingMethodId];
                                            $shippingCosts = $selectedShippingMethod['base_delivery_cost_value']
                                                + $selectedShippingMethod['additional_unit_cost_value'] * ($item->quantity - 1);
                                        } else {
                                            $shippingCosts = null;
                                        }
                                        ?>
                                        <div class="row item-row">
                                            <div class="col-2">
                                                <div class="product-image-wrapper">
                                                    <div class="product-image-box">
                                                        <img class="product-image" src="<?= $item->image ?>"/>
                                                        <a class="wishlist-status"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="row">
                                                    <div class="col title">
                                                        <span class="text"><?= $item->title ?></span>
                                                        <?php
                                                        if ($originalPrice > $basePrice) {
                                                            ?>
                                                            <span
                                                                    class="right original-price">€<?= number_format($originalPrice,
                                                                    2) ?></span>
                                                            <span class="right base-price">€<?= number_format($basePrice,
                                                                    2) ?></span>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="right">€<?= number_format($basePrice, 2) ?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <strong><?= __('By') ?>:</strong>
                                                        <?= $item->seller_username ?>
                                                    </div>
                                                </div>
                                                <?php
                                                if (!empty($item->attributes)) {
                                                    foreach (unserialize($item->attributes) as $label => $value) {
                                                        ?>
                                                        <div class="row">
                                                            <div class="col">
                                                                <strong><?= __($label) ?>:</strong>
                                                                <?= $value ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                if ($shippingCosts !== null) {
                                                    ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            <strong><?= __('ShippingCost') ?>:</strong>
                                                            <?= $item->ebay_checkout_session_item_shippings[0]['shipping_service_code'] ?>
                                                            -
                                                            <?= $shippingCosts ? '€' . number_format($shippingCosts,
                                                                    2) : __('Free Shipping') ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                if (!empty($item->tags)) {
                                                    foreach (unserialize($item->tags) as $key => $data) {
                                                        ?>
                                                        <div class="row">
                                                            <div class="col">
                                                                <span class="tag <?= $key ?>"><?= $data ?></span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col qty">
                                                        <div class="qty-wrapper">
                                                            <label><?= __('Number') ?>:</label>
                                                            <select name="qty" class="form-control qty"
                                                                    data-item-id="<?= $item->id ?>">
                                                                <?php
                                                                for ($i = 1; $i <= $maxItemQuantity; $i++) {
                                                                    ?>
                                                                    <option
                                                                            value="<?= $i ?>" <?= $i == $item->quantity ? 'selected="selected"' : '' ?>><?= $i; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?= $delete_url ?>" class="delete-item" id="<?= $uniqueId ?>"
                                               data-item-id="<?= $item->id ?>" title="<?= __('Delete') ?>"></a>
                                            <script>
                                                function productDelete_el_<?= $uniqueId ?> () {
                                                    pushEcommerce('removeFromCart', [processProductData(<?= json_encode($this->Feeder->filterProductData($item)) ?>)]);
                                                };
                                            </script>
                                        </div>
                                        <?php
                                    } // end item cycler
                                    ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <?= $this->Html->image('cart-kaputt.png',
                                    ['alt' => __('Your cart is empty'), 'class' => 'empty-cart']) ?>
                                <br/>
                                <p style="margin-block-end:auto">
                                    <strong><?= __('Your cart is empty') ?></strong>
                                    <br/>
                                    <?= __('Get started and fill your cart with the latest trends.') ?>
                                </p>
                                <br/>
                                <?php
                            }
                            if (!empty($deletedItems)) {
                                ?>
                                <div class="widget-body">
                                    <?php
                                    foreach ($deletedItems as $item) {
                                        $uniqueId = md5($item->id . $item->title);
                                        $undelete_url = \Cake\Routing\Router::url(['controller' => 'EbayCheckoutSessions',
                                            'action' => 'undeleteItem',
                                            'plugin' => 'EbayCheckout',
                                            'uuid' => $ebayCheckoutSession->core_seller->uuid,
                                            'itemId' => $item->id,
                                            '?' => ['token' => $ebayCheckoutSession->session_token,
                                                'key' => $ebayCheckoutSession->form_key
                                            ]
                                        ]);
                                        ?>
                                        <div class="row deleted-item">
                                            <div class="col-12">
                                                <a href="<?= $undelete_url ?>" class="undelete-item" id="<?= $uniqueId ?>"
                                                   data-item-id="<?= $item->id ?>"><?= __('Undo') ?></a>
                                                <script>
                                                    function productUndelete_el_<?= $uniqueId ?> () {
                                                        pushEcommerce('readdToCart', [processProductData(<?= json_encode($this->Feeder->filterProductData($item)) ?>)]);
                                                    };
                                                </script>
                                                <strong><?= __('Article has been removed') ?></strong>
                                                <br/>
                                                <span class="text"><?= $item->title ?></span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        if (!$itemsNumber) {
                            ?>
                            <div class="widget-wrapper worlds-widget">
                                <p>
                                    <strong><?= __('Do you need more inspiration?') ?></strong>
                                    <br/><br/>
                                    <a href="/world-of-trends"
                                       class="redesign-button"><?= __('Discover World of Trends') ?></a>
                                </p>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="widget-wrapper reminder-widget">
                                <p><?= __('Items in the basket are not reserved!') ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col sticky-widgets">
                        <div class="widget-wrapper totals-widget">
                            <?php
                            $cart_total = $cart_subtotal = $cart_shipping = 0;
                            if (!empty($ebayCheckoutSession->ebay_checkout_session_totals)) {
                                foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) {
                                    if ($total->code == 'total') { // priceSubtotal, tax..
                                        $cart_total = $total->value;
                                    } else {
                                        if ($total->code == 'priceSubtotal') {
                                            $cart_subtotal = $total->value;
                                        } else {
                                            if ($total->code == 'deliveryCost') {
                                                $cart_shipping = $total->value;
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                            <div>
                                <p <?php if (!$cart_total) echo 'class="disabled"' ?>>
                                    <?php
                                    //if ($cart_subtotal != $cart_total) { // it is better with or without?
                                    ?>
                                    <span class="optional-infos"><?= __('Items ({0})', $itemsNumber) ?><span class="right">€<?= number_format($cart_subtotal, 2) ?></span><br/><?= __('ShippingCost') ?><span class="right">€<?= number_format($cart_shipping, 2) ?></span><br/>
                                    </span>
                                    <?php
                                    //}
                                    ?>
                                    <strong><?= __('Total') ?></strong>
                                    <span class="right"><strong>€<?= number_format($cart_total, 2) ?></strong></span>
                                </p>
                                <a class="to-the-checkout checkout-button"
                                   href="<?= $checkoutUrl ?>"><?= __('Now safe to Checkout') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row bottom-wrapper">
    <div class="col-md-5 col-12 column">
        <div class="payment-widget">
            <p><?= __('Pay conveniently with') ?></p>
            <?= $this->Html->image('de-pp_plus-logo-hoch_ohne_PUI_plain.png',
                ['alt' => __('Pay conveniently with'), 'class' => 'payment-methods']) ?>
        </div>
    </div>
    <div class="col-md-3 col-12 column">
        <div class="guarantee-wrapper">
            <?= $this->Html->image('ebay-guarantee.png', ['alt' => 'eBay Guarantee']) ?>
            <span class="big"><?= __('eBay-Guarantee') ?></span>
        </div>
    </div>
    <div class="col-md-4 col-12 column">
        <div class="buyer-protection-wrapper">
            <div class="image-wrapper">
                <?= $this->Html->image('sprEBPnew.png', ['alt' => 'Buyers Protection']) ?>
            </div>
            <span><?= __('When paying with PayPal, direct debit or credit card.') ?></span>
        </div>
    </div>
</div>
