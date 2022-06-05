<?php /** @var \Feeder\Model\Entity\FeederUspBar $feederUspBar */ ?>
<?php if ($uspIsActive ?? true) : ?>
<div class="col-12 orange-message" id="orange-message-container">
    <ul id="orange-message-list">
        <?php  if (isset($feederUspBars)) : ?>
            <?php foreach ($feederUspBars as $feederUspBar ) : ?>
                <li class="orange-message-item"><span class="text-wrapper"><?= $feederUspBar -> usp_text ?></span></li>
            <?php endforeach; ?>
        <?php endif ?>
    </ul>
</div>
<style>
    #header .orange-message {
        <?= isset($uspFontColor) ? 'color:' . $this->Feeder->parseColor($uspFontColor) . ';' : '' ?>
        <?= isset($uspBackgroundColor) ? 'background-color:' . $this->Feeder->parseColor($uspBackgroundColor) . ';' : '' ?>
    }
    #header .orange-message ul#orange-message-list li a {
        <?= isset($uspFontColor) ? 'color:' . $this->Feeder->parseColor($uspFontColor) . ';' : '' ?>
    }
</style>
<script>
    document.body.classList.add('orange-message-shown');
</script>
<?php endif ?>
