<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($coreError->id) ?></h2>
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
                        <?= __('Core Errors') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Core Errors'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Core Error'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Core Error'), ['action' => 'edit', $coreError->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Core Error'), ['action' => 'delete', $coreError->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreError->id)]) ?> </li>
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
                        <dd><?= $coreError->has('core_seller') ? $this->Html->link($coreError->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $coreError->core_seller->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Type') ?>:</dt>
                        <dd><?= h($coreError->type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Code') ?>:</dt>
                        <dd><?= h($coreError->code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sub Code') ?>:</dt>
                        <dd><?= h($coreError->sub_code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('rlogid') ?>:</dt>
                        <dd><?= h($coreError->rlogid) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('EbayCheckoutSessionID') ?>:</dt>
                        <dd><?= h($coreError->ebay_checkout_session_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Foreign Key') ?>:</dt>
                        <dd><?= h($coreError->foreign_key) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Foreign Model') ?>:</dt>
                        <dd><?= h($coreError->foreign_model) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($coreError->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($coreError->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($coreError->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Message') ?>:</dt>
                        <dd><?= $this->Text->autoParagraph(h($coreError->message)); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
