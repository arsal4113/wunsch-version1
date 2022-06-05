<?php
/**
 * @var \Cake\Datasource\EntityInterface $feederUspBar
 */
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederUspBar->id) ?></h2>
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
                        <?= __('Feeder USB Bar') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of USP Bar text'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add a New USP Bar Text'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit USP Bar Text'), ['action' => 'edit', $feederUspBar->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete USP Bar Text'), ['action' => 'delete', $feederUspBar->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederUspBar->id)]) ?> </li>
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
                        <dt><?= __('Usp Text') ?>:</dt>
                        <dd><?= h($feederUspBar->usp_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= h($feederUspBar->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= $this->Number->format($feederUspBar->sort_order) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($feederUspBar->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($feederUspBar->created) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

