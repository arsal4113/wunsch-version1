<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederGlobalPriceLimit->id) ?></h2>
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
                        <?= __('Feeder Global Price Limit') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Global Price Limit'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Global Price Limit'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Global Price Limit'), ['action' => 'edit', $feederGlobalPriceLimit->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Global Price Limit'), ['action' => 'delete', $feederGlobalPriceLimit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederGlobalPriceLimit->id)]) ?> </li>
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
                        <dd><?= h($feederGlobalPriceLimit->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Price Limit') ?>:</dt>
                        <dd><?= $this->Number->format($feederGlobalPriceLimit->price_limit) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($feederGlobalPriceLimit->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($feederGlobalPriceLimit->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
