<?php if (isset($config->buttonLink) && !isset($config->buttonText)):  ?>
<a href="<?= $config->buttonLink ?>" class="row design-13" style="background-image: url('<?= $this->Url->image($config->imageUrl) ?>')">
<?php else: ?>
<div class="row design-13" style="background-image: url('<?= $this->Url->image($config->imageUrl) ?>')">
<?php endif; ?>
    <div class="col-12">
        <div class="headline-wrapper">
            <div class="headline">
                <span style="<?= isset($config->textBackgroundColor) ? 'background: ' . $config->textBackgroundColor . ';' : '' ?>
                <?= isset($config->color) ? 'color: ' . $config->color . ';' : ''?>"><?= $config->headline ?></span>
            </div>
            <div class="headline">
                <span style="<?= isset($config->textBackgroundColor) ? 'background: ' . $config->textBackgroundColor . ';' : '' ?>
                <?= isset($config->color) ? 'color: ' . $config->color . ';' : ''?>"><?= $config->headlineSecondRow ?></span>
            </div>
        </div>
        <?php if(isset($config->buttonLink) && isset($config->buttonText)): ?>
            <a href="<?= $config->buttonLink ?>" style="<?= isset($config->buttonTextColor) ? 'color: ' . $config->buttonTextColor . ';' : '' ?>
            <?= isset($config->buttonBackgroundColor) ? 'background: ' . $config->buttonBackgroundColor . ';' : ''?>" class="redesign-button"><?= $config->buttonText ?></a>
        <?php endif; ?>
    </div>
<?php if (isset($config->buttonLink) && !isset($config->buttonText)):  ?>
</a>
<?php else: ?>
</div>
<?php endif; ?>
