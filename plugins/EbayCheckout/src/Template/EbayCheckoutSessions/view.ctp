<?php
/**
 * @var \EbayCheckout\Model\Entity\EbayCheckoutSession $ebayCheckoutSession
 */

$this->assign('title', 'Checkout');

$this->start('css');
echo $this->Html->css('EbayCheckout.checkout');
$this->end();

$this->start('script');
echo $this->Html->script('EbayCheckout.jquery-ui.min.js');
echo $this->Html->script('https://js.braintreegateway.com/web/3.25.0/js/client.min.js');
echo $this->Html->script('https://js.braintreegateway.com/web/3.25.0/js/hosted-fields.min.js');
echo $this->Html->script('https://js.braintreegateway.com/web/3.25.0/js/data-collector.min.js');
echo $this->Html->script('EbayCheckout.checkout.js');
echo $this->Html->script('EbayCheckout.shipping-address.js');
echo $this->Html->script('EbayCheckout.item.js');
echo $this->Html->script('EbayCheckout.payment.js');
echo $this->Html->script('EbayCheckout.totals.js');
$this->end();
?>
<?php if (empty($ebayCheckoutSession->ebay_checkout_session_items) || $ebayCheckoutSession->purchase_order_id != null): ?>
<div class="container-fluid">
    <div class="row widget">
        <div class="col widget-body">
            <?= __('No items found.'); ?>
        </div>
    </div>
</div>
<?php else: ?>
<div class="col-lg-8">
    <div class="row">
        <div class="col col-full">
            <?= $this->cell('EbayCheckout.ItemsWidget', ['ebayCheckoutSession' => $ebayCheckoutSession]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $this->cell('EbayCheckout.ShippingAddressWidget', ['ebayCheckoutSession' => $ebayCheckoutSession]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $this->cell('EbayCheckout.ApplyCouponWidget', ['ebayCheckoutSession' => $ebayCheckoutSession]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $this->cell('EbayCheckout.PaymentWidget', ['ebayCheckoutSession' => $ebayCheckoutSession, 'mode' => \EbayCheckout\View\Cell\PaymentWidgetCell::DISABLED]); ?>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <?= $this->cell('EbayCheckout.TotalsWidget', ['ebayCheckoutSession' => $ebayCheckoutSession]); ?>
</div>
<img src="<?= $ebayTrackingPixelSrc ?>">
<?php $this->append('css'); ?>
<style type="text/css">
    body{
        <?= $ebayCheckoutSession->ebay_checkout->background_color ? "background-color: {$ebayCheckoutSession->ebay_checkout->background_color} !important;" : ""; ?>
        <?= $ebayCheckoutSession->ebay_checkout->background_color ? "color: {$ebayCheckoutSession->ebay_checkout->font_color} !important;" : ""; ?>
        <?= $ebayCheckoutSession->ebay_checkout->background_color ? "font-family: {$ebayCheckoutSession->ebay_checkout->font} !important;" : ""; ?>
    }
    .background-main-color {
        <?= $ebayCheckoutSession->ebay_checkout->main_color ? "background-color: {$ebayCheckoutSession->ebay_checkout->main_color} !important;" : ""; ?>
    }
    .background-second-color {
        <?= $ebayCheckoutSession->ebay_checkout->second_color ? "background-color: {$ebayCheckoutSession->ebay_checkout->second_color} !important;" : ""; ?>
    }
    #payment-cc div.bt-input{
        height: 20px;
        margin: 15px 5px;
    }
    #payment-cc div.field-wrapper {
        position:relative;
    }
    #payment-cc label {
        font-size: 18px;
        transition: all .2s;
        position:absolute;
        margin-left: 6px;
    }
    #payment-cc label.floated{
        font-size: 8px;
    }
</style>
<?php $this->end('css'); ?>
<?php endif; ?>
<script type="text/javascript">
    (function ($) {
        $(function () {
            try {
                parent.postMessage("checkout_session_started", "*");
                var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
                if(iOS) {
                    $('body').addClass('ios');

                    var iPad = /iPad/.test(navigator.userAgent) && !window.MSStream;
                    if (iPad) {
                        $('body').addClass('ipad');
                    }

                    var iPhone = /iPhone/.test(navigator.userAgent) && !window.MSStream;

                    if (iPhone) {
                        $('body').addClass('iphone');
                    }

                    $('select.qty').focus().blur();
                    $('#billing-address-form-row input, #shipping-address-form-row input').addClass('scroll-fix');
                    var blur = false;
                    $('body').on('touchmove', function(e) {
                        if ($('body').hasClass('iphone')) {
                            if(blur == false) {
                                //document.activeElement.blur();
                                blur = true;
                                $('input:focus').blur();
                                if($('form#payment-method-CREDIT_CARD').hasClass('hosted-fields-shown')) {
                                    $('#billingaddress-first-name').focus().blur();
                                }
                            }

                            $('.scroll-fix').css("pointer-events","none");
                        }
                    });
                    $('body').on('touchend', function(e) {
                        if ($('body').hasClass('iphone')) {
                            blur = false;
                            $('.scroll-fix').css("pointer-events", "auto");
                        }
                    });
                }
            }catch (e) {
                console.log(e);
            }
        });
    })(jQuery);
</script>
