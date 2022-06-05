<div class="row" id="surprise-item-row">
<?php foreach ($items as $item) : ?>
    <?php if (!isset($item->image_url) && empty($item->image_url)) {
        continue;
    } ?>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <a href="<?= $this->Url->build([
                'controller' => 'Products',
                'action' => 'view',
                'plugin' => 'Feeder',
                $item->item_id,
                \Cake\Utility\Text::slug($item->title)
            ]); ?>">
                <?php /*if (isset($item->marketingPrice->discountPercentage) && $item->marketingPrice->discountPercentage) : ?>
                    <div class="item-discount-wrapper">
                        <span class="item-discount-percent">- <?= $item->marketingPrice->discountPercentage; ?>%</span>
                    </div>
                <?php endif; */?>
                <div class="card-img-wrapper">
                    <img class="card-img-top" src="<?= $item->image_url; ?>" alt="<?= h($item->title); ?>">
                </div>
                <div class="card-body">
                    <p class="card-price">
                        <span class="item-price"><?= $item->currency; ?> <?= $item->price; ?></span>
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
