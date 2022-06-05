<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= h($ebaySite->name) ?></h2>
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
                        <?= __('eBay Sites') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of eBay Sites'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New eBay Site'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit eBay Site'), ['action' => 'edit', $ebaySite->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete eBay Site'), ['action' => 'delete', $ebaySite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ebaySite->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($ebaySite->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($ebaySite->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Language') ?>:</dt>
                        <dd><?= h($ebaySite->language) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('eBay Global Id') ?>:</dt>
                        <dd><?= h($ebaySite->ebay_global_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Currency') ?>:</dt>
                        <dd><?= $ebaySite->has('core_currency') ? $this->Html->link($ebaySite->core_currency->name, ['controller' => 'CoreCurrencies', 'action' => 'view', $ebaySite->core_currency->id, 'plugin' => false]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('eBay Site Id') ?>:</dt>
                        <dd><?= $this->Number->format($ebaySite->ebay_site_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Is Active') ?>:</dt>
                        <dd><?= ($ebaySite->is_active == 1) ? __('Yes') : __('No') ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($ebaySite->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($ebaySite->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
