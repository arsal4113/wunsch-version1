<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($urlRewriteRedirectType->name) ?></h2>
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
                        <?= __('Url Rewrite Redirect Types') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Url Rewrite Redirect Types'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Url Rewrite Redirect Type'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Url Rewrite Redirect Type'), ['action' => 'edit', $urlRewriteRedirectType->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Url Rewrite Redirect Type'), ['action' => 'delete', $urlRewriteRedirectType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $urlRewriteRedirectType->id)]) ?> </li>
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
                        <dd><?= h($urlRewriteRedirectType->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Header') ?>:</dt>
                        <dd><?= h($urlRewriteRedirectType->header) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($urlRewriteRedirectType->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Code') ?>:</dt>
                        <dd><?= $this->Number->format($urlRewriteRedirectType->code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($urlRewriteRedirectType->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($urlRewriteRedirectType->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($urlRewriteRedirectType->url_rewrite_redirects)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Url Rewrite Redirects') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Url Rewrite Redirect Type Id') ?></th>
                            <th><?= __('Source Url') ?></th>
                            <th><?= __('Target Url') ?></th>
                            <th><?= __('Creator') ?></th>
                            <th><?= __('Timestamp') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($urlRewriteRedirectType->url_rewrite_redirects as $urlRewriteRedirects): ?>
                        <tr>
                            <td><?= h($urlRewriteRedirects->id) ?></td>
                            <td><?= h($urlRewriteRedirects->url_rewrite_redirect_type_id) ?></td>
                            <td><?= h($urlRewriteRedirects->source_url) ?></td>
                            <td><?= h($urlRewriteRedirects->target_url) ?></td>
                            <td><?= h($urlRewriteRedirects->creator) ?></td>
                            <td><?= h($urlRewriteRedirects->timestamp) ?></td>
                            <td><?= h($urlRewriteRedirects->created) ?></td>
                            <td><?= h($urlRewriteRedirects->modified) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => 'UrlRewriteRedirects', 'action' => 'view', $urlRewriteRedirects->id]) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UrlRewriteRedirects', 'action' => 'edit', $urlRewriteRedirects->id]) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UrlRewriteRedirects', 'action' => 'delete', $urlRewriteRedirects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $urlRewriteRedirects->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
