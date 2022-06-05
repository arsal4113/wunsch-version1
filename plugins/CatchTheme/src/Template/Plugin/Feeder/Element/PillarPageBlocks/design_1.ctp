<div class="row design-1" style="background: <?= $config->color ?>">
    <div class="col-12 text-content">
        <?= $config->headline ?>
        <div class="textfield"><?= $config->text ?></div>
        <?php if(isset($config->buttonLink) && isset($config->buttonText)): ?>
            <a href="<?= $config->buttonLink ?>" class="redesign-button"><?= $config->buttonText ?></a>
        <?php endif; ?>
    </div>
    <?= $this->Html->image($config->imageUrl, ['class' => 'background-image', 'alt' => 'background']) ?>
</div>
