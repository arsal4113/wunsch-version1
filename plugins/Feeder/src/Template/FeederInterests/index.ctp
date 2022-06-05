<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Interests') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Form->create(null, ['class' => 'form-horizontal style-form', 'type' => 'file', 'url' => ['action' => 'updateMetaTags']]); ?>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label"><?= $this->Form->label(__('Meta Title')); ?></label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-12"><?= $this->Form->input('meta_title', ['label' => false, 'class' => 'form-control', 'value' => $metaTitle]) ?></div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 10px;" class="row">
                    <label class="col-sm-4 control-label"><?= $this->Form->label(__('Meta Description')); ?></label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-12"><?= $this->Form->input('meta_description', ['label' => false, 'class' => 'form-control', 'value' => $metaDescription]) ?></div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?= $this->Form->end() ?>
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Interest'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                <th><?= $this->Paginator->sort('image') ?></th>
                                <th><?= $this->Paginator->sort('sort_order') ?></th>
                                <th><?= $this->Paginator->sort('gender_id') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederInterests as $feederInterest): ?>
                                <tr>
                                    <td><?= $this->Number->format($feederInterest->id) ?></td>
                                    <td><?= h($feederInterest->name) ?></td>
                                    <td><?= h($feederInterest->image) ?></td>
                                    <td><?= h($feederInterest->sort_order) ?></td>
                                    <td><?= h($feederInterest->gender_id) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederInterest->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederInterest->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederInterest->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederInterest->id)]) ?></li>
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
