<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Hero Items') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Hero Item'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('type') ?></th>
                                    <th><?= $this->Paginator->sort('webm') ?> | <?= $this->Paginator->sort('mp4') ?> | <?= $this->Paginator->sort('image') ?></th>
                                    <th><?= $this->Paginator->sort('item_id') ?></th>
                                    <th><?= $this->Paginator->sort('url') ?></th>
                                    <th><?= $this->Paginator->sort('gender_id') ?></th>
                                    <th><?= $this->Paginator->sort('is_active') ?></th>
                                    <th><?= $this->Paginator->sort('sort_order') ?></th>
                                    <th><?= $this->Paginator->sort('start_time') ?></th>
                                    <th><?= $this->Paginator->sort('end_time') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederHeroItems as $feederHeroItem): ?>
                            <tr>
                                <td><?= h($feederHeroItem->type) ?></td>
                                <td>
                                    <?= __('Webm:') ?> <?= h($feederHeroItem->webm) ?><br>
                                    <?= __('Mp4:') ?> <?= h($feederHeroItem->mp4) ?><br>
                                    <?= __('Image:') ?> <?= h($feederHeroItem->image) ?>
                                </td>
                                <td><?= h($feederHeroItem->item_id) ?></td>
                                <td><?= h($feederHeroItem->url) ?></td>
                                <td><?= h($feederHeroItem->customer_gender->gender) ?></td>
                                <td><?= h($feederHeroItem->is_active) ?></td>
                                <td><?= $this->Number->format($feederHeroItem->sort_order) ?></td>
                                <td><?= h($feederHeroItem->start_time) ?></td>
                                <td><?= h($feederHeroItem->end_time) ?></td>
                                <td><?= h($feederHeroItem->modified) ?></td>
                                <td><?= h($feederHeroItem->created) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederHeroItem->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederHeroItem->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederHeroItem->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederHeroItem->id)]) ?></li>
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
