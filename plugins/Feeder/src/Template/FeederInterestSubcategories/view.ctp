<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederInterestSubcategory->id) ?></h2>
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
                        <?= __('Feeder Interest Subcategories') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Interest Subcategories'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Interest Subcategory'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Interest Subcategory'), ['action' => 'edit', $feederInterestSubcategory->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Interest Subcategory'), ['action' => 'delete', $feederInterestSubcategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederInterestSubcategory->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($feederInterestSubcategory->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($feederInterestSubcategory->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Type') ?>:</dt>
                        <dd><?= h($feederInterestSubcategory->type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __("Category numbers/ item IDs") ?>:</dt>
                        <dd><?= h($feederInterestSubcategory->ids) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sale Only') ?>:</dt>
                        <dd><?= h($feederInterestSubcategory->sale_only) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
