<div class="row" id="similar-items-row">
    <?php foreach ($similarItems as $similarItem) : ?>
        <?php if (!isset($similarItem->image_url) && empty($similarItem->image_url)) {
            continue;
        } ?>
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <a href="<?= $this->Url->build([
                    'controller' => 'Products',
                    'action' => 'view',
                    'plugin' => 'Feeder',
                    $similarItem->item_id,
                    \Cake\Utility\Text::slug($similarItem->title)
                ]); ?>">
                    <?php /*if (isset($item->marketingPrice->discountPercentage) && $item->marketingPrice->discountPercentage) : ?>
                    <div class="item-discount-wrapper">
                        <span class="item-discount-percent">- <?= $item->marketingPrice->discountPercentage; ?>%</span>
                    </div>
                <?php endif; */?>
                    <div class="card-img-wrapper">
                        <img class="card-img-top" src="<?= $similarItem->image_url; ?>" alt="<?= h($similarItem->title); ?>">
                    </div>
                    <div class="card-body">
                        <p class="card-price">
                            <span class="item-price"><?= $similarItem->currency; ?> <?= $similarItem->price; ?></span>
                            <?php /*if (isset($item->marketingPrice)) : ?>
                            <span class="item-discount-price"><strike><?= $item->marketingPrice->originalPrice->currency; ?> <?= $item->marketingPrice->originalPrice->value; ?></strike></span>
                        <?php endif; */?>
                        </p>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
