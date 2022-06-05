<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($urlRewriteRoute->id) ?></h2>
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
                        <?= __('Url Rewrite Routes') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Url Rewrite Routes'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Url Rewrite Route'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Url Rewrite Route'), ['action' => 'edit', $urlRewriteRoute->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Url Rewrite Route'), ['action' => 'delete', $urlRewriteRoute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $urlRewriteRoute->id)]) ?> </li>
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
                        <dt><?= __('Target Url') ?>:</dt>
                        <dd><?= h($urlRewriteRoute->target_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Plugin') ?>:</dt>
                        <dd><?= h($urlRewriteRoute->plugin) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Controller') ?>:</dt>
                        <dd><?= h($urlRewriteRoute->controller) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Action') ?>:</dt>
                        <dd><?= h($urlRewriteRoute->action) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Args') ?>:</dt>
                        <dd><?= h($urlRewriteRoute->args) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Creator') ?>:</dt>
                        <dd><?= h($urlRewriteRoute->creator) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($urlRewriteRoute->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Timestamp') ?>:</dt>
                        <dd><?= $this->Number->format($urlRewriteRoute->timestamp) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($urlRewriteRoute->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($urlRewriteRoute->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
