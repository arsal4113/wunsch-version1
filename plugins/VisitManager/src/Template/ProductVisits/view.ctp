<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($productVisit->id) ?></h2>
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
                        <?= __('Product Visits') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Product Visits'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Product Visit'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Product Visit'), ['action' => 'edit', $productVisit->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Product Visit'), ['action' => 'delete', $productVisit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productVisit->id)]) ?> </li>
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
                        <dt><?= __('User Session') ?>:</dt>
                        <dd><?= h($productVisit->user_session) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Marketplace Product') ?>:</dt>
                        <dd><?= h($productVisit->marketplace_product) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Marketplace Name') ?>:</dt>
                        <dd><?= h($productVisit->marketplace_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Search Term') ?>:</dt>
                        <dd><?= h($productVisit->search_term) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($productVisit->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Position') ?>:</dt>
                        <dd><?= $this->Number->format($productVisit->position) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Marketplace Category') ?>:</dt>
                        <dd><?= $this->Number->format($productVisit->marketplace_category) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Hits') ?>:</dt>
                        <dd><?= $this->Number->format($productVisit->hits) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Group') ?>:</dt>
                        <dd><?= h($productVisit->user_group) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($productVisit->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($productVisit->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
