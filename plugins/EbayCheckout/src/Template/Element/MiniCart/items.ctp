<?php
/** @var \EbayCheckout\Model\Entity\EbayCheckoutSession $ebayCheckoutSession */
?>
<?php if (isset($ebayCheckoutSession->ebay_checkout_session_items)) : ?>
    <?php foreach ($ebayCheckoutSession->ebay_checkout_session_items as $item) : ?>
        <?php $uniqueId = md5($item->id . $item->title); ?>
        <div class="row mini-cart-item-row mini-cart-item-<?= $item->id ?>">
            <div class="col-4"><a href="<?= $this->Url->build([
                    'controller' => 'Products',
                    'action' => 'view',
                    'plugin' => 'Feeder',
                    $item->ebay_item_id,
                    \Cake\Utility\Text::slug($item->title)
                ]); ?>"><?= $this->Html->image($item->image) ?></a></div>
            <div class="col-8">
                <div class="row mini-item-title">
                    <div class="col-12"><?= $item->title ?></div>
                </div>
                <div class="row mini-item-qty">
                    <div class="col-12"><?= __('Qty:') . ' ' . $item->quantity ?></div>
                </div>
                <div class="row mini-item-details">
                    <div class="col-7 mini-item-remove"><a href="<?= \Cake\Routing\Router::url(
                            [
                                'controller' => 'EbayCheckoutSessions',
                                'action' => 'removeItem',
                                'plugin' => 'EbayCheckout',
                                'uuid' => $ebayCheckoutSession->core_seller->uuid,
                                'itemId' => $item->id,
                                '?' => [
                                    'token' => $ebayCheckoutSession->session_token,
                                    'key' => $ebayCheckoutSession->form_key
                                ]
                            ]
                        ); ?>" class="mini-cart-item-remove" data-item-id="<?= $item->id ?>" class="remove-item"><?=__('Remove article') ?></a></div>
                    <div class="col-5 mini-item-price"><?= \Cake\I18n\Number::currency($item->base_price_value * $item->quantity, $item->base_price_currency) ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
