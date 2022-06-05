<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Sellers') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Seller'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?= $this->element('advanced_search'); ?>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('id') ?></th>
                                    <th><?= $this->Paginator->sort('code') ?></th>
                                    <th><?= $this->Paginator->sort('name') ?></th>
                                    <th><?= $this->Paginator->sort('core_seller_type_id', __('Seller Type')) ?></th>
                                    <th><?= $this->Paginator->sort('core_language_id', __('Language')) ?></th>
                                    <th><?= $this->Paginator->sort('core_country_id', __('Country')) ?></th>
                                    <th><?= $this->Paginator->sort('is_active', __('Status')) ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($coreSellers as $coreSeller): ?>
                            <tr>
                                <td><?= $this->Number->format($coreSeller->id) ?></td>
                                <td><?= h($coreSeller->code) ?></td>
                                <td><?= h($coreSeller->name) ?></td>
                                <td>
                                    <?= $coreSeller->has('core_seller_type') ? $this->Html->link($coreSeller->core_seller_type->name, ['controller' => 'CoreSellerTypes', 'action' => 'view', $coreSeller->core_seller_type->id]) : '' ?>
                                </td>
                                <td>
                                    <?= $coreSeller->has('core_language') ? $this->Html->link($coreSeller->core_language->name, ['controller' => 'CoreLanguages', 'action' => 'view', $coreSeller->core_language->id]) : '' ?>
                                </td>
                                <td>
                                    <?= $coreSeller->has('core_country') ? $this->Html->link($coreSeller->core_country->name, ['controller' => 'CoreCountries', 'action' => 'view', $coreSeller->core_country->id]) : '' ?>
                                </td>
                                <td><?= ($coreSeller->is_active == 1) ? "<span class=\"label label-primary\">Active</span>" : "<span class=\"label label-danger\">Inactive</span>" ?></td>
                                <td><?= $this->Time->nice($coreSeller->created) ?></td>
                                <td><?= $this->Time->nice($coreSeller->modified) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $coreSeller->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $coreSeller->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $coreSeller->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $coreSeller->id)]) ?></li>
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
