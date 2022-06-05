<?php

/**
 * @var \Cake\View\Helper\UrlHelper $this ->Url
 */
?>

<div class="row category-hero-container">
    <div class="col-12">
        <div class="row">
            <?php /** @var \Feeder\Model\Entity\FeederCategory $feederCategory */
            $imageData = [
                'data-src' => $feederCategory->background ? $this->Url->image($feederCategory->background) : '',
            ];
            $image = (($feederCategory->background ? $this->Html->image($feederCategory->background, $imageData) : ''));
            ?>
            <div id="category-banner" <?= $feederCategory->background ? '' : 'class="empty-banner"' ?>>
                <div class="banner-wrapper" alt="<?= $feederCategory->background_alt_tag ?>" title="<?= $feederCategory->background_title_tag ?>" >
                    <?php if ($feederCategory->background) : ?>
                        <?php $image = $this->Html->image($feederCategory->background); ?>
                        <div class="row banner-text">
                            <div class="container">
                                <div class="title-wrapper">
                                    <?php if ($feederCategory->headline) : ?>
                                        <span class="category-banner-headline"><?= $feederCategory->headline ?></span>
                                    <?php endif; ?>
                                    <?php if ($feederCategory->caption) : ?>
                                        <br>
                                        <span class="category-banner-caption"><?= $feederCategory->caption ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <style>
                            .banner-wrapper {
                            <?php if ($feederCategory->background) : ?><?=  "background-image: url(" . $this->Url->image($feederCategory->background) . ");" ?><?php endif; ?>
                            }
                            .category-banner-headline {
                            <?= $feederCategory->headline_font_color ? 'color:' . $this->Feeder->parseColor($feederCategory->headline_font_color) . ';' : '' ?>
                            <?php if ($feederCategory->text_background_color) : ?>
                            <?=  'background-color: ' . $this->Feeder->color2rgba($feederCategory->text_background_color, $feederCategory->opacity) . ';' ?>
                            <?php endif; ?>
                            }
                            .category-banner-caption {
                            <?= $feederCategory->caption_font_color ? 'color:' . $this->Feeder->parseColor($feederCategory->caption_font_color) . ';' : '' ?>
                            <?php if ($feederCategory->text_background_color) : ?>
                            <?=  'background-color: ' . $this->Feeder->color2rgba($feederCategory->text_background_color, $feederCategory->opacity) . ';' ?>
                            <?php endif; ?>
                            }
                        </style>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
	<?= $this->cell('Feeder.MegaNavi') ?>
</div>

<script type="text/javascript">
    (function ($) {
        function isEmpty(el) {
            return !$.trim(el.html())
        }

        $(window).on('scroll resize load', function (e) {
            if (isEmpty($('.banner-wrapper'))) {
                // do nothing
                $('#category-banner').css('height', '0px');
            } else {
                if (($(window).width() < 850 && ($(window).innerWidth() > $(window).innerHeight())) || $(window).width() < 480) {
                    // Phone in landscape or portrait
                    $('#category-banner').css('height', '200px');
                } else if ($(window).width() < 1025) {
                    $('#category-banner').css('height', '250px');
                } else {
                    $('#category-banner').css('height', '320px');
                }
            }
        });
    }(jQuery));
</script>
