<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2><?= $coreUser->email ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-primary dropdown-toggle" type="button">
                        <?= __('Users') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of users'), ['controller' => 'CoreUsers', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add new user'), ['controller' => 'CoreUsers', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit user'), ['controller' => 'CoreUsers', 'action' => 'edit', $coreUser->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete user'), ['action' => 'delete', $coreUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreUser->id)]) ?> </li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('Sellers') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of sellers'), ['controller' => 'CoreSellers', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add new seller'), ['controller' => 'CoreSellers', 'action' => 'add']) ?></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('User Roles') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of user roles'), ['controller' => 'CoreUserRoles', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add new user role'), ['controller' => 'CoreUserRoles', 'action' => 'add']) ?></li>
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
                        <dt><?= __('ID') ?>:</dt>
                        <dd><?= h($coreUser->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Status') ?>:</dt>
                        <dd><?= $coreUser->is_active ? "<span class=\"label label-primary\">Active</span>" : "<span class=\"label label-danger\">Inactive</span>"; ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Seller') ?>:</dt>
                        <dd><?= $coreUser->has('core_seller') ? $this->Html->link($coreUser->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $coreUser->core_seller->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Email') ?>:</dt>
                        <dd><?= h($coreUser->email) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($coreUser->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($coreUser->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($coreUser->core_user_roles)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related User Roles') ?></h5>
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
                            <th><?= __('Code') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions centered"></th>
                        </tr>
                        <?php foreach ($coreUser->core_user_roles as $coreUserRoles): ?>
                            <tr>
                                <td><?= h($coreUserRoles->id) ?></td>
                                <td><?= h($coreUserRoles->code) ?></td>
                                <td><?= h($coreUserRoles->name) ?></td>
                                <td><?= h($coreUserRoles->created) ?></td>
                                <td><?= h($coreUserRoles->modified) ?></td>

                                <td class="actions centered">
                                    <?= $this->Html->link(__('View'), ['controller' => 'CoreUserRoles', 'action' => 'view', $coreUserRoles->id]) ?> |
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'CoreUserRoles', 'action' => 'edit', $coreUserRoles->id]) ?> |
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CoreUserRoles', 'action' => 'delete', $coreUserRoles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreUserRoles->id)]) ?>
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