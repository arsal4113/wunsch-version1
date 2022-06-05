<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($urlRewriteRedirect->id) ?></h2>
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
                        <?= __('Url Rewrite Redirects') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Url Rewrite Redirects'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Url Rewrite Redirect'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Url Rewrite Redirect'), ['action' => 'edit', $urlRewriteRedirect->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Url Rewrite Redirect'), ['action' => 'delete', $urlRewriteRedirect->id], ['confirm' => __('Are you sure you want to delete # {0}?', $urlRewriteRedirect->id)]) ?> </li>
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
                        <dt><?= __('Url Rewrite Redirect Type') ?>:</dt>
                        <dd><?= $urlRewriteRedirect->has('url_rewrite_redirect_type') ? $this->Html->link($urlRewriteRedirect->url_rewrite_redirect_type->name, ['controller' => 'UrlRewriteRedirectTypes', 'action' => 'view', $urlRewriteRedirect->url_rewrite_redirect_type->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Source Url') ?>:</dt>
                        <dd><?= h($urlRewriteRedirect->source_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Target Url') ?>:</dt>
                        <dd><?= h($urlRewriteRedirect->target_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Creator') ?>:</dt>
                        <dd><?= h($urlRewriteRedirect->creator) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($urlRewriteRedirect->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Timestamp') ?>:</dt>
                        <dd><?= $this->Number->format($urlRewriteRedirect->timestamp) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($urlRewriteRedirect->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($urlRewriteRedirect->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
