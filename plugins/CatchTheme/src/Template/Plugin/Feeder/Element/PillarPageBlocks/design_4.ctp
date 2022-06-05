<div class="row design-4">
    <div class="col-lg-6 col-12 text-content">
        <?= $config->headline ?>
        <p class="subtitle"><?= $config->subtitle ?></p>
        <div class="textfield"><?= $config->text ?></div>
        <?php if(isset($config->buttonLink) && isset($config->buttonText)): ?>
            <a href="<?= $config->buttonLink ?>" class="redesign-button"><?= $config->buttonText ?></a>
        <?php endif; ?>
    </div>
    <?= $this->Html->image($config->imageUrl, ['class' => 'mood-image', 'alt' => 'mood-image']) ?>
</div>
