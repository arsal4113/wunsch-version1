<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Fizzy Bubbles') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Fizzy Bubble'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                <th><?= $this->Paginator->sort('url') ?></th>
                                <th><?= $this->Paginator->sort('title_text') ?></th>
                                <th><?= $this->Paginator->sort('subline_text') ?></th>
                                <th><?= $this->Paginator->sort('active') ?></th>
                                <th><?= $this->Paginator->sort('use_on') ?></th>
                                <th><?= $this->Paginator->sort('sort_order') ?></th>
                                <th><?= $this->Paginator->sort('uploaded_image_size', __('Image Upload'), ['direction' => 'desc']) ?></th>
                                <th><?= $this->Paginator->sort('start_time') ?></th>
                                <th><?= $this->Paginator->sort('end_time') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederFizzyBubbles as $feederFizzyBubble): ?>
                                <tr>
                                    <td><?= $this->Number->format($feederFizzyBubble->id) ?></td>
                                    <td><?= h($feederFizzyBubble->url) ?></td>
                                    <td><?= h($feederFizzyBubble->title_text) ?></td>
                                    <td><?= h($feederFizzyBubble->subline_text) ?></td>
                                    <td><?= h($feederFizzyBubble->active) ?></td>
                                    <td><?= h($feederFizzyBubble->use_on) ?></td>
                                    <td><?= h($feederFizzyBubble->sort_order) ?></td>
                                    <th><?= $this->Number->toReadableSize($feederFizzyBubble->uploaded_image_size) ?></th>
                                    <td><?= h($feederFizzyBubble->start_time) ?></td>
                                    <td><?= h($feederFizzyBubble->end_time) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederFizzyBubble->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederFizzyBubble->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederFizzyBubble->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederFizzyBubble->id)]) ?></li>
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
