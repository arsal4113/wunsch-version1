<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= h($ebayCredential->key_set_name) ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('eBay Credentials') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of eBay Credentials'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New eBay Credential'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit eBay Credential'), ['action' => 'edit', $ebayCredential->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete eBay Credential'), ['action' => 'delete', $ebayCredential->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ebayCredential->id)]) ?> </li>
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
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($ebayCredential->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('eBay Account Type') ?>:</dt>
                        <dd><?= $ebayCredential->has('ebay_account_type') ? $this->Html->link($ebayCredential->ebay_account_type->name, ['controller' => 'EbayAccountTypes', 'action' => 'view', $ebayCredential->ebay_account_type->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Key Set Name') ?>:</dt>
                        <dd><?= h($ebayCredential->key_set_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('App Id') ?>:</dt>
                        <dd><?= h($ebayCredential->app_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Dev Id') ?>:</dt>
                        <dd><?= h($ebayCredential->dev_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Cert Id') ?>:</dt>
                        <dd><?= h($ebayCredential->cert_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Ru Name') ?>:</dt>
                        <dd><?= h($ebayCredential->ru_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($ebayCredential->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($ebayCredential->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($ebayCredential->ebay_accounts)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Ebay Accounts') ?></h5>
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
                            <th><?= __('Ebay Account Type Id') ?></th>
                            <th><?= __('Core Seller Id') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Code') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($ebayCredential->ebay_accounts as $ebayAccounts): ?>
                        <tr>
                            <td><?= h($ebayAccounts->id) ?></td>
                            <td><?= h($ebayAccounts->ebay_account_type->name) ?></td>
                            <td><?= h($ebayAccounts->core_seller->name) ?></td>
                            <td><?= ($ebayAccounts->is_active == 1) ? __('Yes') : __('No') ?></td>
                            <td><?= h($ebayAccounts->code) ?></td>
                            <td><?= h($ebayAccounts->name) ?></td>
                            <td><?= h($ebayAccounts->created) ?></td>
                            <td><?= h($ebayAccounts->modified) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => 'EbayAccounts', 'action' => 'view', $ebayAccounts->id, 'plugin' => 'Ebay']) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => 'EbayAccounts', 'action' => 'edit', $ebayAccounts->id, 'plugin' => 'Ebay']) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'EbayAccounts', 'action' => 'delete', $ebayAccounts->id, 'plugin' => 'Ebay'], ['confirm' => __('Are you sure you want to delete # {0}?', $ebayAccounts->id)]) ?>
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
