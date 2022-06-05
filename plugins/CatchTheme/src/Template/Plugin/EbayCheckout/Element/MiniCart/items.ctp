<?php

foreach ($ebayCheckoutSession->ebay_checkout_session_items ?? [] as $item) {
    $delete_url = \Cake\Routing\Router::url([
        'controller' => 'EbayCheckoutSessions',
        'action' => 'deleteItem',
        'plugin' => 'EbayCheckout',
        'uuid' => $ebayCheckoutSession->core_seller->uuid,
        'itemId' => $item->id,
        '?' => [
            'token' => $ebayCheckoutSession->session_token,
            'key' => $ebayCheckoutSession->form_key
        ]
    ]);
    $undelete_url = \Cake\Routing\Router::url([
        'controller' => 'EbayCheckoutSessions',
        'action' => 'undeleteItem',
        'plugin' => 'EbayCheckout',
        'uuid' => $ebayCheckoutSession->core_seller->uuid,
        'itemId' => $item->id,
        '?' => [
            'token' => $ebayCheckoutSession->session_token,
            'key' => $ebayCheckoutSession->form_key
        ]
    ]);
    $item_url = $this->Url->build([
        'controller' => 'Products',
        'action' => 'view',
        'plugin' => 'Feeder',
        $item->ebay_item_id,
        \Cake\Utility\Text::slug($item->title)
    ]);
    $basePrice = $item->base_price_value/* * $item->quantity*/;
    $originalPrice = $item->original_price_value;
    $selectedShippingMethodId = $item->selected_ebay_checkout_session_item_shipping->id ?? null;
    if ($selectedShippingMethodId && isset($item->ebay_checkout_session_item_shippings[$selectedShippingMethodId])) {
        $selectedShippingMethod = $item->ebay_checkout_session_item_shippings[$selectedShippingMethodId];
        $shippingCosts = $selectedShippingMethod['base_delivery_cost_value']
                        + $selectedShippingMethod['additional_unit_cost_value'] * ($item->quantity - 1);
    } else {
        $shippingCosts = null;
    }
    ?>

    <div class="row mini-cart-item-row mini-cart-item-<?= $item->id ?>">
        <div class="col-3 item-product-image">
            <a href="<?= $item_url ?>"><img src="<?= $item->image ?>" /></a>
            <a class="wishlist-status"></a>
        </div>
        <div class="col-9 item-product-information">
            <?php /*<a href="<?= $delete_url ?>" class="delete-item" data-item-id="<?= $item->id ?>" title="<?= __('Delete') ?>"></a>*/ ?>
            <strong class="title"><?= $item->title ?></strong>
            <br />
            <?php /* original position before summeredesign 2019
            if ($originalPrice > $basePrice) {
                ?>
                <span class="original-price">€<?= number_format($originalPrice, 2) ?></span>
                <span class="base-price">€<?= number_format($basePrice, 2) ?></span>
                <?php
            } else {
                ?>
                <strong>€<?= number_format($basePrice, 2) ?></strong>
                <?php
            }*/
            ?>
            <br />
            <?php
            if (!empty($item->attributes)) {
                foreach (unserialize($item->attributes) as $label => $value) {
                    ?>
                    <strong><?= __($label) ?>:</strong>
                    <?= $value ?><br />
                    <?php
                }
            }

            if ($shippingCosts !== null) {
                ?>
                <strong><?= __('ShippingCost') ?>:</strong>
                <?= $item->ebay_checkout_session_item_shippings[0]['shipping_service_code'] ?>
                -
                <?= $shippingCosts ? '€' . number_format($shippingCosts, 2) : __('Free Shipping') ?>
                <br />
                <?php
            }
            ?>

            <span class="price-box">
                <?php
                if ($originalPrice > $basePrice) {
                    ?>
                    <span class="original-price"><?= number_format($originalPrice, 2) ?> &euro;</span>
                    <span class="base-price"><?= number_format($basePrice, 2) ?> &euro;</span>
                    <?php
                } else {
                    ?>
                    <?= number_format($basePrice, 2) ?> &euro;
                    <?php
                }
                ?>
            </span>

            <strong><?= __('Number') ?></strong>:
            <?= $item->quantity ?>
        </div>
        <br />
        <span class="links-box">
            <?= $this->element('ItoolCustomer.wishlist_link', ['wishlistItems' => $wishlistItems, 'itemId' => $item->ebay_item_id, 'linkLabel' => true, 'locationClass' => 'from-minicart']) ?>
            <a href="<?= $delete_url ?>" class="delete-item" data-item-id="<?= $item->id ?>"><?= __('Remove article') ?></a>
            <script>
                $('.delete-item[data-item-id="<?= $item->id ?>"]').on('click', function (e) {
                    pushEcommerce('removeFromMiniCart', [processProductData(<?= json_encode($this->Feeder->filterProductData($item)) ?>)]);
                });
            </script>
        </span>
        <div class="wishlist-box">
            <div class="col-12">
                <div class="row">
                    <div class="col-3">
                        <?= $this->Html->image('ItoolCustomer.back-to-wishlist.png', ['alt' => __('The item has been added to your wish list.')]) ?>
                    </div>
                    <div class="col-9">
                        <?= __('The item has been added to your wish list.') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

if (!empty($deletedItems)) {
    foreach ($deletedItems as $item) {
        $undelete_url = \Cake\Routing\Router::url([
            'controller' => 'EbayCheckoutSessions',
            'action' => 'undeleteItem',
            'plugin' => 'EbayCheckout',
            'uuid' => $ebayCheckoutSession->core_seller->uuid,
            'itemId' => $item->id,
            '?' => [
                'token' => $ebayCheckoutSession->session_token,
                'key' => $ebayCheckoutSession->form_key
            ]
        ]);
        ?>
        <div class="row mini-cart-deleted-item-row mini-cart-item-<?= $item->id ?>">
            <div class="col-12">
                <a href="<?= $undelete_url ?>" class="undelete-item" data-item-id="<?= $item->id ?>"><?= __('Undo') ?></a>
                <strong><?= __('Article has been removed') ?></strong>
                <br />
                <span class="product-title"><?= $item->title ?></span>
            </div>
        </div>
        <script>
            $('.undelete-item[data-item-id="<?= $item->id ?>"]').on('click', function (e) {
                pushEcommerce('readdToMiniCart', [processProductData(<?= json_encode($this->Feeder->filterProductData($item)) ?>)]);
            });
        </script>
        <?php
    }
}

?>

<script>
    $(function () {
        $('.wishlist-item-link').wishlistify();
    });
</script>
