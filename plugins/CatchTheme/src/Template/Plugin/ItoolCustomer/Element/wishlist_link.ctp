<?php

$wishlist_check = (isset($wishlistItems[$itemId]));

$action = $wishlist_check ? 'remove' : 'add';

$url_remove = $this->Url->build([
    'controller' => 'Account',
    'action' => 'wishlistRemove',
    'plugin' => 'ItoolCustomer',
    $itemId
]);

$url_add = $this->Url->build([
    'controller' => 'Account',
    'action' => 'wishlistAdd',
    'plugin' => 'ItoolCustomer',
    $itemId
]);

$url = $wishlist_check ? $url_remove : $url_add;
$label = $wishlist_check ? 'Remove from wishlist' : 'On the wish list';

?>

<a class="wishlist-item-link <?php echo $action ?> <?= isset($linkLabel) ? 'no-animation' : '' ?> <?= isset($locationClass) ? $locationClass : '' ?>" href="<?php echo $url ?>"
   data-href-remove="<?php echo $url_remove ?>"
   data-href-add="<?php echo $url_add ?>"
   <?php if (!$wishlist_check) echo 'data-item-id="' . $itemId . '"' ?>
   data-category-id="<?php echo (isset($categoryId) ? $categoryId : 'WishList') ?>">
    <?= isset($linkLabel)
        ? __($label)
        : '<span class="wishlist-icon ' . $action . '"></span>' ?>
</a>
