<?php

/** @var \Feeder\Model\Entity\FeederHomepage $feederHomepage */

$this->Html->css('jquery-ui', ['block' => true, 'media' => 'all']);
$this->Html->css('Feeder.homepage' . STATIC_MIN, ['block' => true, 'media' => 'all']);

$this->start('content-fluid');
?>

<?php $this->assign('title', __('Worlds')); ?>
<?php $this->assign('description', __('Worlds of Catch')) ?>

<div id="banners-carousel" class="container-fluid slick-slider">
    <div class="slick-list">
        <div id="test" class="banner-slide">
            <span class="worlds-banner" style="background-image:url('<?= $this->Url->image($headerImage) ?>')"></span>
        </div>
    </div>
</div>

<!-- Homepage Contents-->
<div id="worlds-homepage-contents" class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 orange-worlds-header">
                <h2><?= __('Alle Welten von Catch') ?></h2>
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
                            <div class="worlds-category-image">
                                <?= $this->Html->image($feederWorld->image); ?>
                            </div>
                            <div class="worlds-category-text">
                                <p><?= $feederWorld->name ?></p>
                            </div>
                            <div class="discover-button">
                                <a href="<?= $feederWorld->link ?>"><?= __('discover') ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="worlds-column">
                    <?php foreach ($feederWorldSecond as $feederWorld) : ?>
                        <?php /** @var \Feeder\Model\Entity\FeederWorld $feederWorld */ ?>
                        <div class="worlds-category-box">
                            <div class="worlds-category-image">
                                <?= $this->Html->image($feederWorld->image); ?>
                            </div>
                            <div class="worlds-category-text">
                                <p><?= $feederWorld->name ?></p>
                            </div>
                            <div class="discover-button">
                                <a href="<?= $feederWorld->link ?>"><?= __('discover') ?></a>
                            </div>
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
                                <div class="worlds-category-image">
                                    <?= $this->Html->image($feederWorld->image); ?>
                                </div>
                                <div class="worlds-category-text">
                                    <p><?= $feederWorld->name ?></p>
                                </div>
                                <div class="discover-button">
                                    <a href="<?= $feederWorld->link ?>"><?= __('discover') ?></a>
                                </div>
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

                // class homepage is added to body to show header like other pages
                $('body').addClass('homepage');

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

                // And recheck when window gets resized.
                $(window).on('resize',function() {
                    columnClass();
                });
            }
        );
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    })(jQuery);
</script>
