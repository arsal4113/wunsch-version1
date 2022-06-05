<?php
$this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true]);
?>
<?php if (!$isAjax) : ?>
<div class="container">
    <div class="row content-wrapper">
        <?php if (!$wishlistItems) : ?>
            <div id="empty-wishlist-container" class="col-12">
                <?php
                $this->Html->css('Feeder.homepage' . STATIC_MIN, ['block' => true]);
                $this->Html->script('slick' . STATIC_MIN, ['block' => true]);
                $this->Html->script('jquery.ui.touch-punch.min', ['block' => true]);
                ?>
                <div id="empty-wishlist" class="row wishlist-infobox">
                    <div class="col-12">
                        <span class="broken-heart"></span>
                        <h3><?= __d('itool_customer', 'Your wishlist is empty.') ?></h3>
                        <p>
                            <?= __d('itool_customer',
                                'You want it? We have it!') ?> <br>
                            <span class="second-text-row"><?= __d('itool_customer', 'Find your catch of the day now.') ?></span>
                        </p>
                        <a href="/world-of-trends"><span class="wishlist-button redesign-button"><?= __d('itool_customer', 'discover products') ?></span></a>
                    </div>
                </div>
                <h3 id="surprise-item-headline" class="col-12"><?= __d('itool_customer', 'Popular products on Catch') ?></h3>
                <?= $this->cell('Feeder.SurpriseItems'); ?>
            </div>
            <script>
                catcher.wishlistIsEmpty = true;
                window.reloadAfterWishlistAdd = true;
                (function ($) {
                    $('body.wishlist .wishlist-infobox .wishlist-button.redesign-button').on('click', function (e) {
                        pushEcommerce('emptyWishList', null);
                    });
                })(jQuery);
            </script>
        <?php else : ?>
            <script>
                catcher.wishlistIsEmpty = false;
                window.reloadAfterWishlistRemove = true;
            </script>
        <?php endif; ?>
        <div id="wishlist-items-container" class="col-12 wishlist-items">
            <h1 class="wishlist-title"><?= __d('itool_customer', 'Your Wishlist') ?></h1>
            <div class="row browse-row">
                <?php endif; ?>
                <?php foreach ($wishlistItems as $wishlistItem) : ?>
                    <?php if ($wishlistItem == 'smallBanner') : ?>
                        <?= $this->element('Feeder.Browse/small_banner', [
                            'smallBanner' => array_shift($smallShownBanners)
                        ]); ?>
                    <?php elseif ($wishlistItem == 'largeBanner') : ?>
                        <?= $this->element('Feeder.Browse/large_banner', [
                            'largeBanner' => array_shift($largeShownBanners)
                        ]); ?>
                    <?php else : ?>
                        <?php
                        $uniqueId = md5(is_object($wishlistItem) ? ($wishlistItem->ebay_item_id . $wishlistItem->name) : (time() . microtime()));
                        $itemFastFree = ((isset($wishlistItem->delivery_duration_de) && $wishlistItem->delivery_duration_de <= 3) && (isset($wishlistItem->delivery_cost_de) && $wishlistItem->delivery_cost_de == 0));
                        $itemSoldOut = ($wishlistItem->quantity && $wishlistItem->quantity < 3);
                        ?>
                        <?php /** @var \ItoolCustomer\Model\Entity\CustomerWishlistItem $wishlistItem */ ?>
                        <div class="col-6 col-md-4 browse-col" id="<?= $uniqueId ?>">
                            <div class="card">
                                <a href="<?= $this->Url->build([
                                    'controller' => 'Products',
                                    'action' => 'view',
                                    'plugin' => 'Feeder',
                                    $wishlistItem->ebay_item_id,
                                    \Cake\Utility\Text::slug($wishlistItem->name),
                                ]); ?>">
                                    <div class="card-img-wrapper">
                                        <?= $this->Html->image('lazy-placeholder.png', [
                                            'data-src' => $wishlistItem->image,
                                            'data-srcset' => $wishlistItem->image,
                                            'alt' => $this->Feeder->htmlAttributeSafe($wishlistItem->name),
                                            'class' => 'lazyload card-img-top'
                                        ]) ?>
                                    </div>
                                    <div class="card-label-wrapper">
                                        <?php if ($wishlistItem->eek) : ?>
                                            <div class="eek-label-wrapper">
                                                <div class="eek-label">
                                <span class="energy-rating-symbol <?= strtolower(str_replace('+', '-plus',
                                    $wishlistItem->eek)); ?>"><?php echo $wishlistItem->eek ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        if (($itemSoldOut && $itemFastFree) || ($itemFastFree)) {
                                            ?>
                                            <div class="item-label">
                                                <span class="tag-fast-and-free"><?= __("Fast and free") ?></span>
                                            </div>
                                            <?php
                                        } elseif ($itemSoldOut) {
                                            ?>
                                            <div class="item-label">
                                                <span class="tag-almost-sold-out"><?= __("Almost sold out") ?></span>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="row card-body">
                                        <p class="card-price col-12">
                                            <?php if (isset($wishlistItem->original_price) && $wishlistItem->price != $wishlistItem->original_price) : ?>
                                                <span class="additional-price-info marketing-price">
                                                    <?= \Cake\I18n\Number::currency($wishlistItem->original_price,
                                                        $wishlistItem->currency); ?></span>
                                            <?php endif; ?>
                                            <span class="item-price <?php if (isset($wishlistItem->original_price) && $wishlistItem->price != $wishlistItem->original_price)
                                                { echo "item-savings";} ?>">
                                                <?= \Cake\I18n\Number::currency($wishlistItem->price, $wishlistItem->currency); ?>
                                            </span>
                                        </p>
                                    </div>
                                    <?= $this->element('ItoolCustomer.wishlist_link', [
                                        'wishlistItems' => [$wishlistItem->ebay_item_id => true],
                                        'itemId' => $wishlistItem->ebay_item_id,
                                        'categoryId' => $wishlistItem->category_id
                                    ]); ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                    if (is_object($wishlistItem)) {
                        ?>
                        <script>
                            productImpressions.el_<?= $uniqueId ?> = {
                                el: document.getElementById('<?= $uniqueId ?>'),
                                cb: function () {
                                    pushEcommerce('productImpression', processProductData(<?= json_encode($this->Feeder->filterProductData($wishlistItem, 'WishList')) ?>, true));
                                }
                            };

                            $('#<?= $uniqueId ?>').on('click', function (e) {//e.preventDefault();
                                pushEcommerce('productClick', [processProductData(<?= json_encode($this->Feeder->filterProductData($wishlistItem, 'WishList')) ?>)]);
                            });
                        </script>
                        <?php
                    }
                    ?>
                <?php endforeach; ?>
                <script>
                    var filter = <?= json_encode($filter) ?>;
                    var itemCount = <?= json_encode(count($wishlistItems)) ?>;
                </script>
            </div>
            <?php if (!$isAjax) : ?>
        </div>
        <?php if((count($wishlistItems) >= 10)): ?>
            <?= $this->element('Feeder.Browse/loader'); ?>
        <?php endif; ?>
    </div>
</div>
    <script>
        (function ($) {
            const url = '<?= $this->Url->build([
                'controller' => 'Account',
                'action' => 'wishlist',
                'plugin' => 'ItoolCustomer'
            ]) ?>';
            $('#load-more-products').click(function () {
                const self = $(this);
                self.hide();
                $('#category-loader .animated-loader').show();
                filter.page++;
                $.ajax(
                    {
                        'url': url,
                        'data': filter,
                        'method': 'GET',
                        'success': function (data) {
                            $('.browse-row').append(data);
                            if (itemCount < filter.limit) {
                                $('#category-loader').hide();
                            }else{
                                self.show();
                                $('#category-loader .animated-loader').hide();
                            }
                        },
                        'error': function (data) {
                            self.show();
                            $('#category-loader .animated-loader').hide();
                            console.log("error");
                        }
                    }
                );
            });
            $('#header').header({
                catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>',
                type: 'white'
            });
        })(jQuery);
    </script>
<?php endif; ?>
