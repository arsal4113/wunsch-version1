<?php
/** @var \Feeder\Model\Entity\FeederCategory[] $feederCategories */
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Categories') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active">
                <strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-2">
        <div class="title-action">
            <?= $this->Form->postLink(__('Download as Csv'), ['action' => 'download'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Category'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                <th><?= $this->Paginator->sort('parent_id') ?></th>
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('category_type') ?></th>
                                <th><?= $this->Paginator->sort('template_type') ?></th>
                                <th><?= __('Animated Header') ?></th>
                                <th><?= $this->Paginator->sort('items_condition') ?></th>
                                <th><?= $this->Paginator->sort('country') ?></th>
                                <th><?= $this->Paginator->sort('qty') ?></th>
                                <th><?= $this->Paginator->sort('sort_order') ?></th>
                                <th><?= $this->Paginator->sort('uploaded_image_size', __('Image Upload'), ['direction' => 'desc']) ?></th>
                                <th><?= $this->Paginator->sort('start_time') ?></th>
                                <th><?= $this->Paginator->sort('end_time') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederCategories as $feederCategory): ?>
                                <tr>
                                    <td>
                                        <?= $feederCategory->has('parent_feeder_category') && $feederCategory->parent_feeder_category->use_in_search ? '<span class="fa fa-search" />' : '' ?>
                                        <?= $feederCategory->has('parent_feeder_category') ? $this->Html->link($feederCategory->parent_feeder_category->name, ['controller' => 'FeederCategories', 'action' => 'view', $feederCategory->parent_feeder_category->id]) : '' ?>
                                    </td>
                                    <td>
                                        <?= $feederCategory->use_in_search ? '<span class="fa fa-search" />' : '' ?>
                                        <?= $feederCategory->is_invisible ? '<span class="fa fa-eye-slash" />' : '' ?>
                                        <?= h($feederCategory->name) ?>
                                    </td>
                                    <td><?= h($feederCategory->category_type) ?></td>
                                    <td><?= h($feederCategory->template_type) ?></td>
                                    <td><?= $feederCategory->has_animated_header && $feederCategory->animated_header_text_title && $feederCategory->animated_header_text_subtitle
                                            ? __('active') : __('inactive') ?></td>
                                    <td><?= h($feederCategory->items_condition) ?></td>

                                    <?php
                                    $countryIsoCodes = [];
                                    foreach ($feederCategory->core_countries as $country) {
                                        $countryIsoCodes[] = $country->iso_code;
                                    }
                                    ?>
                                    <td><?= mb_strimwidth((implode(',', $countryIsoCodes)), 0, 17, '...') ?></td>
                                    <td><?= h($feederCategory->banner_products_factor) ?></td>
                                    <td><?= h($feederCategory->sort_order) ?></td>
                                    <th><?= $this->Number->toReadableSize($feederCategory->uploaded_image_size) ?></th>
                                    <td><?= h($feederCategory->start_time) ?></td>
                                    <td><?= h($feederCategory->end_time) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederCategory->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederCategory->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederCategory->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederCategory->id)]) ?></li>
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
