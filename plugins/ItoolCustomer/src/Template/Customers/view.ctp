<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($customer->id) ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-5">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('Customers') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Customers'), ['action' => 'index']) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('General Information') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <dl class="dl-horizontal">
                        <dt><?= __('Gender') ?>:</dt>
                        <dd><?= h($customer->gender) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Name') ?>:</dt>
                        <dd><?= h($customer->first_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Last Name') ?>:</dt>
                        <dd><?= h($customer->last_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Email') ?>:</dt>
                        <dd><?= h($customer->email) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($customer->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($customer->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($customer->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Is Active') ?>:</dt>
                        <dd><?= $customer->is_active ? __('Yes') : __('No'); ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Is Deleted') ?>:</dt>
                        <dd><?= $customer->is_deleted ? __('Yes') : __('No'); ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Wishlist Items') ?>:</dt>
                        <dd><?php
                            $wishlistItemIds = [];
                            foreach ($customer->customer_wishlist_items as $wishlistItem) {
                                $wishlistItemIds[] = $wishlistItem->ebay_item_id;
                            }
                            echo implode(', ', $wishlistItemIds);
                        ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Newsletter Subscribed') ?>:</dt>
                        <dd><?= $customer->newsletter ? $customer->newsletter->subscribed ? __('Yes') : __('No') : __('No'); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($customer->customer_addresses)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Customer Addresses') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
                            <th><?= __('Core Country Id') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Street Line 1') ?></th>
                            <th><?= __('Street Line 2') ?></th>
                            <th><?= __('City') ?></th>
                            <th><?= __('State') ?></th>
                            <th><?= __('Postal Code') ?></th>
                            <th><?= __('Phone Number') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                        </tr>
                        <?php foreach ($customer->customer_addresses as $customerAddresses): ?>
                        <tr>
                            <td><?= h($customerAddresses->core_country_id) ?></td>
                            <td><?= h($customerAddresses->first_name) ?></td>
                            <td><?= h($customerAddresses->last_name) ?></td>
                            <td><?= h($customerAddresses->street_line_1) ?></td>
                            <td><?= h($customerAddresses->street_line_2) ?></td>
                            <td><?= h($customerAddresses->city) ?></td>
                            <td><?= h($customerAddresses->state) ?></td>
                            <td><?= h($customerAddresses->postal_code) ?></td>
                            <td><?= h($customerAddresses->phone_number) ?></td>
                            <td><?= h($customerAddresses->created) ?></td>
                            <td><?= h($customerAddresses->modified) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($customer->ebay_checkout_sessions)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Ebay Checkout Sessions') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
                            <th><?= __('Purchase Order Id') ?></th>
                            <th><?= __('Order Payment Status') ?></th>
                            <th><?= __('Ebay Checkout Session Id') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Items') ?></th>
                        </tr>
                        <?php foreach ($customer->ebay_checkout_sessions as $ebayCheckoutSession): ?>
                        <tr>
                            <td><?= h($ebayCheckoutSession->purchase_order_id) ?></td>
                            <td><?= h($ebayCheckoutSession->order_payment_status) ?></td>
                            <td><?= h($ebayCheckoutSession->ebay_checkout_session_id) ?></td>
                            <td><?= h($ebayCheckoutSession->modified) ?></td>
                            <td>
                                <table class="table table-bordered table-striped table-condensed">
                                    <tr>
                                        <th><?= __('Ebay Item Id') ?></th>
                                        <th><?= __('Legacy Order Id') ?></th>
                                        <th><?= __('Title') ?></th>
                                        <th><?= __('Quantity') ?></th>
                                        <th><?= __('Base Price') ?></th>
                                        <th><?= __('Net Price') ?></th>
                                        <th><?= __('Delivery Cost') ?></th>
                                        <th><?= __('Delivery Date Min') ?></th>
                                        <th><?= __('Delivery Date Max') ?></th>
                                    </tr>
                                    <?php foreach ($ebayCheckoutSession->ebay_checkout_session_items as $item): ?>
                                    <tr>
                                        <td><?= h($item->ebay_item_id) ?></td>
                                        <td><?= h($item->legacy_order_id) ?></td>
                                        <td><?= h($item->title) ?></td>
                                        <td><?= h($item->quantity) ?></td>
                                        <td><?= !empty($item->base_price_value) && !empty($item->base_price_currency)
                                                ? $this->Number->currency($item->base_price_value, $item->base_price_currency)
                                                : 'N/A' ?></td>
                                        <td><?= !empty($item->net_price_value) && !empty($item->net_price_currency)
                                                ? $this->Number->currency($item->net_price_value, $item->net_price_currency)
                                                : 'N/A' ?></td>
                                        <td><?= !empty($item->selected_ebay_checkout_session_item_shipping->base_delivery_cost_value) && !empty($item->selected_ebay_checkout_session_item_shipping->base_delivery_cost_currency)
                                                ? $this->Number->currency($item->selected_ebay_checkout_session_item_shipping->base_delivery_cost_value, $item->selected_ebay_checkout_session_item_shipping->base_delivery_cost_currency)
                                                : 'N/A' ?></td>
                                        <td><?= h($item->selected_ebay_checkout_session_item_shipping->min_estimated_delivery_date ?? 'N/A') ?></td>
                                        <td><?= h($item->selected_ebay_checkout_session_item_shipping->max_estimated_delivery_date ?? 'N/A') ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
