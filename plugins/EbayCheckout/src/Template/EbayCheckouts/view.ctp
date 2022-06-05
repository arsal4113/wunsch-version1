<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($ebayCheckout->name) ?></h2>
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
                        <?= __('Ebay Checkouts') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Ebay Checkouts'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Ebay Checkout'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Ebay Checkout'), ['action' => 'edit', $ebayCheckout->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Ebay Checkout'), ['action' => 'delete', $ebayCheckout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ebayCheckout->id)]) ?> </li>
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
                        <dt><?= __('Core Seller') ?>:</dt>
                        <dd><?= $ebayCheckout->has('core_seller') ? $this->Html->link($ebayCheckout->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $ebayCheckout->core_seller->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($ebayCheckout->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Title') ?>:</dt>
                        <dd><?= h($ebayCheckout->title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('X Frame Origins') ?>:</dt>
                        <dd><?= h($ebayCheckout->x_frame_origins) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Logo') ?>:</dt>
                        <dd><?= h($ebayCheckout->logo) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Main Color') ?>:</dt>
                        <dd><?= h($ebayCheckout->main_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Color') ?>:</dt>
                        <dd><?= h($ebayCheckout->second_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Font') ?>:</dt>
                        <dd><?= h($ebayCheckout->font) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Font Color') ?>:</dt>
                        <dd><?= h($ebayCheckout->font_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Background Image') ?>:</dt>
                        <dd><?= h($ebayCheckout->background_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Background Image Position') ?>:</dt>
                        <dd><?= h($ebayCheckout->background_image_position) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Background Color') ?>:</dt>
                        <dd><?= h($ebayCheckout->background_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($ebayCheckout->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($ebayCheckout->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($ebayCheckout->created) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($ebayCheckout->ebay_checkout_sessions)) { ?>
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
                            <th><?= __('Id') ?></th>
                            <th><?= __('Core Seller Id') ?></th>
                            <th><?= __('Core Order Id') ?></th>
                            <th><?= __('Purchase Order Id') ?></th>
                            <th><?= __('Ebay Checkout Id') ?></th>
                            <th><?= __('Selected Ebay Checkout Session Payment Id') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Session Token') ?></th>
                            <th><?= __('Ebay Checkout Session Id') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($ebayCheckout->ebay_checkout_sessions as $ebayCheckoutSessions): ?>
                        <tr>
                            <td><?= h($ebayCheckoutSessions->id) ?></td>
                            <td><?= h($ebayCheckoutSessions->core_seller_id) ?></td>
                            <td><?= h($ebayCheckoutSessions->core_order_id) ?></td>
                            <td><?= h($ebayCheckoutSessions->purchase_order_id) ?></td>
                            <td><?= h($ebayCheckoutSessions->ebay_checkout_id) ?></td>
                            <td><?= h($ebayCheckoutSessions->selected_ebay_checkout_session_payment_id) ?></td>
                            <td><?= h($ebayCheckoutSessions->type) ?></td>
                            <td><?= h($ebayCheckoutSessions->session_token) ?></td>
                            <td><?= h($ebayCheckoutSessions->ebay_checkout_session_id) ?></td>
                            <td><?= h($ebayCheckoutSessions->email) ?></td>
                            <td><?= h($ebayCheckoutSessions->first_name) ?></td>
                            <td><?= h($ebayCheckoutSessions->last_name) ?></td>
                            <td><?= h($ebayCheckoutSessions->modified) ?></td>
                            <td><?= h($ebayCheckoutSessions->created) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => 'EbayCheckoutSessions', 'action' => 'view', $ebayCheckoutSessions->id]) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => 'EbayCheckoutSessions', 'action' => 'edit', $ebayCheckoutSessions->id]) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'EbayCheckoutSessions', 'action' => 'delete', $ebayCheckoutSessions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ebayCheckoutSessions->id)]) ?>
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
