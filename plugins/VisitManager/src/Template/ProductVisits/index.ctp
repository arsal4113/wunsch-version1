<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Product Visits') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Product Visit'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('user_session') ?></th>
                                    <th><?= $this->Paginator->sort('marketplace_product') ?></th>
                                    <th><?= $this->Paginator->sort('marketplace_name') ?></th>
                                    <th><?= $this->Paginator->sort('search_term') ?></th>
                                    <th><?= $this->Paginator->sort('position') ?></th>
                                    <th><?= $this->Paginator->sort('marketplace_category') ?></th>
                                    <th><?= $this->Paginator->sort('hits') ?></th>
                                    <th><?= $this->Paginator->sort('user_group') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($productVisits as $productVisit): ?>
                            <tr>
                                <td><?= $this->Number->format($productVisit->id) ?></td>
                                <td><?= h($productVisit->user_session) ?></td>
                                <td><?= h($productVisit->marketplace_product) ?></td>
                                <td><?= h($productVisit->marketplace_name) ?></td>
                                <td><?= h($productVisit->search_term) ?></td>
                                <td><?= $this->Number->format($productVisit->position) ?></td>
                                <td><?= $this->Number->format($productVisit->marketplace_category) ?></td>
                                <td><?= $this->Number->format($productVisit->hits) ?></td>
                                <td><?= h($productVisit->user_group) ?></td>
                                <td><?= h($productVisit->created) ?></td>
                                <td><?= h($productVisit->modified) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $productVisit->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $productVisit->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $productVisit->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $productVisit->id)]) ?></li>
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
