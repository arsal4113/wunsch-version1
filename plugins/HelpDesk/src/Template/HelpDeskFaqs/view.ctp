<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($helpDeskFaq->id) ?></h2>
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
                        <?= __('Help Desk Faqs') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Help Desk'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Help Desk'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Help Desk'), ['action' => 'edit', $helpDeskFaq->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Help Desk'), ['action' => 'delete', $helpDeskFaq->id], ['confirm' => __('Are you sure you want to delete # {0}?', $helpDeskFaq->id)]) ?> </li>
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
                        <dt><?= __('Question') ?>:</dt>
                        <dd><?= h($helpDeskFaq->question) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Answer') ?>:</dt>
                        <dd><?= h($helpDeskFaq->answer) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Help Desk Category') ?>:</dt>
                        <dd><?= $categoryNames[h($helpDeskFaq->help_desk_category_id)] ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($helpDeskFaq->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= $this->Number->format($helpDeskFaq->sort_order) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($helpDeskFaq->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($helpDeskFaq->created) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
