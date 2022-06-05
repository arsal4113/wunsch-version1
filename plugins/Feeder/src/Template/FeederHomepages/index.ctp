<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Homepages') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Homepage'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('big_banner_image') ?></th>
                                    <th><?= $this->Paginator->sort('big_banner_link') ?></th>
                                    <th><?= $this->Paginator->sort('first_small_banner_image') ?></th>
                                    <th><?= $this->Paginator->sort('first_small_banner_link') ?></th>
                                    <th><?= $this->Paginator->sort('second_small_banner_image') ?></th>
                                    <th><?= $this->Paginator->sort('second_small_banner_link') ?></th>
                                    <th><?= $this->Paginator->sort('third_small_banner_image') ?></th>
                                    <th><?= $this->Paginator->sort('third_small_banner_link') ?></th>
                                    <th><?= $this->Paginator->sort('fourth_small_banner_image') ?></th>
                                    <th><?= $this->Paginator->sort('fourth_small_banner_link') ?></th>
                                    <th><?= $this->Paginator->sort('surprise_item_ids') ?></th>
                                    <th><?= $this->Paginator->sort('feeder_category_id') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederHomepages as $feederHomepage): ?>
                            <tr>
                                <td><?= $this->Number->format($feederHomepage->id) ?></td>
                                <td><?= h($feederHomepage->big_banner_image) ?></td>
                                <td><?= h($feederHomepage->big_banner_link) ?></td>
                                <td><?= h($feederHomepage->first_small_banner_image) ?></td>
                                <td><?= h($feederHomepage->first_small_banner_link) ?></td>
                                <td><?= h($feederHomepage->second_small_banner_image) ?></td>
                                <td><?= h($feederHomepage->second_small_banner_link) ?></td>
                                <td><?= h($feederHomepage->third_small_banner_image) ?></td>
                                <td><?= h($feederHomepage->third_small_banner_link) ?></td>
                                <td><?= h($feederHomepage->fourth_small_banner_image) ?></td>
                                <td><?= h($feederHomepage->fourth_small_banner_link) ?></td>
                                <td><?= h($feederHomepage->surprise_item_ids) ?></td>
                                <td>
                                    <?= $feederHomepage->has('feeder_category') ? $this->Html->link($feederHomepage->feeder_category->name, ['controller' => 'FeederCategories', 'action' => 'view', $feederHomepage->feeder_category->id]) : '' ?>
                                </td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederHomepage->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederHomepage->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederHomepage->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederHomepage->id)]) ?></li>
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
