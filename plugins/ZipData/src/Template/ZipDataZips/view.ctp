<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($zipDataZip->id) ?></h2>
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
                        <?= __('Zip Data Zips') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Zip Data Zips'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Zip Data Zip'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Zip Data Zip'), ['action' => 'edit', $zipDataZip->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Zip Data Zip'), ['action' => 'delete', $zipDataZip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $zipDataZip->id)]) ?> </li>
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
                        <dt><?= __('Code') ?>:</dt>
                        <dd><?= h($zipDataZip->code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('City') ?>:</dt>
                        <dd><?= h($zipDataZip->city) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area') ?>:</dt>
                        <dd><?= h($zipDataZip->area) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($zipDataZip->id) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
