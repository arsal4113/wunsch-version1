<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of FAQs and Answers of Help Desk') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Form->create(null, ['class' => 'form-horizontal style-form', 'type' => 'file', 'url' => ['action' => 'uploadHeaderImage']]); ?>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?= $this->Form->label(__('Header image')); ?></label>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-12"><?= $this->Form->input('image', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?></div>
                        <div class="col-12" style="text-align: left;"><?= $headerImage ?></div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Help Desk'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th><?= $this->Paginator->sort('help_desk_category_id') ?></th>
                                <th><?= $this->Paginator->sort('question') ?></th>
                                <th><?= $this->Paginator->sort('answer') ?></th>
                                <th><?= $this->Paginator->sort('sort_order') ?></th>
                                <th><?= $this->Paginator->sort('modified') ?></th>
                                <th><?= $this->Paginator->sort('created') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($helpDeskFaqs as $helpDeskFaq): ?>
                                <tr>
                                    <td><?= $this->Number->format($helpDeskFaq->id) ?></td>
                                    <td><?= $categoryNames[h($helpDeskFaq->help_desk_category_id)] ?></td>
                                    <td><?= h($helpDeskFaq->question) ?></td>
                                    <td><?= h($helpDeskFaq->answer) ?></td>
                                    <td><?= h($helpDeskFaq->sort_order) ?></td>
                                    <td><?= h($helpDeskFaq->modified) ?></td>
                                    <td><?= h($helpDeskFaq->created) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $helpDeskFaq->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $helpDeskFaq->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $helpDeskFaq->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $helpDeskFaq->id)]) ?></li>
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
