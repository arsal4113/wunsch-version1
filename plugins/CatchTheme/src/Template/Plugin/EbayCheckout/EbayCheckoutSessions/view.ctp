<?php
/**
 * @var \EbayCheckout\Model\Entity\EbayCheckoutSession $ebayCheckoutSession
 */

$this->assign('title', 'Checkout');

#$this->Html->css('EbayCheckout.checkout' . STATIC_MIN, ['block' => true]);

$this->start('script');
echo $this->Html->script('https://www.paypalobjects.com/api/checkout.js', ['data-stage' => "www.paypal.com"]);
if (!STATIC_MIN) {
    #echo $this->Html->script('EbayCheckout.main');
}
$this->end();
?>

<?php if (empty($ebayCheckoutSession->ebay_checkout_session_items) || $ebayCheckoutSession->purchase_order_id != null): ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col checkout-back-button">
                <a onclick="window.history.back()"><div class="back-arrow-image"></div><?= __('Back') ?></a>
            </div>
        </div>
        <div class="row">
            <div class="col widget-title no-items-alert"><?= $this->Flash->render() ?></div>
        </div>
        <div class="row widget">
            <div class="col widget-body">
                <?= __('No items found.'); ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <script type="text/javascript">
        window.isLoggedIn = '<?= !empty($ebayCheckoutSession->customer_id) ?>';
        window.checkoutPayments = <?= json_encode($ebayCheckoutSession->ebay_checkout_session_payments) ?>;
        window.selectedCheckoutPayment = <?= json_encode($ebayCheckoutSession->selected_ebay_checkout_session_payment) ?>;
        window.checkoutItems = <?= json_encode($ebayCheckoutSession->ebay_checkout_session_items) ?>;
        window.checkoutTotals = <?= json_encode($ebayCheckoutSession->ebay_checkout_session_totals) ?>;
        window.checkoutShippingAddress = <?= json_encode($ebayCheckoutSession->ebay_checkout_session_shipping_address) ?>;
        window.additionalUserData = <?= json_encode([
            'email' => $ebayCheckoutSession->email,
            'first_name' => $ebayCheckoutSession->first_name,
            'last_name' => $ebayCheckoutSession->last_name
        ]) ?>;
        window.shippingAddressProvided = <?= json_encode($shippingAddressProvided) ?>;
        window.zipUrl = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'ZipDataZips',
                'action' => 'getByCode',
                'plugin' => 'ZipData',
            ]
        ); ?>';
        window.shippingMethodURL = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'saveShipping',
                'plugin' => 'EbayCheckout',
                'uuid' => $ebayCheckoutSession->core_seller->uuid,
                '?' => [
                    'token' => $ebayCheckoutSession->session_token,
                    'key' => $ebayCheckoutSession->form_key
                ]
            ]
        ); ?>';
        window.shippingAddressURL = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'saveShippingAddress',
                'plugin' => 'EbayCheckout',
                'uuid' => $ebayCheckoutSession->core_seller->uuid,
                'token' => $ebayCheckoutSession->session_token,
                'key' => $ebayCheckoutSession->form_key
            ]
        );?>';
        window.savePaymentMethodUrl = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'savePayment',
                'plugin' => 'EbayCheckout',
                'uuid' => $ebayCheckoutSession->core_seller->uuid,
                '?' => [
                    'token' => $ebayCheckoutSession->session_token,
                    'key' => $ebayCheckoutSession->form_key
                ]
            ]
        ); ?>';
        window.getPaymentMethodUrl = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'getPayment',
                'plugin' => 'EbayCheckout',
                'uuid' => $ebayCheckoutSession->core_seller->uuid,
                '?' => [
                    'token' => $ebayCheckoutSession->session_token,
                    'key' => $ebayCheckoutSession->form_key
                ]
            ]
        ); ?>';
        window.saveCouponUrl = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'applyCoupon',
                'plugin' => 'EbayCheckout',
                'uuid' => $ebayCheckoutSession->core_seller->uuid,
                'token' => $ebayCheckoutSession->session_token,
                'key' => $ebayCheckoutSession->form_key
            ]
        ); ?>';
        window.submitUrl = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'submit',
                'plugin' => 'EbayCheckout',
                'uuid' => $ebayCheckoutSession->core_seller->uuid,
                'escape' => false,
                '?' => [
                    'token' => $ebayCheckoutSession->session_token,
                    'key' => $ebayCheckoutSession->form_key
                ]
            ]
        ); ?>';
        window.successUrl = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'success',
                'plugin' => 'EbayCheckout',
                'uuid' => $ebayCheckoutSession->core_seller->uuid,
                '?' => [
                    'token' => $ebayCheckoutSession->session_token,
                    'key' => $ebayCheckoutSession->form_key
                ]
            ]
        );?>';
        window.cartUrl = '<?= \Cake\Routing\Router::url(
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'cart',
                'plugin' => 'EbayCheckout',
                'uuid' => $ebayCheckoutSession->core_seller->uuid
            ]
        );?>';
    </script>
    <div class="col-12" id="checkout"></div>
    <?php
    echo $this->React->script('vendor.js');
    echo $this->React->script('checkout.js');
    ?>
    <img src="<?= $ebayTrackingPixelSrc ?>">
    <?php #$this->append('css'); ?>
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
<script>
    (function ($) {
        $(function () {
            $('button.close').click(function () {
                $('.alert.alert-success').slideUp();
            });

            $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'checkout'});

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
