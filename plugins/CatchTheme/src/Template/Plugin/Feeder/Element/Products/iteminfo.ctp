<div class="product-iteminfo">
    <p>
        <strong><?= __("Item location") ?></strong><br />
        <?php
        if (isset($ebayItem['items'][0]['location'])) {
            $location = $ebayItem['items'][0]['location'];
            ?>
            <?= $location['city'] . ', ' . $location['country'] ?>
            <?php
        } else echo __("No location specified.");
        ?>
    </p>
</div>
