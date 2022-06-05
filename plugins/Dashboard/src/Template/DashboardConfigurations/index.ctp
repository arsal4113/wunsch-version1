<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('List of Dashboard Configurations') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Dashboard Configuration'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('core_seller_type_id', __('Seller Type')) ?></th>
                                    <th><?= $this->Paginator->sort('core_seller_id', __('Seller')) ?></th>
                                    <th><?= $this->Paginator->sort('core_user_id', __('User')) ?></th>
                                    <th><?= $this->Paginator->sort('cell_name') ?></th>
                                    <th><?= $this->Paginator->sort('cell_configuration') ?></th>
                                    <th><?= $this->Paginator->sort('sort_order') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dashboardConfigurations as $dashboardConfiguration): ?>
                            <tr>
                                <td><?= $this->Number->format($dashboardConfiguration->id) ?></td>
                                <td>
                                    <?= $dashboardConfiguration->has('core_seller_type') ? $this->Html->link($dashboardConfiguration->core_seller_type->name, ['controller' => 'CoreSellerTypes', 'action' => 'view', $dashboardConfiguration->core_seller_type->id]) : '' ?>
                                </td>
                                <td>
                                    <?= $dashboardConfiguration->has('core_seller') ? $this->Html->link($dashboardConfiguration->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $dashboardConfiguration->core_seller->id]) : '' ?>
                                </td>
                                <td>
                                    <?= $dashboardConfiguration->has('core_user') ? $this->Html->link($dashboardConfiguration->core_user->email, ['controller' => 'CoreUsers', 'action' => 'view', $dashboardConfiguration->core_user->id]) : '' ?>
                                </td>
                                <td><?= h($dashboardConfiguration->cell_name) ?></td>
                                <td><?= h($dashboardConfiguration->cell_configuration) ?></td>
                                <td><?= h($dashboardConfiguration->sort_order) ?></td>
                                <td><?= $this->Time->nice($dashboardConfiguration->created) ?></td>
                                <td><?= $this->Time->nice($dashboardConfiguration->modified) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $dashboardConfiguration->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $dashboardConfiguration->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $dashboardConfiguration->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $dashboardConfiguration->id)]) ?></li>
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
