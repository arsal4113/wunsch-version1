<script>
    document.cookie = 'iways_product_source=home; path=/'; // setting source-page for product-view cookie
    pandata.pageType = 'home';
</script>

<?php

/** @var \Feeder\Model\Entity\FeederHomepage $feederHomepage */


$this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true, 'media' => 'all']);

$this->Html->css('jquery-ui', ['block' => true, 'media' => 'all']);
$this->Html->css('Feeder.homepage' . STATIC_MIN, ['block' => true, 'media' => 'all']);
if (!STATIC_MIN) {
    $this->Html->script('slick', ['block' => true]);
    $this->Html->script('jquery.ui.touch-punch.min', ['block' => true]);
}


$this->start('page-control');
echo $this->element('back_to_top');
$this->end();
$this->start('content-fluid');
?>
<?php $this->assign('title', $feederHomepage->title_tag); ?>
<?php $this->assign('description', $feederHomepage->meta_description); ?>
<?php $this->assign('canonicalLink', \Cake\Routing\Router::fullBaseUrl()); ?>
<?php $this->assign('robotTag', $feederHomepage->meta_robots_tag); ?>
<?= $this->cell('Feeder.FizzyBubbles'); ?>
<div id="homepage-contents" class="container-fluid">
    <div class="row">
        <?= $this->cell('Feeder.MegaNavi') ?>
    </div>

    <div class="container">
        <?php if ($feederHomepage->h1) : ?>
            <div class="row headline">
                <div class="col-12">
                    <h1><?= $feederHomepage->h1 ?></h1>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?= $this->cell('Feeder.Category', [$feederHomepage->feeder_category_id, $wishlistItems]); ?>
        </div>
    </div>
</div>
<div class="middle-page-container">
    <div class="extended-middle-page">
        <?php if ($feederHomepageMidpageContainer ?? false) : ?>
        <?php /** @var \Feeder\Model\Entity\FeederHomepageMidpageContainer $feederHomepageMidpageContainer */ ?>
        <div class="video-img-container"
             style="<?= ($feederHomepageMidpageContainer->background_color) ? 'background-color:' . $this->Feeder->parseColor($feederHomepageMidpageContainer->background_color) . ';' : '' ?>"
        >
            <?php if ($feederHomepageMidpageContainer->use_video) : ?>
                <div class="content-wrapper desktop">
                    <?php if ($video = $feederHomepageMidpageContainer->video_desktop_webm) : ?>
                        <video autoplay loop muted playsinline preload="">
                            <source  src="<?= $this->Url->image($video) ?>" type="video/webm">
                            Your browser does not support HTML5 video.
                        </video>
                        <?php elseif ($feederHomepageMidpageContainer->video_desktop_mp4) : ?>
                        <video autoplay loop muted playsinline preload="">
                            <source  src="<?= $this->Url->image($feederHomepageMidpageContainer->video_desktop_mp4) ?>" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                    <?php endif; ?>
                </div>
                <div class="content-wrapper tablet">
                    <?php if ($video = $feederHomepageMidpageContainer->video_tablet_webm) : ?>
                        <video autoplay loop muted playsinline preload="">
                            <source  src="<?= $this->Url->image($video) ?>" type="video/webm">
                            Your browser does not support HTML5 video.
                        </video>
                        <?php elseif ($feederHomepageMidpageContainer->video_tablet_mp4) : ?>
                        <video autoplay loop muted playsinline preload="">
                            <source  src="<?= $this->Url->image($feederHomepageMidpageContainer->video_tablet_mp4) ?>" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                    <?php endif; ?>
                </div>
            <?php $mobileVideo = $feederHomepageMidpageContainer->video_mobile_webm
                || $feederHomepageMidpageContainer->video_mobile_mp4 ?>
                <div class="content-wrapper mobile<?= !$mobileVideo ? ' default-height' : '' ?>">
                    <?php if ($video = $feederHomepageMidpageContainer->video_mobile_webm) : ?>
                        <video autoplay loop muted playsinline preload="">
                            <source  src="<?= $this->Url->image($video) ?>" type="video/webm">
                            Your browser does not support HTML5 video.
                        </video>
                    <?php elseif ($feederHomepageMidpageContainer->video_mobile_mp4) : ?>
                        <video autoplay loop muted playsinline preload="">
                            <source  src="<?= $this->Url->image($feederHomepageMidpageContainer->video_mobile_mp4) ?>" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                    <?php endif; ?>
                </div>
            <?php else:  ?>
                <div class="content-wrapper desktop">
                    <?php
                    $photo = $feederHomepageMidpageContainer->image_desktop;
                    if ($photo) : ?>
                        <img src="<?= $this->Url->image($photo) ?>">
                    <?php endif; ?>
                </div>
                <div class="content-wrapper tablet">
                    <?php
                    $photo = $feederHomepageMidpageContainer->image_tablet;
                    if ($photo) : ?>
                        <img src="<?= $this->Url->image($photo) ?>">
                    <?php endif; ?>
                </div>
                <div class="content-wrapper mobile">
                    <?php
                    $photo = $feederHomepageMidpageContainer->image_mobile;
                    if ($photo) : ?>
                        <img src="<?= $this->Url->image($photo) ?>">
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="overlay-content-wrapper">
                <?php if ($feederHomepageMidpageContainer->header_text) {
                    echo '<span class="middle-container-header">' . __($feederHomepageMidpageContainer->header_text) . '</span>';
                }
                ?>
                <?php if ($feederHomepageMidpageContainer->button_text) : ?>
                    <a class="middle-container-button"
                       href="<?= $feederHomepageMidpageContainer->click_url ? $feederHomepageMidpageContainer->click_url : 'javascript:;' ?>"
                       style="<?= $feederHomepageMidpageContainer->button_color ? 'background-color:' . $this->Feeder->parseColor($feederHomepageMidpageContainer->button_color) . ';' : '' ?>"
                    >
                        <?=  __($feederHomepageMidpageContainer->button_text) ?>
                    </a>
                <?php endif ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="text-wrapper">
            <?=  __('Browse our inventory of over 50 Mio. products - fashion, games, tech and more fun') ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            $('#header').header({
                catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>',
                type: 'white'
            });

            // Append Middle Page Container
            var midPage = $('.middle-page-container'),
                productCount = 0;

            $('.browse-row > div').each(function () {
                productCount++;
                if($(this).hasClass("large-banner-col")){
                    productCount++;
                }
                if(productCount === 12){
                    midPage.insertAfter($(this));
                    return false;
                }
            });
            if(productCount < 12){
                $('.browse-row > div:last').after(midPage);
            }

            // middle page container click tracking
            midPage.find('.middle-container-button').on('click', function (e) {
                push2dataLayer({
                    'event': 'homepageContainerClick',
                    'clickedItem': $(this).siblings('.middle-container-header').text(),
                    'clickedUrl': $(this).attr('href')
                });
            });
        });
    })(jQuery);
</script>

<?php
$this->end(); // This is the end, beautiful friend, this is the end, my only friend, the end..

