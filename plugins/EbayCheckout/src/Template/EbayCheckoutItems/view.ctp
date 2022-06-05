<?php $currencies = array('USD' => '$', 'GBP' => '£', 'EUR' => '€') ?>

<script type="text/javascript">
    /**
     * resizes the iFrame to fit its content.
     *
     * @param obj - The iFrame Object
     */
    function resizeIframe(obj){
        obj.style.height = (obj.contentWindow.document.body.scrollHeight + 30) + 'px';
    }
</script>

<div class="content-wrapper">
    <div class="item-info-controls">
        <div class="top">
            <?= $this->Html->image('EbayCheckout.ebay_fashion_tm_rgb.svg',
                ['alt' => 'eBay Checkout', 'class' => 'ebay-logo']); ?>
            <h4 class="page-description"></h4>
        </div>
        <div class="product">
            <div class="title-rating-wrapper">
                <h2 class="item-title"><?php if(isset($ebayItem['title'])){ echo h($ebayItem['title']);}else{echo __('Unknown Item');} ?></h2>
                <div class="rating">
                    <?php if ($ratingCount){ ?>
                        <div class="stars">
                            <?php
                            $avgRating = floatval($ebayItem['rating']['avg_rating']);
                            for ($x = 0; $x < 5; $x++) {
                                if ($avgRating >= 1) {
                                    echo $this->Html->image(
                                        'full-star.svg',
                                        [
                                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                            'alt' => 'full star',
                                            'class' => 'star star-' . $x
                                        ]);
                                    $avgRating -= 1;
                                } else if ($avgRating >= 0.5) {
                                    echo $this->Html->image(
                                        'half-star.svg',
                                        [
                                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                            'alt' => 'half star',
                                            'class' => 'star star-' . $x
                                        ]);
                                    $avgRating = 0;
                                } else {
                                    echo $this->Html->image(
                                        'empty-star.svg',
                                        [
                                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                            'alt' => 'empty star',
                                            'class' => 'star star-' . $x
                                        ]);
                                }
                            }?>
                        </div>
                        <div class="product-ratings">
                            <p>
                                <a id="scrollable"
                                   href="#item-review-section">
                                    <?php
                                    $ratingString = "product rating";
                                    if($ratingCount !== 1){
                                        $ratingString = \Cake\Utility\Inflector::pluralize($ratingString);
                                    }
                                    $ratingString = $ratingCount . ' ' . __($ratingString);
                                    echo h($ratingString);
                                    ?></a>
                            </p>
                        </div>
                    <?php } else {?>
                        <p><?= __('We have no ratings yet.')?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="product-images">
                <div class="product-image-container">
                    <table class="big-image">
                        <tr>
                            <td>
                                <?php if(!empty($images)){ echo '<img class="product-image" src="' . $images[0]['imageArray']['imgUrl'] . '">';}else{echo __('Invalid Item!');}?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div class="mini-images">
                        <div class="image-counter"><span class="image-counter-span"></span></div>
                        <?php echo $this->Html->image('EbayCheckout.blue-arrow-left.svg',
                            ['alt' => 'scroll left', 'id' => 'previous-button']);?>
                        <div class="mini-image-wrapper">
                            <ul id="image-list">
                            <?php if (!empty($images)) {
                                for ($x = 0; $x < count($images); $x++) { ?>
                                <li class="mini-image-container" id="container-<?php echo $x ?>">
                                    <img id="product-image-<?php echo $x ?>" class="mini-image"
                                         src="<?= h($images[$x]['imageArray']['imgUrl']) ?>">
                                </li><?php }
                            }?>
                            </ul>
                        </div>
                        <?php echo $this->Html->image('EbayCheckout.blue-arrow-right.svg',
                        ['alt' => 'scroll right', 'id' => 'next-button']);?>
                    </div>
                </div>
            </div>
            <div class="product-info">
                <form method="post" action="<?= $this->Url->build(
                    [
                        'controller' => 'EbayCheckoutSessions',
                        'action' => 'addItem',
                        'plugin' => 'EbayCheckout',
                        'uuid' => $uuid
                    ]
                ); ?>">
                    <div class="shop-inputs">
                        <table class="product-user-input-table">
                            <?php
                            if (isset($ebayItem['configurable_attributes'])) {
                                foreach ($ebayItem['configurable_attributes'] as $confAttrKey => $confAttrItem) {
                                    ?>
                                    <tr>
                                    <td><?= h($confAttrKey) ?>:</td>
                                    <td>
                                        <select id="attr-<?= h(strtolower(preg_replace('/\s+/', '-', $confAttrKey))); ?>"
                                                title="<?= h($confAttrKey) ?>"
                                                class="slim-border border-radius attribute-select select-ie-fix"
                                                data="unselected">
                                            <option value=""><?=__('- Select -') ?></option>
                                            <?php
                                            for($a = 0; $a < count($confAttrItem); $a++){
                                                $unproblemizing = str_replace('"', '', $confAttrItem[$a]);
                                                if($optionAvailable[$confAttrItem[$a]]){
                                                    echo '<option value="' . $unproblemizing . '">' .  $confAttrItem[$a] .'</option>';
                                                }else{
                                                    echo '<option value="' . $unproblemizing . '" disabled>' .  $confAttrItem[$a] . ' [out of stock]</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    </tr><?php }
                            } ?>
                                <tr>
                                <td><?= __('Qty:') ?></td>
                                <td>
                                    <select title="Quantity" name="qty" class="slim-border border-radius qty-select select-ie-fix">
                                        <?php
                                        $soldQuantity = 0;
                                        $availableQuantity = 0;
                                        for($y = 0; $y < count($items); $y++){
                                            $soldQuantity += $items[$y]['sold_quantity'];
                                            $availableQuantity += $items[$y]['available'];
                                        }
                                        $limit = 4;
                                        if($limit > $availableQuantity){
                                            $limit = $availableQuantity;
                                        }
                                        for ($b = 1; $b <= $limit; $b++) { ?>
                                            <option value="<?= $b ?>"><?= $b ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="sell-statistic">
                                        <div id="number-of-available"><?php
                                            if($availableQuantity > 10){
                                                echo __('More than') . ' ' . '10' . ' ' . __('available');
                                            }else{
                                                echo $availableQuantity . ' ' . __('available');
                                            }
                                            ?></div>
                                        <div id="sold-quantity"><?php echo $soldQuantity . ' ' . __('sold');?></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="buy-section border-radius">
                        <h4 id="price"><?php echo __('Price: ');
                            $price = 999999999;
                            $displayPrice = '';
                            for($x = 0; $x < count($items); $x++){
                                if(floatval($items[$x]['price']['amount']) < $price){
                                    $price = floatval($items[$x]['price']['amount']);
                                    $displayPrice = $items[$x]['price']['display_price'];
                                }
                            }
                            echo $displayPrice;
                            ?></h4>
                        <input type="hidden" id="item-id-input" name="itemId" value=""/>
                        <input name="ebayGlobalId" value="<?= $ebayGlobalId; ?>" type="hidden" />
                        <input name="countryCode" value="<?= $countryCode; ?>" type="hidden" />
                        <input name="widgetType" value="<?= $widgetType ?>" type="hidden" />
                        <input name="wrapperLayout" value="<?= $wrapperLayout ?>" type="hidden" />
                        <button class="buy-button border-radius" type="submit"><?= __('BUY IT NOW') ?></button>
                    </div>
                </form>
                <div class="additional-info">
                    <table class="product-info-table">
                        <tr>
                            <td class="product-info-table-first"><?= __('Sold by:') ?></td>
                            <td>
                                <p class="seller-name"><?= $seller['seller']?></p>
                                <p class="feedback"><?= $seller['feedback'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><?= __('Shipping:') ?><br><span><?= __('(to ') . strtoupper($countryCodeShowed) . __(' only)') ?></span></td>
                            <td>
                                <?php
                                if(isset($ebayItem['items'])){
                                    foreach ($ebayItem['items'][0]['shipping_options'] as $shipping_option) {
                                        if (isset($currencies[$shipping_option['shipping_cost']['currency']])) {
                                            $currency = $currencies[$shipping_option['shipping_cost']['currency']];
                                        }
                                        echo '<p>' . $currency .
                                                $shipping_option['shipping_cost']['amount'] . ', ' .
                                                $shipping_option['shipping_service'] . '</p>';
                                    }
                                }else{echo __('Invalid Item!');}?>
                            </td>
                        </tr>
                        <tr>
                            <td><?= __('Item condition:') ?></td>
                            <td><?= __('New') ?></td>
                        </tr>
                        <tr>
                            <td><?= __('Item location:') ?></td>
                            <td><?php
                                if (isset($ebayItem['items'][0]['location'])) {
                                    echo h($ebayItem['items'][0]['location']['city'] . ', ' . $ebayItem['items'][0]['location']['country']);
                                } else {
                                    echo __('No location specified.');
                                } ?></td>
                        </tr>
                        <tr>
                            <td><?= __('Delivery:') ?></td>
                            <td><?php
                                if ($shippingArray != false) {
                                    echo h('Between ' . date("D, d. F",
                                            strtotime($shippingArray['minDate'])) .
                                        ' and ' . date("D, d. F",
                                            strtotime($shippingArray['maxDate'])) . '.');
                                } else {
                                    echo __('No Delivery Date specified.');
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?= __('Payments:')?></td>
                            <td>
                                <div class="payment-images">
                                    <?= $this->Html->image('EbayCheckout.cards/payment_logos.gif', ['alt' => 'payment methods', 'title' => 'Visa/MasterCard, Discover, Amex']); ?>
                                </div>
                                <span style="font-size: 10px;" class="payment-info"><?= __('Credit Cards processed by PayPal') ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><?= __('Return Policy:') ?></td>
                            <td><?= $returnTerms ?></td>
                        </tr>
                        <tr>
                            <td><?= __('Guarantee:') ?></td>
                            <td>
                                <div class="ebay-money-back-wrapper">
                                    <?= $this->Html->image('EbayCheckout.ebay-money-back.png',['alt' => 'eBay Money Back']); ?>
                                    <span class="ebay-money-back-details">&nbsp;|&nbsp;<a target="_blank" href="https://rover.ebay.com/rover/1/711-53200-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338696426&customid=&mpre=https%3A%2F%2Fpages.ebay.com%2Febay-money-back-guarantee%2F"><?= __('See details') ?></a>
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="ebay-money-back-info">
                                    <span style="font-size: 12px;"><?= __('Get the item you ordered or get your money back.') ?></span><br>
                                    <span style="font-size: 11px;"><?= __('Covers your purchase price and original shipping.') ?></span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-table mobile">
        <table class="product-info-table">
            <tr>
                <td class="product-info-table-first"><?= __('Condition:') ?></td>
                <td><?= __('New') ?></td>
            </tr>
            <tr>
                <td><?= __('Quantity:') ?></td>
                <td>
                    <div id="mobile-sold-quantity"><?php echo $soldQuantity . ' ' . __('sold'); ?></div>
                    <div id="mobile-number-of-available"><?php
                        if($availableQuantity > 10){
                            echo __('More than') . ' ' . '10' . ' ' . __('available');
                        }else{
                            echo $availableQuantity . ' ' . __('available');
                        }
                        ?></div>
                </td>
            </tr>
            <tr>
                <td><?= __('Sold by:') ?></td>
                <td>
                    <p class="seller-name"><?= $seller['seller']?></p>
                    <p class="feedback"><?= $seller['feedback']?></p>
                </td>
            </tr>
        </table>
    </div>
    <div id="description-button" class="item-description-head">
        <h4><?= __('Description') ?></h4>
        <div class="informational-links">
            <div class="report-item">
                <a href="<?= isset($ebayItem['items'][0]) ? $ebayItem['items'][0]['item_web_url'] : '' ?>"><?= __('Report item on eBay')?></a>
            </div>
            <div class="terms-of-sale">
                <a href="#"><?= __("Seller's terms of sale")?></a>
            </div>
        </div>
    </div>
    <div class="mobile-rating mobile">
        <h4><?= __('Reviews')?></h4>
        <?php if($ratingCount){ ?>
        <div class="stars-middle">
            <?php
            $avgRating = floatval($ebayItem['rating']['avg_rating']);
            for ($x = 0; $x < 5; $x++) {
                if ($avgRating >= 1) {
                    echo $this->Html->image(
                        'full-star.svg',
                        [
                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                            'alt' => 'full star',
                            'class' => 'star-middle star-' . $x
                        ]);
                    $avgRating -= 1;
                } else if ($avgRating >= 0.5) {
                    echo $this->Html->image(
                        'half-star.svg',
                        [
                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                            'alt' => 'half star',
                            'class' => 'star-middle star-' . $x
                        ]);
                    $avgRating = 0;
                } else {
                    echo $this->Html->image(
                        'empty-star.svg',
                        [
                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                            'alt' => 'empty star',
                            'class' => 'star-middle star-' . $x
                        ]);
                }
            }?>
        </div>
        <div class="rating-count">
            <span>(<?=$ratingCount?>)</span>
        </div>
         <?php }else{?>
        <span class="no-ratings-yet"><?= __('We have no ratings yet.'); ?></span>
        <?php }?>
    </div>
    <div class="mobile-shipping mobile">
        <p><?= __('Shipping') ?></p>
        <p><?= __('(You can choose your delivery option later in the checkout)')?></p>
        <?php
        if (isset($ebayItem['items'][0])) {

        	foreach ($ebayItem['items'][0]['shipping_options'] as $shipping_option) {

        		if (isset($currencies[$shipping_option['shipping_cost']['currency']])) {

                	$currency = $currencies[$shipping_option['shipping_cost']['currency']];
            	}
            	?>
            	<p class="shipping-option">
            		<?= h($currency . $shipping_option['shipping_cost']['amount']) . ', ' ?>
                	<span><?= h($shipping_option['shipping_service']) ?></span>
                </p>
        		<?php
            }
        }
        ?>
    </div>
    <div class="mobile-bottom mobile">
        <table class="product-info-table">
            <tr>
                <td><?= __('Ships from:')?></td>
                <td><?php
                    if (isset($ebayItem['items'][0]['location'])) {
                        echo h($ebayItem['items'][0]['location']['city'] . ', ' . $ebayItem['items'][0]['location']['country']);
                    } else {
                        echo __('No location specified');
                    } ?></td>
            </tr>
            <tr class="mobile-delivery">
                <td><?= __('Est. Delivery:')?></td>
                <td><?php
                    if ($shippingArray != false) {
                        echo h(date("D, d. F", strtotime($shippingArray['minDate'])) . ' - ' .
                                date("D, d. F", strtotime($shippingArray['maxDate'])) . '.');
                    } else {
                        echo __('No Delivery Date specified.');
                    }
                    ?></td>
            </tr>
            <tr class="mobile-payments">
                <td><?= __('Payments:')?></td>
                <td>
                    <div class="payment-images">
                        <?= $this->Html->image('EbayCheckout.cards/payment_logos.gif', ['alt' => 'payment methods', 'title' => 'Visa/MasterCard, Discover, Amex']); ?>
                    </div>
                    <span style="font-size: 14px;" class="payment-info"><?= __('Credit Cards processed by PayPal') ?></span>
                </td>
            </tr>
            <tr class="mobile-returns">
                <td><?= __('Return Policy:')?></td>
                <td><?= $returnTerms ?></td>
            </tr>
            <tr class="mobile-guarantee">
                <td><?= __('Guarantee:') ?></td>
                <td>
                    <div>
                        <a target="_blank" href="https://rover.ebay.com/rover/1/711-53200-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338696426&customid=&mpre=https%3A%2F%2Fpages.ebay.com%2Febay-money-back-guarantee%2F"><?= __('eBay Money Back Guarantee') ?></a>
                    </div>
                    <div class="mobile-guarantee-description">
                        <span><?= __('Get the item you ordered or your money back.') ?></span>
                    </div>
                </td>
            </tr>
        </table>
        <div class="mobile-info-links">
            <div class="mobile-terms-of-sale">
                <a href="#"><?= __("Terms of sale")?></a>
            </div>
            <div class="mobile-report-item">
                <a href="<?= isset($ebayItem['items'][0]) ? $ebayItem['items'][0]['item_web_url'] : '' ?>"><?= __('Report item')?></a>
            </div>
        </div>
    </div>
</div>
<div class="item-description-wrapper">
    <div class="content-wrapper">
        <iframe sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin"
                id="item-description"
                src="<?php echo $this->Url->build(
                    [
                        'controller' => 'EbayCheckoutItems',
                        'action' => 'description',
                        'plugin' => 'EbayCheckout',
                        'itemId' => $itemId,
                        'countryCode' => $countryCode,
                        'ebayGlobalId' => $ebayGlobalId,
                        'uuid' => $uuid,
                    ]
                );?>"
                frameborder="0"
                onload="resizeIframe(this)">
        </iframe>
    </div>
</div>
<div class="content-wrapper">
    <div class="item-bottom-section">
        <div id="item-review-section">
            <div class="item-reviews border-radius">
                <table class="rating-overview">
                    <tr>
                        <th colspan="2"><?= __('Ratings and Reviews')?></th>
                    </tr>
                    <tr>
                        <?php if ($ratingCount) { ?>
                            <td>
                                <div class="average-left">
                                    <div class="center-content">
                                        <h1><?= h(round((floatval($ebayItem['rating']['avg_rating'] * 10))) / 10) ?></h1>
                                        <div class="stars-middle">
                                            <?php
                                            $avgRating = floatval($ebayItem['rating']['avg_rating']);
                                            for ($x = 0; $x < 5; $x++) {
                                                if ($avgRating >= 1) {
                                                    echo $this->Html->image(
                                                        'full-star.svg',
                                                        [
                                                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                                            'alt' => 'full star',
                                                            'class' => 'star-middle star-' . $x
                                                        ]);
                                                    $avgRating -= 1;
                                                } else if ($avgRating >= 0.5) {
                                                    echo $this->Html->image(
                                                        'half-star.svg',
                                                        [
                                                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                                            'alt' => 'half star',
                                                            'class' => 'star-middle star-' . $x
                                                        ]);
                                                    $avgRating = 0;
                                                } else {
                                                    echo $this->Html->image(
                                                        'empty-star.svg',
                                                        [
                                                            'title' => $ebayItem['rating']['histogram'][4 - $x]['count'],
                                                            'alt' => 'empty star',
                                                            'class' => 'star-middle star-' . $x
                                                        ]);
                                                }
                                            }?>
                                        </div>
                                        <p class="small-rating-count"><?= h($ratingString)?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                            <div class="average-right">
                                <div class="rating-counts">
                                    <div class="table">
                                        <?php
                                        for ($y = 0; $y < 5; $y++) {
                                            $height = 8;
                                            $margin = 0;
                                            $percentage = round(($ebayItem['rating']['histogram'][$y]['count'] / $ratingCount) * 100);
                                            if ($percentage === 2) {
                                                $height = 6;
                                                $margin = 1;
                                            }
                                            if ($percentage < 2) {
                                                $height = 4;
                                                $margin = 2;
                                            }
                                            ?>
                                            <div class="tr">
                                                <div class="td td-middle">
                                                    <?php for ($z = 0; $z < $ebayItem['rating']['histogram'][$y]['stars']; $z++) {
                                                        echo $this->Html->image(
                                                            'little-star-grey.svg',
                                                            ['alt' => '*',]);
                                                    } ?>
                                                </div>
                                                <div class="td td-big">
                                                    <div class="percentage-bar-outline">
                                                        <div style="<?php if($percentage==100){echo 'border-radius:5px;';}?>width:<?= h($percentage) ?>%;height:<?= h($height) ?>px;position:absolute;top:<?= h($margin) ?>px"
                                                             class="percentage-bar"></div>
                                                    </div>
                                                </div>
                                                <div class="td td-small">
                                                    <span><?= h($ebayItem['rating']['histogram'][$y]['count']) ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            </td><?php } else { ?>
                            <td id="no-ratings-available">
                                <h4><?= __('We have no ratings yet.')?></h4>
                            </td>
                        <?php } ?>
                    </tr>
                </table>
                <!--Costumer Review Section-->
            </div>
        </div>
        <div class="legal-info">
            <div class="legal-info-box border-radius">
                <div class="title">
                    <span><?= __('Seller Contact')?></span>
                </div>
                <div class="legal-info-bottom-wrapper">
                    <div class="contact-info-wrapper-contact">
                    <?php if(isset($ebayItem['items'][0]['seller']['legal_info'])){?>
                        <div class="contact-address">
                            <span class="contact-attribute"><?= __('Address:')?></span>
                            <div class="contact-data">
                                <?php
                                $break = false;
                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['name'])){
                                    echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['name'] . '</span><br />';
                                    $break = true;
                                }

                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['legal_contact_first_name'])){
                                    echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['legal_contact_first_name'] . '</span>';
                                    $break = true;
                                }
                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['legal_contact_last_name'])){
                                    echo '<span> ' . $ebayItem['items'][0]['seller']['legal_info']['legal_contact_last_name'] . '</span>';
                                    $break = true;
                                }
                                if($break){
                                    echo '<br>';
                                    $break = false;
                                }
                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['legal_address']['address_line_1'])){
                                    echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['legal_address']['address_line_1'] . '</span><br />';
                                }
                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['legal_address']['address_line_2'])){
                                    echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['legal_address']['address_line_2'] . '</span><br />';
                                }
                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['legal_address']['postal_code'])){
                                    echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['legal_address']['postal_code'] . '</span>';
                                    $break = true;
                                }
                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['legal_address']['city'])){
                                    echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['legal_address']['city'] . '</span>';
                                    $break = true;
                                }
                                if($break){
                                    echo '<br>';
                                }
                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['legal_address']['state_or_province'])){
                                    echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['legal_address']['state_or_province'] . '</span><br />';
                                }
                                if(!empty($ebayItem['items'][0]['seller']['legal_info']['legal_address']['country_name'])){
                                    echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['legal_address']['country_name'] . '</span><br /><br />';
                                }
                                if(isset($ebayItem['items'][0]['seller']['legal_info']['vat_details'])){
                                    echo '<span>' . __('Vat ID:');
                                    if(isset($ebayItem['items'][0]['seller']['legal_info']['vat_details']['issuing_country'])){
                                        echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['vat_details']['issuing_country'] . '</span>';
                                    }
                                    if(isset($ebayItem['items'][0]['seller']['legal_info']['vat_details']['vat_id'])){
                                        echo '<span>' . $ebayItem['items'][0]['seller']['legal_info']['vat_details']['vat_id'] . '</span>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="contact-phone">
                            <span class="contact-attribute"><?= __('Contact:')?></span>
                            <div class="contact-data">
                                <span><?php
                                        echo __('Phone: ');
                                        if(!empty($ebayItem['items'][0]['seller']['legal_info']['phone'])){
                                            echo $ebayItem['items'][0]['seller']['legal_info']['phone'];
                                        }
                                    ?></span><br />
                                <span><?php
                                        echo __('Fax: ');
                                        if(!empty($ebayItem['items'][0]['seller']['legal_info']['fax'])){
                                            echo $ebayItem['items'][0]['seller']['legal_info']['fax'];
                                        }
                                    ?></span><br />
                                <span><?php
                                        echo __('Email: ');
                                        if(!empty($ebayItem['items'][0]['seller']['legal_info']['email'])){
                                            echo $ebayItem['items'][0]['seller']['legal_info']['email'];
                                        }
                                    ?></span>
                            </div>
                        </div>

                    <?php }else{
                        echo '<span>' . __('The seller has not provided any contact info.') . '</span>';
                    }?>
                    </div>
                </div>
            </div>
            <div class="legal-info-box border-radius">
                <div class="title">
                    <span><?= __('Terms of service')?></span>
                </div>
                <div class="legal-info-bottom-wrapper">
                    <div class="contact-info-wrapper-terms">
                        <span><?php
                            if(!empty($ebayItem['items'][0]['seller']['legal_info']['terms_of_service'])){
                                echo $ebayItem['items'][0]['seller']['legal_info']['terms_of_service'];
                            }else{
                                echo __('The seller has not provided any terms of service.');
                            }?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <?= $this->element('footer') ?>
    </div>
</div>
<img src="<?= $ebayTrackingPixelSrc ?>">
<script type="text/javascript">
    (function ($) {
        $(function () {
            window.onload=function(){
                (function(d){
                    var
                        ce=function(e,n){var a=document.createEvent("CustomEvent");a.initCustomEvent(n,true,true,e.target);e.target.dispatchEvent(a);a=null;return false},
                        nm=true,sp={x:0,y:0},ep={x:0,y:0},
                        touch={
                            touchstart:function(e){sp={x:e.touches[0].pageX,y:e.touches[0].pageY}},
                            touchmove:function(e){nm=false;ep={x:e.touches[0].pageX,y:e.touches[0].pageY}},
                            touchend:function(e){if(nm){ce(e,'fc')}else{var x=ep.x-sp.x,xr=Math.abs(x),y=ep.y-sp.y,yr=Math.abs(y);if(Math.max(xr,yr)>50){ce(e,(xr>yr?(x<0?'swl':'swr'):(y<0?'swu':'swd')))}};nm=true},
                            touchcancel:function(e){nm=false}
                        };
                    for(var a in touch){d.addEventListener(a,touch[a],false);}
                })(document);
            };
            var usingIE = false;
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
            {
                usingIE = true;
            }
            if(usingIE){
                window.setInterval(function(){
                    resize();
                }, 1000);
            }else{
                $(window).resize(function(){
                    resize();
                });
            }

            /**setting the mode for the page (Desktop, Tablet, Mobile) and the respective image widths*/
            var mode;
            var uniWidth;
            function setMode(){
                if($(window).width() > 992){
                    mode = 'desktop';
                    uniWidth = 80;
                }else if($(window).width() < 993 && $(window).width() > 767){
                    mode = 'tablet';
                    uniWidth = 768;
                }else{
                    mode = 'mobile';
                    uniWidth = 327;
                }
            }
            setMode();

            var sellerRating = <?php if(isset($ebayItem['items'])){
                                        echo h($ebayItem['items'][0]['seller']['feedback_percentage']);
                                     }else{echo h('false');}?>;

            /**smooth scrolling down to rating section if rating-link is clicked*/
            $('#scrollable').click(function (event) {
                event.preventDefault();
                if(mode === 'desktop' || mode === 'tablet'){
                    $('html, body').animate({
                        scrollTop: $(this.hash).offset().top
                    }, 1000)
                }
            });

            /**
             * slide to the item-description page if the site is in mobile mode and the description
             * button is pressed
             */
            var descriptionDisplayed = false;
            $('#description-button').click(function () {
                if(mode === 'mobile'){
                    if(!descriptionDisplayed){
                        $(this).hide('slide', {direction: 'left'}, 400, function () {
                            $(this).addClass('item-description-head-fullpage').removeClass('item-description-head');
                            $(this).show();
                            $("body").scrollTop(0);
                        });
                        $('.item-info-controls').hide('slide', {direction: 'left'}, 400, function () {
                            $('.item-description-wrapper').show();
                        });
                        $('.mobile').hide('slide', {direction: 'left'}, 400);
                        $('#footer').hide('slide', {direction: 'left'}, 400);
                        descriptionDisplayed = true;
                        $('.item-description-wrapper > .content-wrapper').css('padding', '0');
                    }else{
                        $(this).hide('slide', {direction: 'right'}, 400, function () {
                            $(this).addClass('item-description-head').removeClass('item-description-head-fullpage');
                            $(this).show();
                        });
                        $('.item-description-wrapper').hide();
                        $('.item-info-controls').show('slide', {direction: 'left'}, 400);
                        $('.mobile').show('slide', {direction: 'left'}, 400);
                        $('#footer').show('slide', {direction: 'left'}, 400);
                        $('.item-description-wrapper > .content-wrapper').css('padding', '30px');
                        descriptionDisplayed = false;
                    }
                }
            });

            /**set page description according to the device*/
            function setPageDescription() {
                var pageDescription = $('.page-description');
                if (mode === 'mobile') {
                    pageDescription.text('Item info');
                } else {
                    pageDescription.text('Checkout');
                }
            }
            setPageDescription();

            /**hides desktop parts of the website and displays the mobile elements*/
            function setMobilePage(){
                if(!descriptionDisplayed){
                    $('.mobile').show();
                }
                $('#scrollable').removeAttr('href');
                $('.additional-info').hide();
                //$('.item-bottom-section').hide();
                $('#item-review-section').hide();
                if(!descriptionDisplayed){
                    $('.item-description-wrapper').hide();
                    descriptionDisplayed = false;
                }
            }
            /**mobile site changes*/
            if(mode === 'mobile'){
                setMobilePage();
            }

            /**
             * resize function that is called once a second and deals with some appearance bugs if
             * the site is resized. Cant use $(window).resize, because IE doesnt support that...
             */
            var oldMode = mode;
            var iframe = document.getElementById('item-description');
            var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            var iframeIsLoaded = false;
            function resize(){
                if(iframeDoc.readyState === 'complete'){
                    iframe.contentWindow.onload = function(){
                        iframeIsLoaded = true;
                    };
                    if(iframeIsLoaded){
                        resizeIframe(iframe);
                    }
                }
                setMode();
                if(mode === 'tablet' || mode === 'mobile'){
                    $('.mini-image-container').css('box-shadow', 'none');
                }
                if(oldMode !== mode){
                    resetImageSection();
                    setPageDescription();
                    oldMode = mode;
                }

                /**if the window is resized when in mobile item-description set the page back to default*/
                if(mode === 'desktop' || mode === 'tablet'){
                    $('#scrollable').attr('href', '#item-review-section');
                    $('.mobile').hide();
                    $('.additional-info').show();
                    $('.item-bottom-section').show();
                    $('.item-description-wrapper').show();
                    $('.item-description-wrapper > .content-wrapper').css('padding', '30px');
                    descriptionDisplayed = false;
                    $('#footer').show();
                    if(!$('.item-info-controls').is(':visible')){
                        $('.item-info-controls').show();
                        $('.item-bottom-section').show();
                        $('#description-button').addClass('item-description-head').removeClass('item-description-head-fullpage');
                    }
                }else{
                    setMobilePage();
                }
            }

            /**
             * event listener for clicks on miniimages in desktop mode. Also set the first mini image as selected
             * on startup
             */
            var lastClicked = $('#container-0');
            var miniImage = $('.mini-image-container');
            miniImage.click(function () {onImageClick(this, false);});
            if(mode === 'desktop'){
                lastClicked.css("box-shadow", "inset 0px 0px 5px 0px rgba(66,66,66,1)");
            }

            var imageList = $('#image-list');
            var imageCount = <?php if(isset($images)){echo count($images);}else{echo '0';} ?>;
            var nextButton = $('#next-button');
            var prevButton = $('#previous-button').addClass('disabled');
            var left = 0;
            /**
             * resets the relevant values in the image section if the window is resized, so that no display errors
             * can occur
             */
            function resetImageSection(){
                imageCounter = 1;
                left = 0;
                lastClicked = $(imageList[0]);
                handleImageSectionWidth();
                disableButtons(left);
                if(!$(imageList).is(':animated')){
                    imageTransition(left);
                }
                imageCounterSpan.html(imageCounter + '/' + imageCount);
            }

            /**
             * calculated the amount of which the list has to be scrolled and calls the scroller and disableButtons functions
             * with this value
             *
             * @param type - string (prev or next) that determines if the list should be scrolled
             *               left or right
             * @param width - int: the width of the image or images (depending on mobile or desktop)
             */
            function scrollImages(type, width){
                if(type === 'next'){
                    if(imageList.width() + (left - width) > width){
                        left -= width;
                    }else if(imageList.width() + (left - width) >= 0){
                        left = -(imageList.width() - width);
                    }
                }else{
                    if(left !== 0){
                        if(left < -width){
                            left += width;
                        }else if(left < 0){
                            left = 0;
                        }
                    }
                }
                disableButtons(left);
                scroller(left);
            }

            /**sets the width of the mini-image section according to mode*/
            function handleImageSectionWidth(){
                if(mode === 'desktop'){
                    imageList.width(imageCount * uniWidth);
                    if(imageCount > 5){
                        $('.mini-image-wrapper').width(uniWidth * 5);
                    }else if(imageCount <= 5){
                        $('.mini-image-wrapper').width(imageCount * uniWidth);
                        nextButton.hide();
                        prevButton.hide();
                    }
                }else{
                    imageList.width(imageCount * uniWidth);
                    $('.mini-image-wrapper').width(uniWidth);
                }
            }
            handleImageSectionWidth();

            /**mini-image buttons handlers*/
            prevButton.click(function () {
                if(left !== 0 && mode === 'desktop'){
                    $(imageList).stop();
                    scrollImages('prev', uniWidth * 5);
                }
            });
            nextButton.click(function () {
                if(left !== -(imageList.width() - 400) && mode === 'desktop'){
                    $(imageList).stop();
                    scrollImages('next', uniWidth * 5);
                }
            });

            /**touch swipe event listeners*/
            var usingIE = false;
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
            {
                usingIE = true;
            }
            var imageCounter = 1;
            var imageCounterSpan = $('.image-counter-span');
            imageCounterSpan.html(imageCounter + '/' + imageCount);
            var hImageList = imageList.get(0);
            if(!usingIE){
                hImageList.addEventListener('swl',function() {
                    if(left !== -(imageList.width() - uniWidth) && (mode === 'tablet' || mode === 'mobile')) {
                        imageCounter++;
                        imageCounterSpan.html(imageCounter + '/' + imageCount);
                        $(imageList).stop();
                        scrollImages('next', uniWidth);
                        setValue(imageCounter - 1);
                    }
                },false);
                hImageList.addEventListener('swr',function(){
                    if(left !== 0 && (mode === 'tablet' || mode === 'mobile')){
                        imageCounter--;
                        imageCounterSpan.html(imageCounter + '/' + imageCount);
                        $(imageList).stop();
                        scrollImages('prev', uniWidth);
                        setValue(imageCounter - 1);
                    }
                },false);
            }else{
                //console.log('using internet explorer');
                //if(window.navigator.msPointerEnabled){
                //    hImageList.addEventListener('MSPointerDown', onPointerDown, false);
                //    hImageList.addEventListener('MSPointerMove', onPointerUp, false);
                //}else{
                //    console.log('Out of luck, dude');
                //}
                //var yChange = [];
                //var xChange = [];
                //function onPointerDown(event){
                //    if(event.pointerType === 'touch'){
                //        console.log('Pointer Down Event');
                //        yChange[0] = 5;
                //    }
                //}
                //function onPointerUp(event) {
                //    if(event.pointerType === 'touch') {
                //        console.log('Pointer Up Event');
                //        console.log(event);
                //    }
                //}
            }

            /**
             * animates the scrolling of the imageList.
             *
             * @param left - int: the point the list has to be scrolled to
             */
            function scroller(left){
                imageList.animate({left: left}, 400);
            }

            /**
             * if the image is changed by a selector in mobile or tablet mode, this function is called instead of
             * scroller. Instead of scrolling it has a fadeIn - fadeOut animation, which is nicer for long image lists
             *
             * @parm lift- int: the point the list has to be transitioned to
             */
            function imageTransition(left){
                imageList.fadeOut(200, function () {
                    imageList.css('left', left);
                    imageList.fadeIn(200);
                });
            }

            /**
             * adds and removes the disabled class from the buttons depending on the variable left
             *
             * @param left - int: the amount in pixels of which the list should be scrolled (negative)
             */
            function disableButtons(left){
                if(left === 0){
                    prevButton.addClass('disabled');
                }else if(Math.abs(left) === Math.abs(imageList.width() - (uniWidth * 5))){
                    nextButton.addClass('disabled');
                }
                if(left < 0){
                    if(prevButton.hasClass('disabled')){
                        prevButton.removeClass('disabled');
                    }
                }
                if(left > -(imageList.width() - (uniWidth * 5))){
                    if(nextButton.hasClass('disabled')){
                        nextButton.removeClass('disabled');
                    }
                }
            }
            disableButtons(left);

            /**Set the color of the feedback according to its value*/
            if(sellerRating){
                if (sellerRating > 90) {$('.feedback').css('color', '#55930e');}
                else if (sellerRating > 70) {$('.feedback').css('color', '#f4d442');}
                else{$('.feedback').css('color', '#ed1212');}
            }

            var items = <?php if($itemPresent){echo json_encode($items);}else{echo h('false');}?>;
            var configurableAttributeCount = <?php if(isset($ebayItem['configurable_attributes'])){echo count($ebayItem['configurable_attributes']);}else{echo '0';}?>;
            var selectedValues = {};
            var selectors = $('.attribute-select');

            /**
             * set price for the item that matches the selected attributes and show it over
             * the buy-button. If not all attributes are selected, show the lowest price
             */
            var lowestPrice = '<?= $displayPrice ?>';
            function setPrice() {
                if(arrayLength(selectedValues) === configurableAttributeCount){
                    for (var b = 0; b < items.length; b++){
                        if(itemValid(items[b], selectedValues)){
                            $('#price').html('Price: ' + items[b]['price']['display_price']);
                        }
                    }
                }else{
                    $('#price').html('Price: ' + lowestPrice);
                }
            }

            /**set item-id in the form-input if there are no selectable attributes for that item*/
            if (configurableAttributeCount === 0) {
                if(items){
                    $('#item-id-input').val(items[0].id);
                }
            }

            /**
             * get the length of an associative array
             *
             * @param array - the array whose length we want to know
             * @return int - length of array
             */
            function arrayLength(array) {
                var count = 0;
                for (var value in array) {
                    count++;
                }
                return count;
            }

            /**
             * deletes characters from a string that would otherwise provoke an error
             *
             * @param string - The string that should be correctified
             * @return string - The correctified String
             */
            function correctifyString(string){
                return string.replace('"', '');
            }

            /**
             * goes through the selected attributes and checks the item attributes against them
             *
             * @param item - item array with its properties
             * @param valueArray - the properties in an associative array which a valid item must have
             * @return boolean - true if item is valid, false if not
             */
            function itemValid(item, valueArray) {
                for (var selectedTitle in valueArray) {
                    if (correctifyString(item.attr[selectedTitle]) != valueArray[selectedTitle]) {
                        return false;
                    }
                }
                return true;
            }

            /**
             * clicking on mini-images makes them the bigger product-image and gives them an
             * inset-shadow
             *
             * @param imageContainer - object: the image container that was clicked on or that was chosen by the
             *                         gotToImage function (by selecting a color)
             * @param calledFromSelector - bool: true if this function was called by selecting a value in a selector
             *                                   false, if it is called by clicking on a mini image in desktop mode
             * */
            var productImage = $('.product-image');
            function onImageClick(imageContainer, calledFromSelector) {
                if(mode === 'desktop'){
                    if(!calledFromSelector){
                        setValue(parseInt($(imageContainer).attr('id').replace('container-', '')));
                    }
                    var jqImageContainer = $(imageContainer);
                    lastClicked.css("box-shadow", "none");
                    jqImageContainer.css("box-shadow", "inset 0px 0px 5px 0px rgba(66,66,66,1)");
                    productImage.attr("src", jqImageContainer.children()[0].src);
                    lastClicked = jqImageContainer;
                }
            }

            /**
             * set the color-selector to the color of the selected mini-image. Will delete all options
             * from that selector and add all back
             *
             * @param listIndex - int: index of the image container that was clicked on
             */
            function setValue(listIndex){
                if(imageArray[listIndex]['imageArray']['attributes'] !== undefined){
                    $.each(selectors, function (index, element) {
                        var selector = $(element);
                        if(validPictureChangeAttributes.indexOf(selector.attr('title')) !== -1){
                            deleteOptions(selector, '');
                            for(var a = 0; a < items.length; a++){
                                addOptions(items[a], selector);
                            }
                            if(optionAvailable[imageArray[listIndex]['imageArray']['attributes'][selector.attr('title')]]){
                                selector.val(correctifyString(imageArray[listIndex]['imageArray']['attributes'][selector.attr('title')]));
                            }else{
                                selector.val('');
                            }
                            selectorHandler(selector[0], false);
                        }
                    });
                }
            }

            /**checks if the selected attributes exist in the imageArray*/
            function imageAttributeCheck(imageArray){
                for(var key in imageArray){
                    if($.inArray(key, validPictureChangeAttributes) !== -1){
                        if(correctifyString(imageArray[key]) && selectedValues[key] && correctifyString(imageArray[key]) === selectedValues[key]){
                            return true;
                        }
                    }
                }
                return false;
            }

            /**
             * searches for the images associated with the selected color and calls the
             * scroller function with the needed left-value to scroll to the first of them
             *
             * @param color - string: the color which it should find the image to
             */
            var imageArray = <?php if(isset($images)){echo json_encode($images);}else{echo 'null';} ?>;
            function goToImage(index){
                if(mode === 'desktop'){
                    if((index * uniWidth) <= (imageList.width() - 400)){
                        left = -(index * 80);
                    }else{
                        if((imageList.width() - 400) > 0){
                            left = -(imageList.width() - 400);
                        }else{
                            left = 0;
                        }
                    }
                    onImageClick(imageList.children().eq(index)[0], true);
                }else{
                    left = -(index * uniWidth);
                }
                imageCounter = index + 1;
                imageCounterSpan.html(imageCounter + '/' + imageCount);
                if(mode === 'tablet' || mode === 'mobile'){
                    imageTransition(left);
                }else{
                    scroller(left)
                }
                disableButtons(left);
            }

            /**
             * checks if there is an option in the selector with the given value
             *
             * @param options - a collection of options from one selector
             * @param value - the value that should be searched for in the options
             * @return boolean - true if the option exists, false if not
             */
            function checkOptionExisting(options, value) {
                var optionExists = false;
                $.each(options, function (index, element) {
                    var option = $(element);
                    if (value == option.attr('value')) {
                        optionExists = true;
                    }
                });
                return optionExists;
            }

            /**
             * add attributes from an item as options to a selector
             *
             * @param item - array of one items with its properties
             * @param selector - the selector where the item properties should be
             *                   appended as options
             */
            var optionAvailable = <?php if(isset($optionAvailable)){echo json_encode($optionAvailable);}else{echo 'undefined';} ?>;
            function addOptions(item, selector) {
                var itemAttr;
                for (itemAttr in item.attr) {
                    if (itemAttr === selector.attr('title')) {
                        if (!(checkOptionExisting(selector.children(), correctifyString(item.attr[itemAttr])))) {
                            if(optionAvailable[item.attr[itemAttr]]){
                                selector.append('<option value="' + correctifyString(item.attr[itemAttr]) + '">' + item.attr[itemAttr] + '</option>');
                            }else{
                                selector.append('<option value="' + correctifyString(item.attr[itemAttr]) + '" disabled>' + item.attr[itemAttr] + ' [out of stock]</option>');
                            }
                        }
                    }
                }
            }

            /**
             * remove all options except - Select - from one or multiple selectors
             *
             * @param selectorContainer - jquery object: the selectors whose options should be deleted
             * @param noDeleteSelector - string: title of the selector whose options shouldnt be deleted
             */
            function deleteOptions(selectorContainer, noDeleteSelector){
                $.each(selectorContainer, function (index, element) {
                    var selector = $(element);
                    if (!(selector.attr('title') === noDeleteSelector)) {
                        var options = selector.children();
                        $.each(options, function (index, element) {
                            var option = $(element);
                            if (option.attr('value') !== "") {
                                option.remove();
                            }
                        });
                    }
                });
            }

            /**
             * if all configurable attributes are selected, set the number of available items to the
             * amount if the selected item. also sets the qty selecto to the amount available if its
             * lower than 4
             */
            function setAvailable(){
                for(var z = 0; z < items.length; z++){
                    if(arrayLength(selectedValues) === configurableAttributeCount){
                        if(itemValid(items[z], selectedValues)){
                            var limit = 4;
                            var qtySelect = $('select[name=qty]');
                            deleteOptions(qtySelect, '');
                            if(items[z]['available'] < 4){
                                limit = items[z]['available']
                            }
                            for(var i = 1; i <= limit; i++){
                                qtySelect.append('<option value="' + i + '">' + i + '</option>');
                            }
                            if(items[z]['quantity_type'] === 'MORE_THAN'){
                                if(items[z]['available'] < 10){
                                    $('#number-of-available, #mobile-number-of-available').html(
                                        '<?= __('More than')?>' + ' ' + items[z]['available'] + ' ' +
                                        '<?= __('available')?>'
                                    );
                                }else{
                                    $('#number-of-available, #mobile-number-of-available').html(
                                        '<?= __('More than')?>' + ' ' + '10' + ' ' + '<?= __('available')?>'
                                    );
                                }
                            }else if(items[z]['quantity_type'] === 'EXACT'){
                                if(items[z]['available'] !== 1){
                                    $('#number-of-available, #mobile-number-of-available').html(items[z]['available'] + ' ' +
                                        '<?= __('available')?>'
                                    );
                                }else{
                                    $('#number-of-available, #mobile-number-of-available').html('<?= __('Last one')?>')
                                }
                            }
                        }
                    }
                }
            }

            /**
             * Check if all item-attributes are chosen, then set the id of the fitting item
             * as value of the id input field, else its value to ''
             */
            function setItemId(){
                if (arrayLength(selectedValues) === configurableAttributeCount) {
                    for (var a = 0; a < arrayLength(items); a++) {
                        if (itemValid(items[a], selectedValues)) {
                            $('#item-id-input').val(items[a].id);
                            break;
                        }
                    }
                } else {
                    $('#item-id-input').val('');
                }
            }

            /**
             * if the attribute from the selector is set, set the selector to this attribute
             * else set it to default
             * Needed because every selection deletes and readds all the options which
             * causes the value to reset
             */
            function setSelectorValue(){
                $.each(selectors, function (index, element) {
                    var selector = $(element);
                    if (selectedValues[selector.attr('title')] !== null) {
                        if (checkOptionExisting(selector.children(), selectedValues[selector.attr('title')])) {
                            selector.val(selectedValues[selector.attr('title')]);
                        }
                    } else {
                        selector.val('');
                    }
                });
            }

            /**call the selectorHandler if the user selects something in a selector*/
            selectors.change(function () {
                selectorHandler(this, true);
            });

            /**set the item-attributes, that interact with the images*/
            var configAttributes = <?php if(isset($ebayItem['configurable_attributes'])){echo json_encode($ebayItem['configurable_attributes']);}else{echo 'null';} ?>;
            var validPictureChangeAttributes = ['Size', 'Width', 'Character', 'Fabric'];
            var colorVariants = ['Color', 'Colour', 'Colors', 'Colours', 'Main Color', 'Main Colour', 'Main Colors',
                                    'Main Colours'];
            if(configAttributes !== null){
                for(var x = 0; x < colorVariants.length; x++){
                    if(configAttributes[colorVariants[x]] !== undefined){
                        validPictureChangeAttributes = colorVariants;
                        break;
                    }
                }
            }

            /**disables attributes of selectors when an attribute is selected and it is out of stock*/
            var selectorBuildArray = <?= json_encode($attributeArray) ?>;
            function disableOptions(){
                $.each(selectedValues, function (key, value) {
                    $.each(selectorBuildArray[key][value], function (attrName, attrValueArray) {
                        $.each(attrValueArray, function (attrValue, available) {
                            if(attrValue.indexOf('"') >= 0){
                                attrValue = attrValue.replace('"', '');
                            }
                            var option = $('select[title="' + attrName + '"] > option[value="' + attrValue + '"]');
                            if(option.is(':enabled')){
                                option.attr('disabled', !available);
                            }
                            if(option.is(':disabled') && !(option.html()).includes('[out of stock]')){
                                option.html(option.html() + ' [out of stock]');
                            }
                        });
                    });
                });
            }

            /**
             * handles the selection of the item variants. Deletes all options if a option is
             * selected and adds only the ones corresponding to the already selected ones
             */
            function selectorHandler(selector, calledFromSelector){
                var callSelectorTitle = selector.title;
                var callSelectorValue = selector.value;
                /**save selected values in associative array*/
                if (!(callSelectorValue === '')) {
                    selectedValues[callSelectorTitle] = callSelectorValue;
                } else {
                    delete selectedValues[callSelectorTitle];
                }

                /**
                 * if selectorHandler was called by selecting a value, and that value was a type that should
                 * change the image go to the first Image associated with that value
                 * if it was not, reset the selectedValues and the data tag in the selectors
                 */
                if(calledFromSelector){
                    if(validPictureChangeAttributes.indexOf(callSelectorTitle) !== -1 && imageArray !== null){
                        for(var i = 0; i < imageArray.length; i++){
                            if(imageArray[i]['imageArray']['attributes'] !== undefined){
                                if(imageAttributeCheck(imageArray[i]['imageArray']['attributes'])){
                                    $(imageList).stop();
                                    goToImage(i);
                                    break;
                                }
                            }
                        }
                    }
                }else{
                    selectedValues = {};
                    if(callSelectorValue !== ''){
                        selectedValues[callSelectorTitle] = callSelectorValue;
                    }
                    $.each(selectors, function (index, element) {
                        var jElm = $(element);
                        jElm.attr('data', 'unselected');
                    });
                }

                /**
                 * if the calling selector was set to a value, set its html attribute 'data'
                 *  to selected
                 */
                if (callSelectorValue !== '') {
                    $(selector).attr('data', 'selected');
                } else {
                    $(selector).attr('data', 'unselected');
                }

                deleteOptions(selectors, callSelectorTitle);
                /**add all options that fit the selected ones to all selectors*/
                $.each(selectors, function (index, element) {
                    var selector = $(element);
                    var selectedValuesExclusive = $.extend({}, selectedValues);
                    var selectorTitle = selector.attr('title');
                    var selectorData = selector.attr('data');
                    if (selectedValuesExclusive[selectorTitle] !== null) {
                        delete selectedValuesExclusive[selectorTitle];
                    }
                    if(selectorData === 'unselected'){
                        for (var a = 0; a < items.length; a++) {
                            if(itemValid(items[a], selectedValues)){
                                addOptions(items[a], selector);
                            }
                        }
                    }else{
                        if(selectorTitle !== callSelectorTitle){
                            for(var b = 0; b < items.length; b++){
                                if(itemValid(items[b], selectedValuesExclusive)){
                                    addOptions(items[b], selector);
                                }
                            }
                        }
                    }
                });
                disableOptions();
                setSelectorValue();
                setPrice();
                setAvailable();
                setItemId();
            }
        });
    })(jQuery);
</script>
