<?php foreach ($items as $item) : ?>
    <?php if (!isset($item->image_url) && empty($item->image_url)) {
        continue;
    } ?>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <a href="<?= $this->Url->build([
                'controller' => 'Products',
                'action' => 'view',
                'plugin' => 'Feeder',
                $item->item_id,
                \Cake\Utility\Text::slug($item->title)
            ]); ?>">
                <?php /*if (isset($item->marketingPrice->discountPercentage) && $item->marketingPrice->discountPercentage) : ?>
                    <div class="item-discount-wrapper">
                        <span class="item-discount-percent">- <?= $item->marketingPrice->discountPercentage; ?>%</span>
                    </div>
                <?php endif; */?>
                <div class="card-img-wrapper">
                    <img class="card-img-top" src="<?= $item->image_url; ?>" alt="<?= h($item->title); ?>">
                </div>
                <div class="card-body">
                    <p class="card-price">
                        <span class="item-price"><?= $item->currency; ?> <?= $item->price; ?></span>
                        <?php /*if (isset($item->marketingPrice)) : ?>
                            <span class="item-discount-price"><strike><?= $item->marketingPrice->originalPrice->currency; ?> <?= $item->marketingPrice->originalPrice->value; ?></strike></span>
                        <?php endif; */?>
                    </p>
                </div>
            </a>
        </div>
    </div>
<?php endforeach; ?>
    <div class="load-more-button-container" id="load-more-lovely-products"><button onclick="loadMoreProducts();"><?= __('Load more products'); ?></button></div>
    <script type="text/javascript">
        $.fn.isInViewport = function () {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();

            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            return elementBottom > viewportTop && elementTop < viewportBottom;
        };
        var pageCounter = 2;
        var loading = false;
        var loader = '<div class="loader" id="category-loader"><?= $this->Html->image('product-laden-icon.svg'); ?><br/><?= __('Load products...'); ?></div>';
        var button = '<div class="load-more-button-container" id="load-more-lovely-products"><button onclick="loadMoreProducts();"><?= __('Load more products'); ?></button></div>';
        function loadMoreProducts() {
            if ($('#footer').isInViewport() && !loading) {
                loading = true;
                if (!$('#category-loader').length) {
                    $('.content-area').append(loader);
                }
                $('#load-more-lovely-products').remove();

                $.ajax(
                    '<?= $this->Url->build([
                        'controller' => 'Browse',
                        'action' => 'view',
                        'plugin' => 'Feeder',
                        $feederCategory->id
                    ]); ?>?page=' + pageCounter,
                    {
                        'method': 'GET',
                        'success': function (data) {
                            pageCounter = pageCounter + 1;
                            $('#category-loader').remove();
                            $('.content-area').append(data).append(button);
                            loading = false;
                        },
                        'error': function (data) {
                            $('#category-loader').remove();
                            $('.content-area').append(button);
                            loading = false;
                        }
                    });
            }
        };
    </script>
