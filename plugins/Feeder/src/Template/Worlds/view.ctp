<?php

/** @var \Feeder\Model\Entity\FeederHomepage $feederHomepage */

$this->Html->css('jquery-ui', ['block' => true]);
$this->Html->css('Feeder.homepage' . STATIC_MIN, ['block' => true]);

$this->start('content-fluid');

$this->assign('title', h($metaTitle ?? ''));
$this->assign('description', h($metaDescription ?? ''));
?>

<!-- Homepage Contents-->
<div id="worlds-homepage-contents" class="container-fluid">
    <div class="row">
	    <?= $this->cell('Feeder.MegaNavi') ?>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 orange-worlds-header">
                <h1><?= !empty($headline) ? $headline : __('CATCH Magazin') ?></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="worlds" class="row">
            <div class="col-6 col-md-4">
                <div class="worlds-column">
                    <?php foreach ($feederWorldFirst as $feederWorld) : ?>
                        <?php /** @var \Feeder\Model\Entity\FeederWorld $feederWorld */ ?>
                        <div class="worlds-category-box">
                            <a href="<?= $feederWorld->link ?>">
                                <div class="worlds-category-image">
                                    <?= $this->Html->image($feederWorld->image, ['alt' => $feederWorld->image_alt_tag ?? '', 'title' => $feederWorld->image_title_tag ?? '']); ?>
                                </div>
                                <div class="worlds-category-text" lang="de">
                                    <p><?= $feederWorld->name ?></p>
                                </div>
                                <div class="discover-button">
                                    <span><?= $feederWorld->button_text ? $feederWorld->button_text : __('discover') ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="worlds-column">
                    <?php foreach ($feederWorldSecond as $feederWorld) : ?>
                        <?php /** @var \Feeder\Model\Entity\FeederWorld $feederWorld */ ?>
                        <div class="worlds-category-box">
                            <a href="<?= $feederWorld->link ?>">
                                <div class="worlds-category-image">
                                    <?= $this->Html->image($feederWorld->image, ['alt' => $feederWorld->image_alt_tag ?? '', 'title' => $feederWorld->image_title_tag ?? '']); ?>
                                </div>
                                <div class="worlds-category-text" lang="de">
                                    <p><?= $feederWorld->name ?></p>
                                </div>
                                <div class="discover-button">
                                    <span><?= $feederWorld->button_text ? $feederWorld->button_text : __('discover') ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="worlds-column-right">
                    <?php foreach ($feederWorldThird as $feederWorld) : ?>
                        <?php /** @var \Feeder\Model\Entity\FeederWorld $feederWorld */ ?>
                        <div>
                            <div class="worlds-category-box">
                                <a href="<?= $feederWorld->link ?>">
                                    <div class="worlds-category-image">
                                        <?= $this->Html->image($feederWorld->image, ['alt' => $feederWorld->image_alt_tag ?? '', 'title' => $feederWorld->image_title_tag ?? '']); ?>
                                    </div>
                                    <div class="worlds-category-text" lang="de">
                                        <p><?= $feederWorld->name ?></p>
                                    </div>
                                    <div class="discover-button">
                                        <span><?= $feederWorld->button_text ? $feederWorld->button_text : __('discover') ?></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>

<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {

            $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});

            // class homepage is added to body to show header like other pages
            $('body').addClass('homepage').trigger('resize');
            // Adds and removes class in third column depending on screen width.
            function columnClass() {
                if ($(window).width() < 768) {
                    $('div.worlds-column-right > div').addClass('column-wrap');
                    $('#worlds').children().last().removeClass('col-6 col-md-4');
                }
                else {
                    $('div.worlds-column-right > div').removeClass('column-wrap');
                    $('#worlds').children().last().addClass('col-6 col-md-4');
                }
            }
            columnClass();
        });
    })(jQuery);
</script>
