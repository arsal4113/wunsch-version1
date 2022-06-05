<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= h($coreUserRole->name) ?></h2>
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
                        <?= __('User Roles') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of User Roles'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New User Role'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit User Role'), ['action' => 'edit', $coreUserRole->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete User Role'), ['action' => 'delete', $coreUserRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreUserRole->id)]) ?> </li>
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
						<dd><?= $this->Number->format($coreUserRole->id) ?></dd>
					</dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Seller') ?>:</dt>
                        <dd><?= $coreUserRole->has('core_seller') ? $this->Html->link($coreUserRole->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $coreUserRole->core_seller->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Code') ?>:</dt>
                        <dd><?= h($coreUserRole->code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($coreUserRole->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($coreUserRole->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($coreUserRole->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($coreUserRole->core_users)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Core Users') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped table-condensed">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($coreUserRole->core_users as $coreUsers): ?>
                        <tr>
                            <td><?= h($coreUsers->id) ?></td>
                            <td><?= ($coreUsers->is_active == 1) ? "<span class=\"label label-primary\">Active</span>" : "<span class=\"label label-danger\">Inactive</span>" ?></td>
                            <td><?= h($coreUsers->email) ?></td>
                            <td><?= h($coreUsers->created) ?></td>
                            <td><?= h($coreUsers->modified) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => 'CoreUsers', 'action' => 'view', $coreUsers->id]) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CoreUsers', 'action' => 'edit', $coreUsers->id]) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'CoreUsers', 'action' => 'delete', $coreUsers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreUsers->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
