<script>
    pandata.pageType = 'product';
</script>

<?php

$canonicalLink = $this->Url->build([
    'controller' => 'Products',
    'action' => 'view',
    'plugin' => 'Feeder',
    $ebayItem['parent_id'],
    \Cake\Utility\Text::slug($ebayItem['title'])
], true);

$this->assign('canonicalLink', $canonicalLink);

$this->assign('productMarkup', $this->cell('Feeder.ProductMarkup', ['ebayItem' => $ebayItem]));
if (!empty($ebayItem['title'])) {
    $suffix = ' günstig kaufen | CATCH';
    $maxTitleLength = 67;

    $titleWords = array_map('trim', explode(' ', $ebayItem['title']));
    $title = '';

    foreach ($titleWords as $titleWord) {
        if (strlen($title) + strlen($titleWord) + strlen($suffix) < $maxTitleLength) {
            $title .= ((empty($title)) ? '' : ' ') . $titleWord;
        } else {
            $title .= $suffix;
            break;
        }
    }

    $suffix = ' online kaufen auf CATCH ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler ► Jetzt entdecken';
    $description = '';
    $maxDescriptionLength = 155;
    foreach ($titleWords as $titleWord) {
        if (strlen($description) + strlen($titleWord) + strlen($suffix) < $maxDescriptionLength) {
            $description .= ((empty($description)) ? '' : ' ') . $titleWord;
        } else {
            $description .= $suffix;
            break;
        }
    }

    $this->assign('title', $title);
    $this->assign('description', $description);
}


/** @var \Feeder\Model\Entity\FeederHomepage $feederHomepage */

$this->Html->css('Feeder.browse' . STATIC_MIN, ['block' => true, 'media' => 'all']);
$this->Html->css('Feeder.product' . STATIC_MIN, ['block' => true, 'media' => 'all']);
if (!STATIC_MIN) {
    $this->Html->script('Feeder.product', ['block' => true]);
    $this->Html->script('slick', ['block' => true]);
    $this->Html->script('jquery.ui.touch-punch.min', ['block' => true]);
}

$formAction = $this->Url->build([
    'controller' => 'EbayCheckoutSessions',
    'action' => 'addItem',
    'plugin' => 'EbayCheckout',
    'uuid' => $coreSeller->uuid
]);

/** fix for items with descriptions that are not properly UTF-8 encoded (CIW-579) */
$ebayItem['description'] = mb_convert_encoding($ebayItem['description'], 'UTF-8', 'UTF-8');

$price = 999999999;
for ($x = 0; $x < count($items); $x++) {
    if (floatval($items[$x]['price']['amount']) < $price && $items[$x]['quantity'] != 0) {
        $price = floatval($items[$x]['price']['amount']);
        $currency = $items[$x]['price']['currency'];
    }
}

if ($shippingArray) {
    $min = new \Cake\I18n\Time($shippingArray['minDate']);
    $max = new \Cake\I18n\Time($shippingArray['maxDate']);
    $shippingDateMin = $min->i18nFormat("dd. MMM");
    $shippingDateMax = $max->i18nFormat("dd. MMM");
} else {
    $shippingDateMin = '';
    $shippingDateMax = '';
}
?>
<script>
    var processed_product_data = processProductData(<?= json_encode($this->Feeder->filterProductData((object)($ebayItem + ['base_price' => $price]))) ?>);
</script>
<?= $this->cell('Feeder.SimilarItems::json', [$ebayItem['category_id'], 15]); ?>
<?= $this->cell('Feeder.TopSoldItems::json', [$wishlistItems, explode('|', $ebayItem['category_path'])[0]]) ?>
<script>
    window.ebayItem = <?= json_encode($ebayItem) ?>;
    window.optionAvailable = <?= json_encode((object) $optionAvailable) ?>;
    window.attributeArray = <?= json_encode($attributeArray) ?>;
    window.formAction = <?= json_encode($formAction) ?>;
    window.ebayGlobalId = '<?= $ebayGlobalId ?>';
    window.countryCode = '<?= $countryCode ?>';
    window.widgetType = '<?= $widgetType ?>';
    window.wrapperLayout = '<?= $wrapperLayout ?>';
    window.shippingDate = <?= json_encode([$shippingDateMin, $shippingDateMax]) ?>;
    window.shortDescription = <?= json_encode($ebayItem['items'][0]['short_description']) ?>;
    window.canonicalLink = <?= json_encode($canonicalLink) ?>;
    window.breadcrumb = <?= json_encode($breadcrumbs) ?>;
    window.wishlistLink = <?= json_encode($this->element('ItoolCustomer.wishlist_link',
        ['wishlistItems' => $wishlistItems, 'itemId' => $itemId, 'categoryId' => $ebayItem['category_id']])); ?>;
    window.checkoutUrl = '<?= $checkoutUrl ?>';
    window.cartUrl = '<?= $cartUrl ?>';
    window.wishlistItems = <?= json_encode($wishlistItems) ?>;
    window.loadMoreBestsellingItemsUrl = '<?= $loadMoreBestsellingItemsUrl ?>';
    window.itemId = <?= json_encode($itemId) ?>;
</script>
<div class="col-12" id="vip"></div>
<?php
echo $this->React->script('vendor.js');
echo $this->React->script('vip.js');
?>
<script type="text/javascript">
    pushEcommerce('productDetail', [processed_product_data]);
    // i-ways GTM tracking helper

    push2dataLayer({
        ecomm_prodid: '<?= $itemId ?>',
        ecomm_pagetype: 'ViewContent',
        ecomm_totalvalue: <?= $price ?>,
        ecomm: {
            ecomm_prodid: '<?= $itemId ?>',
            ecomm_pagetype: 'ViewContent',
            ecomm_totalvalue: <?= $price ?>
        }
    });

    // webExtend
    ScarabQueue.push(['view', '<?= str_replace("|", "%7C", $itemId) ?>']);

    $('.mini-cart-wrapper').on('success', function (e) // i-ways GTM tracking helper
    {
        var data = <?= json_encode($this->Feeder->filterProductData((object)$ebayItem)) ?>,
            buy_button = $('#add-to-cart');
        data.dimension17 = data.itemVrtnId = buy_button.data('id');
        data.price = parseFloat(buy_button.data('price'));
        data.quantity = parseFloat($('.quantity-selector .quantity.number').text());
        pushEcommerce('addToCart', [processProductData(data)]);

        push2dataLayer({
            ecomm_prodid: data.itemVrtnId,
            ecomm_pagetype: 'AddToCart',
            ecomm_totalvalue: data.price,
            ecomm: {
                ecomm_prodid: data.itemVrtnId,
                ecomm_pagetype: 'AddToCart',
                ecomm_totalvalue: data.price
            }
        });
    });

    // Alert message design if scrolled
    $(window).scroll(function () {
        let scrolled = $(window).scrollTop(),
            orangeMessageHeight = parseInt($('.orange-message').css('height'));

        if (scrolled >= orangeMessageHeight) {
            $('.to-many-items-alert .alert.alert-danger.alert-dismissable').css('z-index', 9);
        } else {
            $('.to-many-items-alert .alert.alert-danger.alert-dismissable').css('z-index', '');
        }
    });

    // Mobile checkout popup close
    $('.mobile-checkout-popup, .mobile-checkout-popup .popup-close').on('click', function(e) {
        if (e.target !== this)
            return;
        $('.mobile-checkout-popup').hide();
    });

</script>
