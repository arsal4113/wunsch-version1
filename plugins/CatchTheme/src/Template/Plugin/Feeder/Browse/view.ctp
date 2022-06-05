<script>
    document.cookie = 'iways_product_source=<?= (($under > 20 || $upper > 0) ? 'filter' : 'category') ?> path=/'; // setting source-page for product-view cookie
    pandata.pageType = 'category';
    pandata.category = '<?php echo $feederCategory->id ?>';
</script>

<?php
/**
 * @var \Feeder\Model\Entity\FeederCategory $feederCategory
 */

?>

<?php if (!$ajax): ?>

<?php

$this->Html->css('jquery-ui', ['block' => true, 'media' => 'all']);
$this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true, 'media' => 'all']);

if (!STATIC_MIN) {
    $this->Html->script('jquery.ui.touch-punch.min', ['block' => true]);
    $this->Html->script('Feeder.ajax-browse', ['block' => true]);
    echo $this->Html->script('Feeder.simple-slider');
} else {
    $this->Html->script('Feeder.ajax-browse.min', ['block' => true]);
}

$this->start('category-filter');
echo $this->element('price_filter',
    [
        'feederCategory' => $feederCategory,
        'under' => $under,
        'priceLimit' => $priceLimit,
        'priceFrom' => $priceFrom
    ]
);
$this->end();

$this->start('page-control');
echo $this->element('back_to_top');
$this->end();
$this->start('category-banner');
echo $this->element('category_banner');
$this->end();

?>
<?php $metaTags = [
    'title' => 'title_tag',
    'description' => 'meta_description',
    'facebook_og_url' => 'facebook_og_url',
    'facebook_og_type' => 'facebook_og_type',
    'facebook_og_title' => 'facebook_og_title',
    'facebook_og_description' => 'facebook_og_description',
    'facebook_og_image' => 'facebook_og_image'
];

foreach ($metaTags as $key => $metaTag) {
    if (!empty($feederCategory->{$metaTag})) {
        $this->assign($key, $feederCategory->{$metaTag});
    }
}
?>

<?php $canonicalLink = $this->Url->build([
    'controller' => 'Browse',
    'action' => 'view',
    'plugin' => 'Feeder',
    $feederCategory->canonical_link_category_id ?: $feederCategory->id
],
    true);

$this->assign('canonicalLink', $canonicalLink);

?>

<?php $this->assign('robotTag', $feederCategory->robot_tag); ?>

