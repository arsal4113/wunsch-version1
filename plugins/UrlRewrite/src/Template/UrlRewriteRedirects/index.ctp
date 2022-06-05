<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Url Rewrite Redirects') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Url Rewrite Redirect'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?= $this->element('simple_search'); ?>

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('id') ?></th>
                                    <th><?= $this->Paginator->sort('url_rewrite_redirect_type_id') ?></th>
                                    <th><?= $this->Paginator->sort('source_url') ?></th>
                                    <th><?= $this->Paginator->sort('target_url') ?></th>
                                    <th><?= $this->Paginator->sort('creator') ?></th>
                                    <th><?= $this->Paginator->sort('timestamp') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($urlRewriteRedirects as $urlRewriteRedirect): ?>
                            <tr>
                                <td><?= $this->Number->format($urlRewriteRedirect->id) ?></td>
                                <td>
                                    <?= $urlRewriteRedirect->has('url_rewrite_redirect_type') ? h($urlRewriteRedirect->url_rewrite_redirect_type->header) : '' ?>
                                </td>
                                <td><?= h($urlRewriteRedirect->source_url) ?></td>
                                <td><?= h($urlRewriteRedirect->target_url) ?></td>
                                <td><?= h($urlRewriteRedirect->creator) ?></td>
                                <td><?= $this->Number->format($urlRewriteRedirect->timestamp) ?></td>
                                <td><?= h($urlRewriteRedirect->created) ?></td>
                                <td><?= h($urlRewriteRedirect->modified) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $urlRewriteRedirect->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $urlRewriteRedirect->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $urlRewriteRedirect->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $urlRewriteRedirect->id)]) ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $this->element('paginator'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
