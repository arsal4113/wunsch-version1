<?php

/**
 * @var \Cake\View\Helper\UrlHelper $this ->Url
 */
?>
<div id="customer-segmentation-wall" style="display:none;"></div>
<div style="display:none;" id="customer-segmentation-wrapper">
    <div class="container">
        <div class="customer-segmentation-holder">
            <div class="customer-segmentation-whiter">
                <div class="row">
                    <div class="col-12">
                        <div class="close"><?= $this->Html->image('Close.png'); ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2><?= __('What are you searching?'); ?></h2>
                    </div>
                </div>
                <div class="row customer-segement-categories">
                    <?php foreach ($feederCategories as $key => $feederCategory): ?>
                        <?php /** @var \Feeder\Model\Entity\FeederCategory $feederCategory */ ?>
                        <?php if (isset($feederCategory->child_feeder_categories[0]->id)) : ?>
                            <div class="col-6 col-xl-3 customer-segment-box">
                                <a class="customer-segment-link" href="<?= $this->Url->build([
                                    'controller' => 'Browse',
                                    'action' => 'view',
                                    'plugin' => 'Feeder',
                                    $feederCategory->child_feeder_categories[0]->id,
                                    \Cake\Utility\Text::slug($feederCategory->child_feeder_categories[0]->name)
                                ]); ?>"><?= $this->Html->image($feederCategory->image); ?><span
                                        class="customer-segment-name"><?= __($feederCategory->name); ?></span></a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#customer-segment-switch").click(function () {
        $("body").addClass('customer-segment-shown');
        $("#customer-segmentation-wall").fadeIn();
        $("#customer-segmentation-wrapper").fadeIn();
    });
    $("#customer-segmentation-wrapper .close").click(function () {
        $("body").removeClass('customer-segment-shown');
        $("#customer-segmentation-wall").fadeOut();
        $("#customer-segmentation-wrapper").fadeOut();
    });
    $("#customer-segmentation-wall").click(function () {
        $("body").removeClass('customer-segment-shown');
        $("#customer-segmentation-wall").fadeOut();
        $("#customer-segmentation-wrapper").fadeOut();
    });
</script>
