<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Interest Subcategories') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Interest Subcategory'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('type') ?></th>
                                <th><?= $this->Paginator->sort('ids') ?></th>
                                <th><?= $this->Paginator->sort('sale_only') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederInterestSubcategories as $feederInterestSubcategory): ?>
                                <tr>
                                    <td><?= $this->Number->format($feederInterestSubcategory->id) ?></td>
                                    <td><?= h($feederInterestSubcategory->name) ?></td>
                                    <td><?= h($feederInterestSubcategory->type) ?></td>
                                    <td><?= h($feederInterestSubcategory->ids) ?></td>
                                    <td><?= h($feederInterestSubcategory->sale_only) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederInterestSubcategory->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederInterestSubcategory->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederInterestSubcategory->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederInterestSubcategory->id)]) ?></li>
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
