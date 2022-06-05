<div id="banners-carousel" class="container-fluid" style="margin-left:-15px;">
    <?php foreach ($homepageBanners as $key => $banner): ?>
        <?php /** @var \Feeder\Model\Entity\FeederHomepageBanner $banner */ ?>
        <div class="banner-slide"
             data-loader-color="<?= $banner->loader_color ? $this->Feeder->parseColor($banner->loader_color) : '0' ?>">
            <div class="container-fluid banner-picture-wrapper">
                <div class="row">
                    <div class="col-12">
                        <a id="slot<?= $key + 1 ?>" class="banner-image" href="<?= $banner->banner_link ?>">
                            <?= $this->Picture->picture($banner, 'banner_image', 'banner_bp_lg', 'banner_bp_md',
                                'banner_bp_sm',
                                'banner_bp_xs', $key) ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container banner-content-wrapper" <?= $key ? 'style="display:none"' : '' ?>>
                <a href="<?= $banner->banner_link ?>">
                    <div class="banner-content">
                        <div class="banner-content-headline row">
                            <div class="col-12">
                                <span class="banner-content-line">
                                    <span class="banner-headline" style="
                                    <?= $banner->headline_font_color ? 'color:' . $this->Feeder->parseColor($banner->headline_font_color) . ';' : '' ?>
                                    <?= $banner->text_background_color ? 'background-color:' . $this->Feeder->color2rgba($banner->text_background_color,
                                            $banner->opacity) . ';' : '' ?>
                                        "><?= $banner->headline ?></span>
                                </span>
                            </div>
                        </div>
                        <div class="banner-content-row row">
                            <div class="col-12">
                                <span class="banner-content-line">
                                    <span class="banner-caption" style="
                                    <?= $banner->caption_font_color ? 'color:' . $this->Feeder->parseColor($banner->caption_font_color) . ';' : '' ?>
                                    <?= $banner->text_background_color ? 'background-color:' . $this->Feeder->color2rgba($banner->text_background_color,
                                            $banner->opacity) . ';' : '' ?>
                                        "><?= $banner->caption ?></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="container">
                <div class="slick-button banner-button" <?= $key ? 'style="display:none"' : '' ?>>
                    <a href="<?= $banner->banner_link ?>"
                       style="<?= $banner->cta_color ? 'background-color:' . $this->Feeder->parseColor($banner->cta_color) . ';' : '' ?>">
                        <?= $banner->cta ? $banner->cta : __('Jetzt entdecken') ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="container banner-navigation-container">
    <div class="row">
        <div class="offset-8 col-4 banner-navigation">
            <div class="navigation-time" id="next-circle-wrapper">
                <figure id="next-circle-wrapper">
                    <svg width="32" height="32" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <polyline fill="none" stroke="#F9B500" stroke-width="2" class="arrow"
                                  points="13 9 18.735 14.735 13 20.471"></polyline>
                    </svg>
                </figure>
                <div id="half_clip">
                    <div class="half_circle" id="clipped"></div>
                </div>
                <div class="half_circle" id="fixed"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var promotions = [];
    <?php
    foreach ($homepageBanners as $key => $banner) {
    ?>
    var banner_item_<?= $key + 1 ?> = $('#slot<?= $key + 1 ?>'),
        banner_item_<?= $key + 1 ?>_button = banner_item_<?= $key + 1 ?>.closest('.banner-slide')/*.find('.banner-button')*/;
    banner_item_<?= $key + 1 ?>_button.on('click', function (e) {//e.preventDefault();
        push2dataLayer({
            'ecommerce': {
                'promoClick': {
                    'promotions': [{
                        'creative': '<?= $key !== 0 ? 'smallbanner' . $key : 'large banner' ?>',
                        'id': '<?= $banner->banner_link ?>',
                        'name': '<?= $banner->banner_image ?>',
                        'position': 'slot<?= $key + 1 ?>'
                    }]
                }
            },
            'event': 'promotionClick'
        });
    });
    promotions.push({
        'creative': '<?= $key !== 0 ? 'smallbanner' . $key : 'large banner' ?>',
        'id': '<?= $banner->banner_link ?>',
        'name': '<?= $banner->banner_image ?>',
        'position': 'slot<?= $key + 1 ?>'
    });
    <?php
    }
    ?>
    // additional pandata tracking for banners
    google.ecommerce.promoView = {
        'promotions': promotions
    };
    push2dataLayer({
        'ecommerce': {
            'promoView': {
                'promotions': promotions
            }
        },
        'event': 'promotionImpression'
    });

    var sliderSpeed = 4000;

    $(function () {
        $('#banners-carousel').on('init afterChange', function (event, slick, currentSlide, nextSlide) {
            $(".navigation-time").removeClass("start", function () {
                var loaderColor = $(".slick-current .banner-slide").data('loader-color');
                if (loaderColor) {
                    $(".navigation-time .arrow").css("stroke", loaderColor);
                    $(".navigation-time .half_circle").css("border-top-color", loaderColor).css("border-left-color", loaderColor);
                } else {
                    $(".navigation-time .arrow").css("stroke", "");
                    $(".navigation-time .half_circle").css("border-top-color", "").css("border-left-color", "");
                }
                $(this).addClass("start");
            });
        });
        $('#banners-carousel').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            if (typeof nextSlide === 'undefined') {
                nextSlide = 0;
            }
            var nextSlideImg = $('#banners-carousel .slick-slide[data-slick-index="' + nextSlide + '"]');
            nextSlideImg.find('.banner-content-wrapper, .banner-button').show();
            var lazySlides = function (el, attr, lazyAttr) {
                nextSlideImg
                    .find(el)
                    .each(function (i, img) {
                        $img = $(img);
                        $img.attr(attr, $img.data(lazyAttr))
                    })
            };

            lazySlides('picture source[data-lazy-srcset]', 'srcset', 'lazy-srcset');
            lazySlides('img[data-lazy]', 'src', 'lazy');
        });

        $('#banners-carousel').css('margin-left', '0');
        $('#banners-carousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            autoplay: true,
            autoplaySpeed: sliderSpeed,
            pauseOnFocus: false,
            pauseOnHover: false,
            fade: true,
            arrows: true,
            prevArrow: "",
            nextArrow: $('#next-circle-wrapper'),
            cssEase: 'cubic-bezier(0.250, 0.250, 0.750, 0.750)',
            speed: 500,
            lazyLoad: false,
        });
    });

    (function ($) {
        $(document).ready(function () {
            // Parents added to set dots parallel with header
            var dotsBox = $('#banners-carousel ul');
            dotsBox.wrap("<div class='container'><div class='col'></div></div>");

            // Make slider image not clickable
            var sliderImage = $('.banner-slide span');
            sliderImage.on('click', function () {
                return false;
            });

            var sliderButtons = $('#banners-carousel li');
            var animatorIndex = 0;
            sliderButtons.each(function (index) {
                $(this).append('<div class="loading-animator animator-' + index + '"></div>');
            });

            var slickdotsWidth = $('.slick-dots li').width();

            var currentAnimator = $('.animator-1').animate({width: slickdotsWidth}, sliderSpeed + 50, "linear", function () {
                $(this).width(0);
            });

            $('#banners-carousel').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                currentAnimator.stop().width(0);
                animatorIndex = (nextSlide + 1) % 5;
                currentAnimator = $('.animator-' + animatorIndex).animate({width: slickdotsWidth}, sliderSpeed + 600, "linear", function () {
                    $(this).width(0);
                });
            });
        });

    })(jQuery);
</script>
