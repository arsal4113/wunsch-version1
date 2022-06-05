<?php
if (\Cake\Core\Configure::read('ebayCheckout.cart', false)) {
    ?>
    <span id="mini-cart-icon" class="mini-cart-icon" data-cart-url="<?= $cartUrl ?? '' ?>"
          <?php if (isset($checkoutUrl) && $itemCount) echo 'data-checkout-url="' . $checkoutUrl . '"' ?>><span class="icon"></span><span class="homepage"></span><span class="active"></span><?= __('Mini cart') ?><?= $itemCount ? '<span class="item-count">' . $itemCount . '</span>' : '' ?>
    </span>
    <?php
}
