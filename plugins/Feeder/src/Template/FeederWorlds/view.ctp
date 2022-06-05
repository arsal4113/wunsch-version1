<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederWorld->name) ?></h2>
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
                        <?= __('Feeder Worlds') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Worlds'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder World'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder World'), ['action' => 'edit', $feederWorld->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder World'), ['action' => 'delete', $feederWorld->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederWorld->id)]) ?> </li>
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
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($feederWorld->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image') ?>:</dt>
                        <dd><?= h($feederWorld->image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image Alt Tag') ?>:</dt>
                        <dd><?= h($feederWorld->image_alt_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image Title Tag') ?>:</dt>
                        <dd><?= h($feederWorld->image_title_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Link') ?>:</dt>
                        <dd><?= h($feederWorld->link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Button Text') ?>:</dt>
                        <dd><?= h($feederWorld->button_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederWorld->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= $this->Number->format($feederWorld->sort_order) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($feederWorld->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($feederWorld->created) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
