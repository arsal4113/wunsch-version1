<?php /** @var \Feeder\Model\Entity\FeederHeroItem $largeBanner */ ?>

<?php $uniqueId = md5(time() . microtime()/*is_object($largeBanner) ? ($largeBanner->item_id . $largeBanner->title . $largeBanner->url) : (time() . microtime())*/) ?>

<div class="col-12 col-md-6 browse-col-2 banner-col large-banner-col" id="<?= $uniqueId ?>" <?= $largeBanner->item_image_url ? 'data-item-img="' . $largeBanner->item_image_url . '"' : '' ?>>
    <div class="card">
        <a href="<?php echo $largeBanner->item_id ? $this->Url->build([
            'controller' => 'Products',
            'action' => 'view',
            'plugin' => 'Feeder',
            '?' => [
                'under' => $under,
                'upper' => $upper
            ],
            $largeBanner->item_id
        ]) : $largeBanner->url ?>">
            <?php if($largeBanner->webm || $largeBanner->mp4) : ?>
                <div class="card-img-wrapper">
                    <video class="lazyload" autoplay loop muted playsinline  preload="">
                        <?php if ($largeBanner->webm) :?>
                            <source data-src="<?= $this->Url->image($largeBanner->webm) ?>" type="video/webm">
                        <?php endif; ?>
                        <?php if ($largeBanner->mp4) :?>
                            <source data-src="<?= $this->Url->image($largeBanner->mp4) ?>" type="video/mp4">
                        <?php endif; ?>
                    </video>
                </div>
            <?php else : ?>
                <div class="card-img-wrapper lazyload" alt="<?= $largeBanner->image_alt_tag ?>" title="<?= $largeBanner->image_title_tag ?>"
                <?php
                    if(!empty($largeBanner->image ?? null)) {
                        echo 'data-bg="' . $this->Url->image($largeBanner->image) . '"';
                    }
                ?>>
                </div>
            <?php endif; ?>
        </a>
    </div>
</div>

<script>
    var item_<?= $uniqueId ?> = document.getElementById('<?= $uniqueId ?>'),
        event = '<?= in_array($largeBanner->type, [3, 4]) ? 'quiz' : 'product' ?>';//'product';//'<?= $largeBanner->item_id ? 'product' : 'promotion' ?>';
    if (!productImpressions.hasOwnProperty('el_<?= $uniqueId ?>')) {
        productImpressions.el_<?= $uniqueId ?> = {
            el: document.getElementById('<?= $uniqueId ?>'),
            cb: function () {
            	window.localStorage.setItem('pandata_heroitem_banner_type', 'large');
        		window.localStorage.setItem('pandata_heroitem_banner_target', '<?= $largeBanner->item_id ?: $largeBanner->url ?>');
                pushEcommerce(event + 'Impression', processProductData(<?= json_encode($this->Feeder->filterProductData($largeBanner, 'Category')) ?>));
            }
        };
    }
    $('#<?= $uniqueId ?>').on('click', function (e) {//e.preventDefault();
        e.stopImmediatePropagation();
        window.localStorage.setItem('pandata_heroitem_banner_type', 'large');
        window.localStorage.setItem('pandata_heroitem_banner_target', '<?= $largeBanner->item_id ?: $largeBanner->url ?>');
        pushEcommerce(event + 'Click', [processProductData(<?= json_encode($this->Feeder->filterProductData($largeBanner, 'Category')) ?>)]);
    });
</script>
