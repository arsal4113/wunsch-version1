<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Zip Data Zips') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Form->create(null, ['class' => 'form-horizontal style-form', 'type' => 'file', 'url' => 'zip-data/zip-data-zips/import']); ?>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?= $this->Form->label(__('File Upload')); ?></label>
                <div class="col-sm-6">
                    <?= $this->Form->input('import_file', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Zip Data Zip'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('code') ?></th>
                                    <th><?= $this->Paginator->sort('city') ?></th>
                                    <th><?= $this->Paginator->sort('area') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($zipDataZips as $zipDataZip): ?>
                            <tr>
                                <td><?= $this->Number->format($zipDataZip->id) ?></td>
                                <td><?= h($zipDataZip->code) ?></td>
                                <td><?= h($zipDataZip->city) ?></td>
                                <td><?= h($zipDataZip->area) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $zipDataZip->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $zipDataZip->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $zipDataZip->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $zipDataZip->id)]) ?></li>
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
