<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= h($coreCustomer->firstname) . ' ' . h($coreCustomer->lastname) ?></h2>
        <ol class="breadcrumb">
            <li><?= __('Customers') ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('Customers') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Customers'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Customer'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $coreCustomer->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $coreCustomer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreCustomer->id)]) ?> </li>
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
                        <dt><?= __('Seller') ?>:</dt>
                        <dd><?= $coreCustomer->has('core_seller') ? $this->Html->link($coreCustomer->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $coreCustomer->core_seller->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Firstname') ?>:</dt>
                        <dd><?= h($coreCustomer->firstname) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Lastname') ?>:</dt>
                        <dd><?= h($coreCustomer->lastname) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Email') ?>:</dt>
                        <dd><?= h($coreCustomer->email) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= $this->Time->nice($coreCustomer->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= $this->Time->nice($coreCustomer->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

