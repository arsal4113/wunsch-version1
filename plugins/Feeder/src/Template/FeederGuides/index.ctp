<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Guides') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Guide'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                <th><?= $this->Paginator->sort('meta_title') ?></th>
                                <th><?= $this->Paginator->sort('meta_description') ?></th>
                                <th><?= $this->Paginator->sort('robots_tag') ?></th>
                                <th><?= $this->Paginator->sort('title') ?></th>
                                <th><?= $this->Paginator->sort('description') ?></th>
                                <th><?= $this->Paginator->sort('display_animation') ?></th>
                                <th><?= $this->Paginator->sort('background_color') ?></th>
                                <th><?= $this->Paginator->sort('use_in_navigation') ?></th>
                                <th><?= $this->Paginator->sort('sort_order') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederGuides as $feederGuide): ?>
                                <tr>
                                    <td><?= $this->Number->format($feederGuide->id) ?></td>
                                    <td><?= h($feederGuide->url) ?></td>
                                    <td><?= h($feederGuide->meta_title) ?></td>
                                    <td><?= h($feederGuide->meta_description) ?></td>
                                    <td><?= h($feederGuide->robots_tag) ?></td>
                                    <td><?= h($feederGuide->title) ?></td>
                                    <td><?= h($feederGuide->description) ?></td>
                                    <td><?= h($feederGuide->display_animation) ?></td>
                                    <td><?= h($feederGuide->background_color) ?></td>
                                    <td><?= h($feederGuide->use_in_navigation) ?></td>
                                    <td><?= h($feederGuide->sort_order) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederGuide->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederGuide->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederGuide->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederGuide->id)]) ?></li>
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
