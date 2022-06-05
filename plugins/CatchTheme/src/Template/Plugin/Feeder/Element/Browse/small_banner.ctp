<?php /** @var \Feeder\Model\Entity\FeederHeroItem $smallBanner */ ?>

<?php $uniqueId = md5(time() . microtime()/*is_object($smallBanner) ? ($smallBanner->item_id . $smallBanner->title . $smallBanner->url) : (time() . microtime())*/) ?>

<div class="col-6 col-md-3 browse-col banner-col small-banner-col" id="<?= $uniqueId ?>" <?= $smallBanner->item_image_url ? 'data-item-img="' . $smallBanner->item_image_url . '"' : '' ?>>
    <div class="card">
        <a href="<?php echo $smallBanner->item_id ? $this->Url->build([
            'controller' => 'Products',
            'action' => 'view',
            'plugin' => 'Feeder',
            '?' => [
                'under' => $under,
                'upper' => $upper
            ],
            $smallBanner->item_id
        ]) : $smallBanner->url ?>">
            <?php if($smallBanner->webm || $smallBanner->mp4) : ?>
                <div class="card-img-wrapper">
                    <video class="lazyload" autoplay loop muted playsinline preload="">
                        <?php if ($smallBanner->webm) :?>
                            <source data-src="<?= $this->Url->image($smallBanner->webm) ?>" type="video/webm">
                        <?php endif; ?>
                        <?php if ($smallBanner->mp4) :?>
                            <source data-src="<?= $this->Url->image($smallBanner->mp4) ?>" type="video/mp4">
                        <?php endif; ?>
                    </video>
                </div>
            <?php else : ?>
                <div class="card-img-wrapper lazyload" alt="<?= $smallBanner->image_alt_tag ?>" title="<?= $smallBanner->image_title_tag ?>"
                    <?php
                    if(!empty($smallBanner->image ?? null)) {
                        echo 'data-bg="' . $this->Url->image($smallBanner->image) . '"';
                    }
                    ?>>
                </div>
            <?php endif; ?>
        </a>
    </div>
</div>

<script>
    var item_<?= $uniqueId ?> = document.getElementById('<?= $uniqueId ?>'),
        event = '<?= in_array($smallBanner->type, [3, 4]) ? 'quiz' : 'product' ?>';//'product';//'<?= $smallBanner->item_id ? 'product' : 'promotion' ?>';
    if (!productImpressions.hasOwnProperty('el_<?= $uniqueId ?>')) {
        productImpressions.el_<?= $uniqueId ?> = {
            el: document.getElementById('<?= $uniqueId ?>'),
            cb: function () {
                window.localStorage.setItem('pandata_heroitem_banner_type', 'small');
                window.localStorage.setItem('pandata_heroitem_banner_target', '<?= $smallBanner->item_id ?: $smallBanner->url ?>');
                pushEcommerce(event + 'Impression', processProductData(<?= json_encode($this->Feeder->filterProductData($smallBanner, 'Category')) ?>));
            }
        };
    }
    $('#<?= $uniqueId ?>').on('click', function (e) {//e.preventDefault();
        e.stopImmediatePropagation();
        window.localStorage.setItem('pandata_heroitem_banner_type', 'small');
        window.localStorage.setItem('pandata_heroitem_banner_target', '<?= $smallBanner->item_id ?: $smallBanner->url ?>');
        pushEcommerce(event + 'Click', [processProductData(<?= json_encode($this->Feeder->filterProductData($smallBanner, 'Category')) ?>)]);
    });
</script>
