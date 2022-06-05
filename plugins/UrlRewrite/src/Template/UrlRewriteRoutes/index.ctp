<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Url Rewrite Routes') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Url Rewrite Route'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('target_url') ?></th>
                                    <th><?= $this->Paginator->sort('plugin') ?></th>
                                    <th><?= $this->Paginator->sort('controller') ?></th>
                                    <th><?= $this->Paginator->sort('action') ?></th>
                                    <th><?= $this->Paginator->sort('args') ?></th>
                                    <th><?= $this->Paginator->sort('creator') ?></th>
                                    <th><?= $this->Paginator->sort('timestamp') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($urlRewriteRoutes as $urlRewriteRoute): ?>
                            <tr>
                                <td><?= $this->Number->format($urlRewriteRoute->id) ?></td>
                                <td><?= h($urlRewriteRoute->target_url) ?></td>
                                <td><?= h($urlRewriteRoute->plugin) ?></td>
                                <td><?= h($urlRewriteRoute->controller) ?></td>
                                <td><?= h($urlRewriteRoute->action) ?></td>
                                <td><?= h($urlRewriteRoute->args) ?></td>
                                <td><?= h($urlRewriteRoute->creator) ?></td>
                                <td><?= $this->Number->format($urlRewriteRoute->timestamp) ?></td>
                                <td><?= h($urlRewriteRoute->created) ?></td>
                                <td><?= h($urlRewriteRoute->modified) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $urlRewriteRoute->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $urlRewriteRoute->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $urlRewriteRoute->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $urlRewriteRoute->id)]) ?></li>
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
