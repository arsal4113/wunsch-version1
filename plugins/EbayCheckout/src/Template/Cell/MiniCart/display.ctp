<?php
/** @var \EbayCheckout\Model\Entity\EbayCheckoutSession $ebayCheckoutSession */
?>
<?php if (\Cake\Core\Configure::read('ebayCheckout.cart', false)) : ?>
    <?php $itemCount = count($ebayCheckoutSession->ebay_checkout_session_items ?? []); ?>
    <?php if (!$ajax) : ?>
    <span id="mini-cart-icon" class="mini-cart-icon">
        <?= __('Mini cart'); ?><?= !empty($ebayCheckoutSession->ebay_checkout_session_items) && $itemCount ? '<span class="item-count">' . $itemCount . '</span>' : '' ?>
    </span>
    <?php endif; ?>
    <div class="mini-cart-wrapper container hidden widget">
        <?php if ($itemCount) : ?>
            <div class="widget-title mini-cart-title row">
                <h3 class="col-12"><?= __('Cart') ?></h3>
            </div>
            <div class="widget-body">
                <div class="mini-cart-items row">
                    <div class="col-12">
                        <?= $this->element('EbayCheckout.MiniCart/items',
                            ['ebayCheckoutSession' => $ebayCheckoutSession]) ?>
                    </div>
                </div>
                <div class="mini-cart-totals row">
                    <div class="col-12">
                        <?= $this->element('EbayCheckout.MiniCart/totals',
                            ['ebayCheckoutSession' => $ebayCheckoutSession]) ?>
                    </div>
                </div>
                <div class="mini-cart-buttons row">
                    <div class="col-12">
                        <a href="<?= \Cake\Routing\Router::url([
                            'controller' => 'EbayCheckoutSessions',
                            'action' => 'view',
                            'plugin' => 'EbayCheckout',
                            'uuid' => $ebayCheckoutSession->core_seller->uuid
                        ]) ?>" class="button"><?= __('To checkout') ?></a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="widget-title mini-cart-title row">
                <h3 class="col-12"><?= __('Your cart is empty') ?></h3>
            </div>
            <div class="widget-body mini-cart-body-empty">
                <div class="mini-cart-empty row">
                    <div class="col-12">
                        <?= __('Start and fill your cart') ?>
                    </div>
                </div>
                <div class="mini-cart-buttons row">
                    <div class="col-12 button-info">
                        <?= __('Don\'t know where to start?') ?>
                    </div>
                    <div class="col-12">
                        <a href="<?= $miniCartEmptyLink ?>" class="button"><?= __('To the novelties') ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <script>
            (function ($) {
                $(function () {
                    $('.mini-cart-wrapper').mini_cart({
                        toggler: '#mini-cart-icon',
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

<?php endif; ?>

