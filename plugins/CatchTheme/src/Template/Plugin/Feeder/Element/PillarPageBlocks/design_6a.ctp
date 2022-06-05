<?= $this->Html->script('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]); ?>
<div class="col-lg-6 col-12 design-6a block-<?= $blockKey ?>">
    <?php
    foreach($config->itemIds as $key => $item){
        if($key === 6) break;
        $itemId = $item->item_id;
        if(!empty($item->item_group_id)){
            $itemId = $item->item_group_id;
        }
        if($key === 0) echo '<div class="left-item-column">';
        echo '<div class="item-wrapper">' .
            '<a href="' . $this->Url->build([
                'controller' => 'Products',
                'action' => 'view',
                'plugin' => 'Feeder',
                $itemId,
                \Cake\Utility\Text::slug($item->title)
            ]) .'">' .
            $this->Html->image($item->image_url, ['class' => 'item-image', 'alt' => 'mood-image']);
        echo $this->element('ItoolCustomer.wishlist_link', ['wishlistItems' => $wishlistItems, 'itemId' => $itemId, 'categoryId' => $item->category_id]);

        echo '</a></div>';
        if($key === 2){
            echo '</div>';
            echo '<div class="right-item-column">';
        }
        if($key === 5 || $key === count($config->itemIds) - 1) echo '</div>';
    }
    ?>
    <div id="mobile-product-slider">
        <?php foreach($config->itemIds as $key => $item) {
            $itemId = $item->item_id;
            if (!empty($item->item_group_id)) {
                $itemId = $item->item_group_id;
            }
            echo '<div class="item-wrapper">' .
                '<a href="' . $this->Url->build([
                    'controller' => 'Products',
                    'action' => 'view',
                    'plugin' => 'Feeder',
                    $itemId,
                    \Cake\Utility\Text::slug($item->title)
                ]) . '">' .
                $this->Html->image($item->image_url, ['class' => 'item-image', 'alt' => 'mood-image']);
            echo $this->element('ItoolCustomer.wishlist_link', ['wishlistItems' => $wishlistItems, 'itemId' => $itemId, 'categoryId' => $item->category_id]);
            echo '</a></div>';
        }
        ?>
    </div>
    <script>
        $(function () {
            $(document).ready(function () {
                $('.design-6a.block-<?= $blockKey ?> #mobile-product-slider').slick({
                    infinite: false,
                    arrows: false,
                    slidesToShow: 1,
                    initialSlide: 1,
                    variableWidth: true,
                    centerPadding: "0",
                    centerMode: true,
                    lazyLoad: 'ondemand'
                });
            });
        });
    </script>
</div>
