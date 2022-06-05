<?php
$itemsPerRow = 6;
?>
<div class="container" id="customer-segment-row">
    <div class="row">
        <div class="col-6 col-sm-12">
            <h3><?= __('What are you searching?'); ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 sick-slide-wrapper">
            <div id="customer-segment-carousel">
                <?php foreach ($feederCategories as $key => $feederCategory): ?>
                    <?php /** @var \Feeder\Model\Entity\FeederCategory $feederCategory */ ?>
                    <?php if (isset($feederCategory->child_feeder_categories[0]->id)) : ?>
                        <div class="customer-segment-box">
                            <a class="customer-segment-link" href="<?= $this->Url->build([
                                'controller' => 'Browse',
                                'action' => 'view',
                                'plugin' => 'Feeder',
                                $feederCategory/*->child_feeder_categories[0]*/->id,
                                \Cake\Utility\Text::slug($feederCategory/*->child_feeder_categories[0]*/->name)
                            ]); ?>"><?= $this->Html->image($feederCategory->image, ['alt' => $feederCategory->image_alt_tag, 'title' => $feederCategory->image_title_tag]); ?><span
                                    class="customer-segment-name"><?= __($feederCategory->name); ?></span></a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#customer-segment-carousel').slick({
            slidesToShow: 6,
            slidesToScroll: 6,
            responsive: [
                {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
    });
</script>
