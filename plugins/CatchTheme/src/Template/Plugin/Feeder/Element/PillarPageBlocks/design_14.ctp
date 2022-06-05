<div class="row design-14">
    <div class="col-12">
        <?= $config->headline ?>
        <p class="subtitle"><?= $config->subtitle ?></p>
        <div class="content"><?= $config->text ?></div>
        <?php if(isset($config->buttonLink) && isset($config->buttonText)): ?>
            <div class="button-wrapper">
                <a href="<?= $config->buttonLink ?>" class="redesign-button"><?= $config->buttonText ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>
