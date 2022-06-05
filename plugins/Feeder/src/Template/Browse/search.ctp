<script type="text/javascript">
    document.cookie = 'iways_product_source=<?= (($under > 20 || $upper > 0) ? 'filter' : 'search') ?>; path=/'; // setting source-page for product-view cookie
    pandata.pageType = 'searchresults';
    pandata.query = '<?= h($search) ?>';
    pandata.resultsNo = <?= count($items) ?>;
    push2dataLayer({
        'event': 'search',
        'resultsNo': pandata.resultsNo,
        'query': pandata.query
    });
</script>

<?php if (!$ajax): ?>

<?php

$this->Html->css('jquery-ui', ['block' => true]);
$this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true]);
$this->Html->script('jquery.ui.touch-punch.min', ['block' => true]);

$this->assign('title', $filter['search'] . " | CATCH");
$this->assign('robotTag', 'noindex,follow');

$this->start('category-filter');
    echo $this->element('price_filter');
$this->end();

?>

<div class="col-12">
    <span id="more-categories-block"><?= __('Kategorien') ?></span>
    <div class="in-block sticky-filter-control"></div>
    <div class="row browse-row">
        <?php endif; ?>
        <?php if (empty($items) && (!($filter['page'] ?? false) || $filter['page'] == 1)) : ?>
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
            <?= $this->element('Feeder.Browse/item', ['item' => $item, 'feederCategory' => null, 'wishlistItems' => $wishlistItems]); ?>
        <?php endforeach; ?>
        <script type="text/javascript">
            var itemCount = '<?= count($items) ?>';
            var under = '<?= $under ?>';
            var upper = '<?= $upper ?>';
            var search = '<?= h($search) ?>';
            var url = '<?= $this->Url->build([
                'action' => 'search',
                'controller' => 'Browse',
                'plugin' => 'Feeder'
            ]) ?>';
            var categoryItemCount = '<?= $itemCount ?>';
            window.filter = <?= json_encode($filter) ?>;
            window.filter.page = parseInt(window.filter.page) + 1;
        </script>
        <?php if ($itemCount == count($items)): ?>
            <?= $this->element('Feeder.Browse/loader'); ?>
        <?php endif; ?>
        <?php if (!$ajax) : ?>
    </div>
</div>
    <script>
        (function ($) {
            $('#header').header({
                catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>',
                type: 'white'
            });

            const browseContainer = $('.content-area .browse-row');
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
                            browseContainer.append(data);
                            try {
                                $('.wishlist-item-link').wishlistify();
                            } catch (e) {
                                console.log(e);
                            }
                            pushEcommerce('newSetOfProductsLoaded', itemCount);
                        },
                        'error': function (data) {
                            $('#category-loader').remove();
                            browseContainer.append(data);
                            try {
                                $('.wishlist-item-link').wishlistify();
                            } catch (e) {
                                console.log(e);
                            }
                        }
                    }
                );
            });
        }(jQuery));

        // webExtend
        ScarabQueue.push(['searchTerm', '<?= h($search) ?>']);
    </script>
<?php endif; ?>
