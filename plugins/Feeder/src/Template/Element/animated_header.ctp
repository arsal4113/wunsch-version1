<?= $this->Html->css('Feeder.animated-header-default.css') ?>
<?= $this->Html->css('Feeder.animated-header-animation.css') ?>

<?php // end-time preprocessing
$now = new DateTime();
$diff = isset($feederCategory) && is_object($feederCategory->animated_header_end_time) ? $feederCategory->animated_header_end_time->diff($now) : $now;
//var_dump('<pre>', $diff, '</pre>');
?>

<div id="animated-header" <?= isset($feederCategory) ? 'class="' . $feederCategory->animated_header_background_animation_type . '"' : '' ?>>
    <div class="animated-block first"></div>
    <div class="animated-block second"></div>
    <div class="animated-block third"></div>
    <div class="animated-block fourth"></div>
    <div class="text-wrapper">
        <h1 id="text-title" class="text"><?= isset($feederCategory) ? $feederCategory->animated_header_text_title : '' ?></h1>
        <h2 id="text-subtitle" class="text"><?= isset($feederCategory) ? $feederCategory->animated_header_text_subtitle : '' ?></h2>
    </div>
    <?php
    if (isset($diff->days) && isset($diff->h)) {
        $first_number = isset($diff->days) ? floor($diff->days / 10) : '';
        $second_number = isset($diff->days) ? ($diff->days % 10) : '';
        $third_number = isset($diff->h) ? floor($diff->h / 10) : '';
        $fourth_number = isset($diff->h) ? ($diff->h % 10) : '';
        ?>
        <div id="date-counter">
            <p><?= __('still') ?></p>
            <div>
                <span id="date-days-1" class="date-tile" <?php if ($first_number == 1) echo 'style="letter-spacing:1.5px"' ?>>&nbsp;<?= $first_number ?>&nbsp;</span>
                <span id="date-days-2" class="date-tile" <?php if ($second_number == 1) echo 'style="letter-spacing:1.5px"' ?>>&nbsp;<?= $second_number ?>&nbsp;</span>
                <p class="days-text"><?= __('days') ?></p>
            </div>
            <div>
                <span id="date-hours-1" class="date-tile" <?php if ($third_number == 1) echo 'style="letter-spacing:1.5px"' ?>>&nbsp;<?= $third_number ?>&nbsp;</span>
                <span id="date-hours-2" class="date-tile" <?php if ($fourth_number == 1) echo 'style="letter-spacing:1.5px"' ?>>&nbsp;<?= $fourth_number ?>&nbsp;</span>
                <p class="hours-text"><?= __('hours') ?></p>
            </div>
            <div>
                <p class="available-text"><?= __('available') ?></p>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<div id="world-image" style="<?= isset($feederCategory) ? "background-image:url('" . (strpos($feederCategory->animated_header_image, "http") !== false ? $feederCategory->animated_header_image : '/img/' . $feederCategory->animated_header_image) . "')" : '' ?>">
    <span id="world-title"><?= isset($feederCategory) ? $feederCategory->name : '' ?></span>
</div>
