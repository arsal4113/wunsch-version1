<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= h($ebayAccount->name) ?></h2>
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
                        <?= __('eBay Accounts') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of eBay Accounts'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New eBay Account'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit eBay Account'), ['action' => 'edit', $ebayAccount->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete eBay Account'), ['action' => 'delete', $ebayAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ebayAccount->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($ebayAccount->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('eBay Account Type') ?>:</dt>
                        <dd><?= $ebayAccount->has('ebay_account_type') ? $this->Html->link($ebayAccount->ebay_account_type->name, ['controller' => 'EbayAccountTypes', 'action' => 'view', $ebayAccount->ebay_account_type->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('eBay Credential') ?>:</dt>
                        <dd><?= $ebayAccount->has('ebay_credential') ? $this->Html->link($ebayAccount->ebay_credential->key_set_name, ['controller' => 'EbayCredentials', 'action' => 'view', $ebayAccount->ebay_credential->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Seller') ?>:</dt>
                        <dd><?= $ebayAccount->has('core_seller') ? $this->Html->link($ebayAccount->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $ebayAccount->core_seller->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Code') ?>:</dt>
                        <dd><?= h($ebayAccount->Code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($ebayAccount->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('ePN Identifier') ?>:</dt>
                        <dd><?= h($ebayAccount->epn_identifier) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Is Active') ?>:</dt>
                        <dd><?= ($ebayAccount->is_active == 1) ? __('Yes') : __('No') ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Token') ?>:</dt>
                        <dd><?= $this->Text->truncate(h($ebayAccount->token), 100, ['ellipsis' => '...']); ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($ebayAccount->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($ebayAccount->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
