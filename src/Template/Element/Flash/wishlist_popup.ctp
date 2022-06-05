<?php $isCustomerLogged = (isset($authUser) && !empty($authUser)); ?>
<div class="wishlist-popup-alert">
    <div class="close-area">
        <div class="alert wishlist-popup">
            <div class="widget-wrapper tight-cart-widget warning">
                <p>
                    <strong><?= __('It will be tight in the shopping cart!') ?></strong>
                    <br />
                    <?= __(' Du kannst maximal zehn verschiedene Artikel in den Warenkorb legen.') ?>
                </p>
            </div>
            <?php /** @var \ItoolCustomer\Model\Entity\CustomerWishlistItem $wishlistItem */ ?>
            <?= $this->element('ItoolCustomer.wishlist_link', [
                'wishlistItems' => $wishlistItems,
                'itemId' => $itemId
            ]); ?>
            <?php if ($isCustomerLogged) : ?>
                <!--   Image selected  -->
                <?= $this->Html->image('lazy-placeholder.png', [
                    'data-src' => $wishlistItems['image'][0],
                    'data-srcset' =>$wishlistItems['image'][0],
                    'class' => 'lazyload card-img-top popup-product-image'
                ]) ?>
                <p class="msg"><?= __('Wir haben diesen Artikel für dich auf deine <a href="{0}">Wunschliste</a> gepackt.', \Cake\Routing\Router::url(
                        [
                            'controller' => 'Account',
                            'action' => 'wishlist',
                            'plugin' => 'ItoolCustomer'
                        ], ['id' => 'user-account-wish-list'])) ?></p>
            <?php else : ?>
                <?php if (!empty($images))
                    echo '<img class="popup-product-image" src="' . $images[0]['imageArray']['imgUrl'] . '">';
                ?>
                <p class="msg"><?= __('Melde dich an, um diesen Artikel auf die <a class="wishlist-item-link add" data-item-id="{0}" href="{1}" data-href-add="{2}">Wunschliste</a> zu setzten.', $itemId,
                        \Cake\Routing\Router::url(
                            ['controller' => 'Account',
                                'action' => 'wishlistAdd',
                                'plugin' => 'ItoolCustomer',
                                $itemId
                            ]),
                        \Cake\Routing\Router::url(
                            ['controller' => 'Account',
                                'action' => 'wishlistAdd',
                                'plugin' => 'ItoolCustomer',
                                $itemId
                            ])) ?></p>
            <?php endif; ?>
            <div class="wishlist-popup-button">
                <a href="<?= \Cake\Routing\Router::url(
                    ['controller' => 'EbayCheckoutSessions',
                        'action' => 'cart',
                        'plugin' => 'EbayCheckout',
                        'uuid' => \Cake\Core\Configure::read('dealsguru.uuid')
                    ]) ?>"><?= __('To cart') ?></a>
            </div>

            <div class="col checkout-back-button">
                <a class="close-btn"><?= __('Back') ?></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function ($) {
        $(function () {
            $('#content').addClass('no-scroll');
            $('.close-area').on('click', function (e) {
                if(e.target === this){
                    hidePopup();
                }
            });
            $('.close-btn').on('click', function () {
                hidePopup();
            });
            function hidePopup() {
                $('#content').removeClass('no-scroll');
                $('.wishlist-popup-alert').fadeOut(500);
            }

            if ($('#footer.position-fixed').css('bottom') !== 0) {
                $('.to-many-items-alert .wishlist-popup-alert').css('height', '100%')
            }
        });
    })(jQuery);
</script>