<div class="col-12">
    <?php
    if ($feederCategory->has_animated_header) {
        echo $feederCategory->animated_header_custom_style
            . $this->element('animated_header', ['feederCategory' => $feederCategory]);
    }
    ?>

    <span id="more-categories-block"><?= __('Kategorien') ?></span>

    <div class="in-block sticky-filter-control"></div>

    <div class="row browse-row">
        <?php endif; ?>
        <?php if (empty($items)) : ?>
            <div class="col-12">
                <?php if ($search != '') : ?>
                    <div class="search-result empty">
                        <p class="big"><?= __('We have millions of items, but unfortunately not'); ?>
                            <br><span>"<?= h($search); ?>" </span></p>
                        <p><span><?= __('Click on one of the categories to continue searching.'); ?></span></p>
                    </div>
                <?php elseif ($page == "1"): ?>
                    <div class="search-result empty">
                        <p class="big"><?= __('Sadly, no items matched your filter configuration.'); ?></p>
                        <p>
                            <span><?= __('Change the filter or click on one of the categories to continue searching.'); ?></span>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php
            $count = 0;
            foreach($items as $key => $item){
                $count++;
                if($item == 'smallBanner'){
                    echo $this->element('Browse/small_banner', [
                        'smallBanner' => array_shift($smallShownBanners)
                    ]);
                }elseif ($item == 'largeBanner'){
                    $count++;
                    echo $this->element('Browse/large_banner', [
                        'largeBanner' => array_shift($largeShownBanners)
                    ]);
                }else{
                    echo $this->element('Feeder.Browse/item', ['item' => $item, 'feederCategory' => $feederCategory]);
                }
                if($count === 12 && $page == "1"){
                    if(!empty($fizzyBubbles)){
                        echo '<div class="col-12 catch-worlds-slider">' .
                            '<p>' . __("Discover more Worlds") . '</p>' .
                            '<div class="slider-rail">' .
                                '<div id="mario" class="slider-cart" style="width:' . count($fizzyBubbles) * 135 . 'px;">';
                                    foreach($fizzyBubbles as $bubble){
                                        echo '<div class="category-bubble">' .
                                            '<a draggable="false" class="bubble-link" href="' . $bubble->url . '">' .
                                                $this->Html->image($bubble->image_src, [
                                                    'title' => $bubble->title_text,
                                                    'class' => 'slider-bubble-image',
                                                    'alt' => $bubble->img_alt_tag,
                                                    'draggable' => 'false'
                                                ]) .
                                            '</a>' .
                                        '</div>';
                                    }
                                 echo '</div>' .
                            '</div>' .
                        '</div>';
                    }
                }
                if($count === 24 && $page == "1" && $feederCategory->template_type === "Template B" && $feederCategory->feeder_categories_video_element){
                    echo $this->element('Feeder.Browse/video_element', ['feederCategory' => $feederCategory]);
                }
            }
            ?>
            <script>
                $(function () {
                    $('.catch-worlds-slider .bubble-link').on('click', function (e) {
                        push2dataLayer({
                            'event': 'worldBubbleClick',
                            'clickedItem': $(this).children('img').attr('title'),
                            'clickedUrl': $(this).attr('href')
                        });
                    });
                });
            </script>
        <?php endif; ?>

        <?php /*<script>
            pushEcommerce('productImpression', processProductData(<?= json_encode($this->Feeder->filterProductData($items)) ?>, true));
        </script>*/ ?>

        <script type="text/javascript">
            // var headlineStyle , captionStyle ;
            var itemCount = '<?= count($items) ?>';
            var under = '<?= $under ?>';
            var upper = '<?= $upper ?>';
            var search = '<?= h($search) ?>';
            var priceLimit = <?= json_encode($priceLimit) ?>;
            var priceFrom = <?= json_encode($priceFrom) ?>;
            var url = '<?= $this->Url->build([
                'controller' => 'Browse',
                'action' => 'view',
                'plugin' => 'Feeder',
                $feederCategory->id,
                \Cake\Utility\Text::slug($feederCategory->name)
            ]) ?>';
            var categoryItemCount = '<?= $itemCount ?>';

            <?php if ($feederCategory->background) { ?>
            var categoryImage = '<?= $this->Url->image($feederCategory->background) ?>';
            <?php } else { ?>
            var categoryImage = false;
            <?php } ?>
            var categoryHeadline = <?= json_encode($feederCategory->headline) ?>;
            var categorySubtitle = <?= json_encode($feederCategory->caption) ?>;
            <?php if ($feederCategory->text_background_color) { ?>
            var textBackground = '<?= 'background-color:' . $this->Feeder->color2rgba($feederCategory->text_background_color,
                $feederCategory->opacity) . ';' ?>';
            <?php } else { ?>
            var textBackground = '';
            <?php } ?>

            var headlineColor = '<?= $feederCategory->headline_font_color ? 'color:' . $this->Feeder->parseColor($feederCategory->headline_font_color) . ';' : '' ?>';
            var captionColor = '<?= $feederCategory->caption_font_color ? 'color:' . $this->Feeder->parseColor($feederCategory->caption_font_color) . ';' : '' ?>';

            var headlineStyle = headlineColor.concat(textBackground);
            var captionStyle = captionColor.concat(textBackground);

            window.filter = <?= json_encode($filter) ?>;
            window.filter.page = parseInt(window.filter.page) + 1;
        </script>
        <?php if ($itemCount == count($items)): ?>
            <?= $this->element('Feeder.Browse/loader') ?>
        <?php endif; ?>
        <?php if (!$ajax) : ?>
    </div>
    <?php if (isset($feederCategory->footer_text) && $feederCategory->footer_text !== ""): ?>
    <div class="additional-footer-content">
        <?= $feederCategory->footer_text ?>
    </div>
    <?php endif; ?>
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

            window.browser = $('a.nav-link').ajaxBrowse();

            // webExtend
            ScarabQueue.push(['category', '<?= $feederCategory->url_path ?>']);

            $('.catch-worlds-slider .slider-bubble-image').on('dragstart', function (e){e.preventDefault();});
            $(document).ready(function () {
                $('.catch-worlds-slider').simple_slider({
                    sliderRail: '.catch-worlds-slider .slider-rail',
                    sliderCart: '.catch-worlds-slider .slider-rail .slider-cart'
                });
            });
        }(jQuery));
    </script>
<?php endif; ?>
