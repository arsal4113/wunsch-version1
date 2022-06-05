<div class="product-iteminfo">
        <?php
        if (isset($ebayItem['items'])) {
            $attributes = $ebayItem['items'][0]['attributes']; ?>

        <?php foreach ($attributes as $attribute) { ?>
            <dl>
            <?php if (isset($attribute['name'])) { ?>
                    <dt>
                    <?= '<span class="attributes-name">' . $attribute['name'] . ':</span> ' ?>
                    </dt>
                <?php
                }
                if (isset($attribute['value'])) { ?>
                    <dd>
                    <?= '<span class="attributes-value">' . $attribute['value'] . '</span> ' ?>
                    </dd>
                <?php
                } ?>
            </dl>
            <?php }
        } else echo __("No location specified.");
        ?>

</div>
