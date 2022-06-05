<?php $this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true, 'media' => 'all']); ?>
<?php $this->assign('title', 'Produkt ' . ($itemId ?? '') . ' nicht gefunden'); ?>
<?php $this->assign('robotTag', 'noindex, follow'); ?>

<div class="col-12 product-unknown-banner">
    <div class="top-message-container">
        <div class="message-wrapper top">
            <span>Sorry, du warst zu langsam &#128012;</span>
        </div><br>
        <div class="message-wrapper">
            <span>Das Produkt ist ausverkauft.</span>
        </div>
    </div>
    <div class="content-container">
        <?= $this->Html->image('skateboards.png', ['class' => 'skateboard-image', 'alt' => 'skateboard']); ?>
        <div class="text-wrapper">
            <p class="text">Catch dir unsere flottesten Produkte, um beim nächsten Mal schneller zu sein</p>
            <?= $this->Html->link('Hier lang', '/') ?>
        </div>
    </div>
</div>
<script>
    $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
</script>
