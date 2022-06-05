<?php
/**
 * @var \App\View\AppView $this
 * @var \EbayCheckout\Model\Entity\EbayCheckoutSession $ebayCheckoutSession
 */
?>
<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]); $total_shipping_costs = 0; ?>
<div class="container order-view">
    <div class="row content-wrapper">
        <div id="account-nav-container">
            <div class="row account-navigation">
                <div class="col-12">
                    <?= $this->cell('ItoolCustomer.AccountNavigation', [$frontUser, 'active' => 'orders']) ?>
                </div>
            </div>
        </div>
        <div class="account-content-container order-wrapper">
            <div class="row order-info">
                <div class="col-12 order-overview">
                    <div class="back-button">
                        <a onclick="window.history.back()"><?= __d('itool_customer', 'Back to order list') ?></a>
                    </div>
                    <div class="order-details-header">
                        <div class="col-md-8 row">
                            <div class="order-date">
                                <span class="bold"><?= __d('itool_customer', 'Order date'); ?></span>
                                <br>
                                <span class="buy-date"><?= \Cake\I18n\Time::parse($ebayCheckoutSession->created)->i18nFormat('dd.MM.yyyy') ?></span>
                            </div>
                            <div class="order-number">
                                <span class="bold"><?= __d('itool_customer', 'Order number') ?></span>
                                <br>
                                <span class="order-id"><?= __d('itool_customer', $ebayCheckoutSession->purchase_order_id) ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 order-total-wrapper">
                            <span class="bold"><?= __d('itool_customer', 'Order total'); ?></span>
                            <br>
                            <span class="order-total">
                                <?php foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) {
                                    if ($total->code == 'total') {
                                        echo \Cake\I18n\Number::currency($total->value, $total->currency);
                                        break;
                                    }
                                } ?>
                            </span>
                            <span class="tax-info"> <?= __d('itool_customer', 'Tax incl.') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row item-box">
                <div class="col-12">
                    <?php foreach ($ebayCheckoutSession->ebay_checkout_session_items as $item) :
                        $total_shipping_costs += $item->selected_ebay_checkout_session_item_shipping->base_delivery_cost_value; ?>
                        <div class="row item-row">
                            <div class="col-2 col-md-2 col-lg-1 item-image">
                                <div class="img-wrapper"><?= $this->Html->image($item->image) ?></div>
                            </div>
                            <div class="col-10 col-md-6 col-lg-3 item-info">
                                <div class="item-title bold"><?= h($item->title) ?></div>
                            </div>
                            <div class="col-10 col-md-4 col-lg-4 order-md-4 info-middle">
                                <div class="info-wrapper">
                                    <div class="item-seller">
                                        <span class="bold"> <?= __d('itool_customer', 'Sold by:') ?></span>
                                        <span class="seller-name"><?=  $item->seller_username ?></span>
                                    </div>
                                    <div class="item-count">
                                        <span class="bold"><?= __d('itool_customer', 'Qty:') ?></span>
                                        <span><?= $item->quantity ?></span>
                                    </div>
                                    <div class="item-shipping-cost"><span class="bold"><?= __d('itool_customer', 'Shipping:') ?></span>
                                        <span><?= $item->selected_ebay_checkout_session_item_shipping->shipping_carrier_code ?><?= $item->selected_ebay_checkout_session_item_shipping->shipping_service_code ?> -
                                            <?php if ($item->selected_ebay_checkout_session_item_shipping->base_delivery_cost_value == 0.00) {
                                                echo __d('itool_customer', 'free shipping');
                                            } else {
                                                echo \Cake\I18n\Number::currency($item->selected_ebay_checkout_session_item_shipping->base_delivery_cost_value,
                                                    $item->selected_ebay_checkout_session_item_shipping->base_delivery_cost_currency);
                                            } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-md-3 order-lg-4 item-price">
                                <span><?= \Cake\I18n\Number::currency($item->base_price_value, $item->base_price_currency) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row col-12 justify-content-end">
                <div class="separator"></div>
            </div>
            <div class="row send-info">
                <div class="col-12">
                    <div class="row item-row">
                        <div class="col-4 col-md-1"></div>
                        <div class="col-12 col-md-7 col-lg-3">
                            <div class="item-shipping-status">
                                <span class="bold"><?= __d('itool_customer', 'Shipping date') ?></span>
                                <br>
                                <span><?= \Cake\I18n\Time::parse($item->selected_ebay_checkout_session_item_shipping->created)->i18nFormat('dd.MM.yyyy') ?></span>
                            </div>
                            <div>
                                <span class="bold"><?= __d('itool_customer', 'Delivery') ?></span>
                                <br>
                                <span class="order-delivery-value">
                                    <?php if (!empty($ebayCheckoutSession->ebay_checkout_session_items)) {
                                        $dates = [];
                                        $minDate = null;
                                        $maxDate = null;
                                        foreach ($ebayCheckoutSession->ebay_checkout_session_items ?? [] as $ebayItem) {
                                            $shipping = null;
                                            if (isset($ebayItem->ebay_checkout_session_item_shippings)
                                                && isset($ebayItem->ebay_checkout_session_item_shippings->min_estimated_delivery_date)
                                                && isset($ebayItem->ebay_checkout_session_item_shippings->max_estimated_delivery_date)
                                            ){
                                                $shipping = $ebayItem->ebay_checkout_session_item_shippings;
                                                $minDate = $shipping->min_estimated_delivery_date;
                                                $maxDate = $shipping->max_estimated_delivery_date;
                                            } else if (isset($ebayItem->selected_ebay_checkout_session_item_shipping)
                                                && isset($ebayItem->selected_ebay_checkout_session_item_shipping->min_estimated_delivery_date)
                                                && isset($ebayItem->selected_ebay_checkout_session_item_shipping->max_estimated_delivery_date)
                                            ) {
                                                $minDate = strtotime($ebayItem->selected_ebay_checkout_session_item_shipping->min_estimated_delivery_date->format('Y-m-d H:i:s'));
                                                $maxDate = strtotime($ebayItem->selected_ebay_checkout_session_item_shipping->max_estimated_delivery_date->format('Y-m-d H:i:s'));
                                            }
                                            array_push($dates, $minDate, $maxDate);
                                        }
                                        if(!isset($minDate) || !isset($maxDate)){
                                            print_r(__('No Information'));
                                        } else {
                                            $min =  new \Cake\I18n\Time(min($dates));
                                            $max =  new \Cake\I18n\Time(max($dates));
                                            print_r(__('Between ') . $min->i18nFormat('dd. MMM') .__(' and ') . $max->i18nFormat('dd. MMM'));
                                        }
                                    } ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 order-md-4  info-middle">
                            <div class="info-wrapper">
                                <div class="shipping-address">
                                    <span class="bold"><?= __d('itool_customer', 'Shipping to') ?></span>
                                    <address>
                                        <span><?= $ebayCheckoutSession->first_name ?? '' ?> <?= $ebayCheckoutSession->last_name ?? '' ?></span>
                                        <br>
                                        <?= $ebayCheckoutSession->ebay_checkout_session_shipping_address->address_line_1 ?? '' ?>
                                        <?php if ($ebayCheckoutSession->ebay_checkout_session_shipping_address->address_line_2 ?? []) : ?>
                                            <br>
                                            <?= $ebayCheckoutSession->ebay_checkout_session_shipping_address->address_line_2 ?? '' ?>
                                            <br>
                                        <?php endif; ?>
                                        <?= $ebayCheckoutSession->ebay_checkout_session_shipping_address->postal_code ?? '' ?> <?= $ebayCheckoutSession->ebay_checkout_session_shipping_address->city ?? '' ?>
                                        <br>
                                        <?php if ($ebayCheckoutSession->ebay_checkout_session_shipping_address->country ?? [] && $ebayCheckoutSession->ebay_checkout_session_shipping_address->country == 'DE') : ?>
                                            <?= __d('itool_customer', 'Germany') ?>
                                        <?php else: ?>
                                            <?php if ($ebayCheckoutSession->ebay_checkout_session_shipping_address->country ?? []) : ?>
                                                <?= $ebayCheckoutSession->ebay_checkout_session_shipping_address->country ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3 order-lg-4">
                            <div class="row bought">
                                <div class="col-12">
                                    <span class="bold"><?= __d('itool_customer', 'Bought') ?></span>
                                    <br>
                                    <span class="order-info-value"><?= \Cake\I18n\Time::parse($ebayCheckoutSession->created)->i18nFormat('eeee, dd. MMM yyyy') ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span class="bold"><?= __d('itool_customer', 'Payment date') ?></span>
                                    <br>
                                    <span><?= \Cake\I18n\Time::parse($ebayCheckoutSession->created)->i18nFormat('eeee, dd. MMM yyyy') ?></span>
                                </div>
                            </div>
                            <div class="item-payment-info">
                                <span class="bold"><?= __d('itool_customer', 'Payment method:') ?></span>
                                <br>
                                <span><?php if ($ebayCheckoutSession->selected_ebay_checkout_session_payment->label == 'WALLET' ) {
                                        echo "PayPal"; } else { echo $ebayCheckoutSession->selected_ebay_checkout_session_payment->label;} ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-12 justify-content-end">
                <div class="separator"></div>
            </div>
            <div class="row item-box">
                <div class="col-12">
                    <div class="row last-row">
                        <div class="col-4 col-md-1"></div>
                        <div class="col-12 col-md-7 buyer-protection">
                            <div class="ebay-money-back-guarantee-wrapper">
                                <div class="ebay-money-back-guarantee">
                                    <div class="ebay-money-back-image "></div>
                                </div>
                                <div class="ebay-money-back-guarantee">
                                    <a href="<?= __('https://rover.ebay.com/rover/1/711-53200-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338696426&customid=&mpre=https%3A%2F%2Fpages.ebay.com%2Febay-money-back-guarantee%2F') ?>"
                                       target="_blank"><?= __d('itool_customer', 'Details') ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 order-price-overview">
                            <h3 class="bold"><?= __d('itool_customer', 'Order totals') ?></h3>
                            <div class="totals-wrapper">
                                <?php
                                $qty = 0;
                                $item_total = 0;
                                $shipping_costs_total = 0;
                                foreach ($ebayCheckoutSession->ebay_checkout_session_items ?? [] as $item) {
                                    $qty += $item->quantity;
                                    $item_total += $item->value;
                                    $shipping_costs_total += $item->shipping_costs_de;
                                }
                                ?>
                                <?php foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) : ?>
                                    <?php if (($total->value && $total->value !== "0.00")) : ?>
                                        <?php if ($total->code == 'priceSubtotal') { ?>
                                            <div class="row totals <?= $total->code; ?>-totals">
                                                <div class="col-8 name"><?= $total->label ?? $this->EbayCheckout->formatTotalCode($total->code,
                                                        $qty); ?></div>
                                                <div class="col-4 total-price"><?= \Cake\I18n\Number::currency($total->value, $total->currency); ?></div>
                                            </div>
                                        <?php } ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div class="row shipping">
                                    <div class="col-8 name"><?= __d('itool_customer', 'Shipping'); ?> </div>
                                    <div class="col-4 total-price"><?= \Cake\I18n\Number::currency($total_shipping_costs, $total->currency); ?></div>
                                </div>
                                <?php foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) : ?>
                                    <?php if (($total->value && $total->value !== "0.00")) : ?>
                                        <?php if ($total->code == 'total') { ?>
                                            <div class="row invoice-total <?= $total->code; ?>-totals">
                                                <div class="col-8 name bold"><?= $total->label ?? $this->EbayCheckout->formatTotalCode($total->code,
                                                        $qty); ?></div>
                                                <div class="col-4 total-price bold"><?= \Cake\I18n\Number::currency($total->value, $total->currency); ?></div>
                                            </div>
                                        <?php } ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div class="row tax-info">
                                    <div class="col-8 name"><?= __d('itool_customer', 'Tax included'); ?></div>
                                    <div class="col-4 total-price">
                                        <?php foreach ($ebayCheckoutSession->ebay_checkout_session_totals as $total) {
                                            if ($total->code == 'total') {
                                                echo \Cake\I18n\Number::currency(round((($total->value * 19) / 100), 2), $total->currency);
                                                break;
                                            }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
