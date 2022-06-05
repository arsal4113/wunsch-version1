<div class="col-12">
    <div class="row browse-row">
        <?php if (empty($items)) : ?>
            <div class="col-12">
                <?php if ($search != '') : ?>
                    <div class="search-result empty">
                        <p class="big"><?= __('We have millions of items, but unfortunately not'); ?><br><span>"<?= h($search); ?>" </span></p>
                        <p><span><?= __('Click on one of the categories to continue searching.'); ?></span></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php foreach ($items as $key => $item) : ?>
            <?php if (!empty($smallShownBanners) && in_array($key, $smallBannerSlots)) : ?>
                <?= $this->element('Feeder.Browse/small_banner', [
                    'smallBanner' => array_shift($smallShownBanners)
                ]); ?>
            <?php endif; ?>
            <?php if (!empty($largeShownBanners) && in_array($key, $largeBannerSlots)) : ?>
                <?= $this->element('Feeder.Browse/large_banner', [
                    'largeBanner' => array_shift($largeShownBanners)
                ]); ?>
            <?php endif; ?>
            <?= $this->element('Feeder.Browse/item', ['item' => $item, 'feederCategory' => $feederCategory, 'wishlistItems' => $wishlistItems]); ?>
        <?php endforeach; ?>

        <script type="text/javascript">
            var itemCount = '<?= count($items) ?>';
            var under = '<?= $under ?>';
            var upper = '<?= $upper ?>';
            var search = '<?= h($search) ?>';
            var url = '<?= $this->Url->build([
                'controller' => 'Browse',
                'action' => 'view',
                'plugin' => 'Feeder',
                $feederCategory->id,
                \Cake\Utility\Text::slug($feederCategory->name)
            ]) ?>';
            var categoryItemCount = '<?= $itemCount ?>';
            var filter = <?= json_encode($filter) ?>;
            filter.page = parseInt(filter.page) + 1;
        </script>
        <?php if ($itemCount == count($items)): ?>
            <?= $this->element('Feeder.Browse/loader'); ?>
        <?php endif; ?>
    </div>
</div>
<script>
    (function ($) {
        const browseContainer = $('#homepage-contents .container');
        browseContainer.on('click', '#load-more-products', function () {
            $(this).hide();
            $('#category-loader .animated-loader').show();
            $.ajax(
                {
                    'url': url,
                    'data': filter,
                    'method': 'GET',
                    'success': function (data) {
                        $('#category-loader').remove();
                        browseContainer.find('.browse-row').append(data);
                        try {
                            $('.wishlist-item-link').wishlistify();
                        } catch (e) {
                            console.log(e);
                        }
                        pushEcommerce('newSetOfProductsLoaded', itemCount);
                    },
                    'error': function (data) {
                        $('#category-loader').remove();
                        browseContainer.find('.browse-row').append(data);
                        try {
                            $('.wishlist-item-link').wishlistify();
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
            );
        });

        // webExtend
        ScarabQueue.push(['category', '<?= $feederCategory->url_path ?>']);
    }(jQuery));
</script>
