<?php if (\Cake\Core\Configure::read('ebayCheckout.cart', false)) :
    $checkoutUrl = null; ?>
    <?php $itemCount = count($ebayCheckoutSession->ebay_checkout_session_items ?? []);?>
    <div class="mini-cart-container" id="mini-cart-background">
            <div class="mini-cart-wrapper hidden widget" id="mini-cart-container">
                <div class="mini-cart-loader" style="display: none;">
                    <span>Loading...</span>
                </div>
                <?php if ($itemCount || !empty($deletedItems)) : ?>
                    <?php $checkoutUrl = \Cake\Routing\Router::url([
                        'controller' => 'EbayCheckoutSessions',
                        'action' => 'view',
                        'plugin' => 'EbayCheckout',
                        'uuid' => $ebayCheckoutSession->core_seller->uuid
                    ]);
                    ?>
                    <div class="widget-title mini-cart-title row">
                        <p class="col-12 h3"><?= __('Your cart') ?></p>
                    </div>
                    <div class="widget-body">
                        <div class="mini-cart-items row">
                            <div class="col-12">
                                <?= $this->element('EbayCheckout.MiniCart/items', ['ebayCheckoutSession' => $ebayCheckoutSession, 'authUser' => $authUser]) ?>
                            </div>
                        </div>
                        <?php
                        //if ($itemCount) {
                            ?>
                            <div class="mini-cart-totals row">
                                <div class="col-12">
                                    <?= $this->element('EbayCheckout.MiniCart/totals', ['ebayCheckoutSession' => $ebayCheckoutSession]) ?>
                                </div>
                            </div>
                            <?php
                        //}
                        ?>
                        <div class="mini-cart-buttons row">
                            <div class="col-12">
                                <p>
                                    <?php if ($itemCount) { ?>
                                        <a href="<?= $checkoutUrl?>" class="to-checkout-link redesign-button summeredesign"><?= __('To checkout') ?></a>
                                        <?php
                                    } else echo '<br />';
                                    if (\Cake\Core\Configure::read('ebayCheckout.cart', true)) {
                                        ?>
                                        <a id="go-the-cart" href="<?= $cartUrl ?>" class="grey-link"><?= __('To cart') ?></a>
                                        <?php
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="widget-title mini-cart-title row">
                        <p class="col-12 h3">
                            <?= $this->Html->image('sad.png', ['alt' => __('Your cart is empty'), 'class' => 'empty-cart', 'fullBase' => true]) ?>
                            <br /><br />
                            <?= __('Your cart is empty') ?>
                        </p>
                    </div>
                    <div class="widget-body mini-cart-body-empty">
                        <div class="mini-cart-empty row">
                            <div class="col-9">
                                <?= __('Get started and fill your cart with the latest trends.') ?>
                            </div>
                        </div>
                        <div class="mini-cart-buttons row">
                            <div class="col-12 button-info">
                                <strong><?= __('Do you need more inspiration?') ?></strong>
                            </div>
                            <div class="col-12">
                                <a href="/world-of-trends" class="redesign-button summeredesign"><?= __('Discover World of Trends') ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <script>
                    (function ($) {
                        $(function () {
                            $('.mini-cart-wrapper').mini_cart({
                                toggler: '#mini-cart-icon',
                                loginMessage: "<?= __('Sign up to complete the order process easily, safely and quickly.') ?>",
                                checkoutUrl: '<?= $checkoutUrl ?>',
                                guestButtonText: "<?= __('Buy as a guest') ?>",
                                itemDeleteMessage: '<?= __('Do you really want to remove that item?') ?>',
                                refreshUrl: '<?= \Cake\Routing\Router::url(
                                    [
                                        'controller' => 'EbayCheckoutSessionCarts',
                                        'action' => 'mini',
                                        'plugin' => 'EbayCheckout'
                                    ]
                                ) ?>'
                            });
                        });
                    })(jQuery);
                </script>
            </div>
    </div>

    <script>
        var cartItems = [];
        <?php
        if ($itemCount) {
            ?>
            processProductData(<?= json_encode($this->Feeder->filterProductData($ebayCheckoutSession->ebay_checkout_session_items)) ?>, true, true);
            // webExtend
            <?php
            foreach ($ebayCheckoutSession->ebay_checkout_session_items as $item) {
                ?>
                cartItems.push({
                    item: '<?= str_replace("|", "%7C", $item->ebay_item_id) ?>',
                    quantity: <?= $item->quantity ?>,
                    price: <?= $item->base_price_value ?>
                });
                <?php
            }
        }
        ?>
        ScarabQueue.push(['cart', cartItems]);
    </script>
<?php endif; ?>
