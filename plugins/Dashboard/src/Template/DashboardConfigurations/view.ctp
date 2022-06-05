<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= h($dashboardConfiguration->cell_name) ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('Dashboard Configurations') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Dashboard Configurations'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Dashboard Configuration'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Dashboard Configuration'), ['action' => 'edit', $dashboardConfiguration->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Dashboard Configuration'), ['action' => 'delete', $dashboardConfiguration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dashboardConfiguration->id)]) ?> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('General Information') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($dashboardConfiguration->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Seller Type') ?>:</dt>
                        <dd><?= $dashboardConfiguration->has('core_seller_type') ? $this->Html->link($dashboardConfiguration->core_seller_type->name, ['controller' => 'CoreSellerTypes', 'action' => 'view', $dashboardConfiguration->core_seller_type->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Seller') ?>:</dt>
                        <dd><?= $dashboardConfiguration->has('core_seller') ? $this->Html->link($dashboardConfiguration->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $dashboardConfiguration->core_seller->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('User') ?>:</dt>
                        <dd><?= $dashboardConfiguration->has('core_user') ? $this->Html->link($dashboardConfiguration->core_user->email, ['controller' => 'CoreUsers', 'action' => 'view', $dashboardConfiguration->core_user->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Cell Name') ?>:</dt>
                        <dd><?= h($dashboardConfiguration->cell_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Cell Configuration') ?>:</dt>
                        <dd><?= h($dashboardConfiguration->cell_configuration) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= h($dashboardConfiguration->sort_order) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= $this->Time->nice($dashboardConfiguration->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= $this->Time->nice($dashboardConfiguration->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
