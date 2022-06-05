<?php
/** @var \Feeder\Model\Entity\FeederGuide $guide */

$this->Html->css('Feeder.gift-guide-edit' . STATIC_MIN, ['block' => true, 'media' => 'all']);
$this->assign('title', $guide->meta_title);
$this->assign('description', $guide->meta_description);
$this->assign('robotTag', $guide->robots_tag);

$classes = ['rotate-left', 'rotate-right', 'rotate-left', 'rotate-right', '', 'rotate-right', 'rotate-left', 'rotate-right', ''];
$categories = $guide->feeder_categories;
$pillarPages = $guide->feeder_pillar_pages;
$optionalUrls = $guide->optional_urls ? explode(';', $guide->optional_urls) : [];
$optionalUrlHeaders = $guide->optional_urls ? explode(';', $guide->optional_url_headers) : [];

$firstBackgroundImgPath = $guide->getImgPath($guide->first_background_image);
$secondBackgroundImgPath = $guide->getImgPath($guide->second_background_image);
$animationBackground = $guide->getImgPath($guide->animation_image) ?? 'white';

?>
<?php $this->start('content-fluid'); ?>
<?= $this->cell('Feeder.MegaNavi') ?>
<?php $this->end(); ?>
<style>
    .particles .particle {
    <?php if($animationBackground === "white"): ?>
        background: <?= $animationBackground ?>;
        filter: blur(3px);
    <?php else: ?>
        background: url("<?= $animationBackground ?>");
    <?php endif; ?>
        background-size: contain;
    }
</style>
<div class="col-12 content-wrapper">
    <div class="row cards-container">
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 text-card">
            <div class="headline">
                <h1><?= $guide->title ?></h1>
            </div>
            <div class="content">
                <p><?= $guide->description ?></p>
                <?php if(isset($firstBackgroundImgPath)): ?>
                    <img src="<?= $firstBackgroundImgPath ?>" class="first-background"/>
                <?php endif; ?>
            </div>
        </div>
        <?php
        $pos = 0;
        while ($pos < 9):
            if(isset($categories) && $category = current($categories)): ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card card-<?= $pos ?>">
                    <a href="<?= $category->url_path ?>">
                        <div class="img-card <?= $classes[$pos] ?>">
                            <div class="particles"></div>
                            <div class="img-wrapper"><?= $this->Html->image($category->image, ['title' => $category->image_title_tag, 'alt' => $category->image_alt_tag]); ?></div>
                            <div class="text-wrapper"><?= $category->headline_guide ?: $category->name ?></div>
                        </div>
                    </a>
                </div>
                <?php next($categories); ?>
            <?php elseif(isset($pillarPages) && $pillarPage = current($pillarPages)): ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card card-<?= $pos ?>">
                    <a href="<?= $pillarPage->url_path ?>">
                        <div class="img-card <?= $classes[$pos] ?>">
                            <div class="particles"></div>
                            <div class="img-wrapper"><?= $this->Html->image($pillarPage->guide_image); ?></div>
                            <div class="text-wrapper"><?= $pillarPage->guide_headline ?: $pillarPage->title_tag ?></div>
                        </div>
                    </a>
                </div>
                <?php next($pillarPages); ?>
            <?php elseif($optionalUrl = current($optionalUrls)): ?>
                <?php $optionalUrlHeader = current($optionalUrlHeaders); ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card card-<?= $pos ?>">
                    <a href="<?= $optionalUrl ?>">
                        <div class="img-card <?= $classes[$pos] ?>">
                            <?php if (!empty($guide->optional_url_image)): ?>
                                <div class="particles"></div>
                                <div class="img-wrapper"><?= $this->Html->image($guide->optional_url_image); ?></div>
                            <?php endif; ?>
                            <div class="text-wrapper"><?= $optionalUrlHeader ?: preg_replace('#https?://#', '', $optionalUrl) ?></div>
                        </div>
                    </a>
                </div>
                <?php next($optionalUrls); next($optionalUrlHeaders); ?>
            <?php else: ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card card-<?= $pos ?>">
                </div>
            <?php endif; ?>
            <?php if($pos === 0): ?>
            <div class="col-12 mobile-description">
                <p><?= $guide->description ?></p>
            </div>
        <?php endif;
            ++$pos;
        endwhile;?>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('body').addClass('gift-guide');

        $('#header').header({
            catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>',
            type: 'white'
        });

        let backgroundColor = '<?= $guide->background_color ?>',
            useAnimation = <?= $guide->display_animation ?>,
            animationBackground = "<?= $animationBackground ?>";

        if (backgroundColor !== '') {
            $('body').css({'background-color': backgroundColor});
        }

        // snow effect on hover
        let particles = null,
            cardImages = $('.card .img-card');

        cardImages.on('mouseover', function () {
            if ($(window).width() > 1024 && useAnimation) {
                particles = $(this).find('.particles');
                start();
            }
        });
        cardImages.on('mouseout', function () {
            if ($(window).width() > 1024 && useAnimation) {
                particles = $(this).find('.particles');
                particles.find('.particle').remove();
            }
        });

        function start() {
            let np = document.documentElement.clientWidth / 5;
            particles.innerHTML = "";
            for (let i = 0; i < np; i++) {
                let w = document.documentElement.clientWidth,
                    h = document.documentElement.clientHeight,
                    rndw = Math.floor(Math.random() * w) + 1,
                    rndh = Math.floor(Math.random() * h) + 1,
                    widthpt = Math.floor(Math.random() * 8) + 3,
                    opty = Math.floor(Math.random() * 5) + 2,
                    anima = Math.floor(Math.random() * 12) + 8,
                    div = document.createElement("div");

                div.classList.add("particle");
                div.style.marginLeft = rndw + "px";
                div.style.marginTop = rndh + "px";
                div.style.width = widthpt + "px";
                div.style.height = widthpt + "px";
                div.style.opacity = opty;
                div.style.animation = "move " + anima + "s ease-in infinite ";
                particles.append(div);
            }
        }
    });
</script>
