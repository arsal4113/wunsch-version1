<?php

/**
 * @var \Cake\View\Helper\UrlHelper $this ->Url
 */
?>
<div id="customer-segmentation-slider">
<div id="customer-segmentation-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?= __('What are you searching?'); ?></h2>
            </div>
        </div>
        <div class="customer-segmentation-holder">
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
