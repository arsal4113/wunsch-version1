<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Core Errors') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
        <?= $this->Form->create(null, ['class' => 'form-horizontal style-form', 'url' => ['action' => 'download']]); ?>
            <div class="form-group">
                <label class="col-sm-6 control-label"><?= $this->Form->label(__('start_time')); ?></label>
                <div class="col-sm-6">
                <?= $this->Form->control('startTime',
                    ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'default' => null,
                    'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-6 control-label"><?= $this->Form->label(__('end_time')); ?></label>
                <div class="col-sm-6">
                    <?= $this->Form->control('endTime',
                        ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'default' => null,
                            'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                </div>
            </div>
            <div class="form-group">
                <?= $this->Form->button(__('Download as Csv'), ['class' => 'btn btn-sm btn-primary']) ?>
            </div>
        <?= $this->Form->end() ?>
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
                                    <th><?= $this->Paginator->sort('type') ?></th>
                                    <th><?= $this->Paginator->sort('code') ?></th>
                                    <th><?= $this->Paginator->sort('message') ?></th>
                                    <th><?= $this->Paginator->sort('rlogid') ?></th>
                                    <th><?= $this->Paginator->sort('ebay_checkout_session_id') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($coreErrors as $coreError): ?>
                            <tr>
                                <td><?= $this->Number->format($coreError->id) ?></td>
                                <td><?= h($coreError->type) ?></td>
                                <td><?= h($coreError->code) ?></td>
                                <td><?= $this->Text->autoParagraph(h($coreError->message)) ?></td>
                                <td><?= h($coreError->rlogid) ?></td>
                                <td><?= h($coreError->ebay_checkout_session_id) ?></td>
                                <td><?= h($coreError->created) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $coreError->id], ['escape' => false]) ?></li>
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
