<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($session->id) ?></h2>
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
                        <?= __('Checkout Sessions') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Checkout Sessions'), ['action' => 'indexSessions']) ?></li>
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
                        <dt><?= __('First Name') ?>:</dt>
                        <dd><?= h($session->first_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Last Name') ?>:</dt>
                        <dd><?= h($session->last_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Email') ?>:</dt>
                        <dd><?= h($session->email) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Customer Id') ?>:</dt>
                        <dd><?= $session->customer_id
                                ? $this->Html->link($session->customer_id, ['plugin' => 'ItoolCustomer', 'controller' => 'Customers', 'action' => 'view', $session->customer_id])
                                : __('Guest Order') ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Ebay Checkout Session Id') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Purchase Order Id') ?>:</dt>
                        <dd><?= h($session->purchase_order_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Order Payment Status') ?>:</dt>
                        <dd><?= h($session->order_payment_status) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Order Timestamp') ?>:</dt>
                        <dd><?= date('Y-m-d H:i:s', $session->purchase_order_timestamp) ?></dd>
                    </dl>
                    <?php if (!empty($session->ebay_checkout_session_shipping_address)) { ?>
                    <h2><?= __('Shipping') ?></h2>
                    <dl class="dl-horizontal">
                        <dt><?= __('Recipient') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_shipping_address->recipient) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Phone Number') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_shipping_address->phone_number) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Address Line 1') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_shipping_address->address_line_1) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Address Line 2') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_shipping_address->address_line_2) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Postal Code') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_shipping_address->postal_code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('City') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_shipping_address->city) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('State') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_shipping_address->state_or_province) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Country') ?>:</dt>
                        <dd><?= h($session->ebay_checkout_session_shipping_address->country) ?></dd>
                    </dl>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($session->ebay_checkout_session_items)) { ?>
        <div class="ibox">
            <div class="ibox-title">
                <h5><?= __('Related Ebay Checkout Session Items') ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
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
                            <?php foreach ($session->ebay_checkout_session_items as $item): ?>
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
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
