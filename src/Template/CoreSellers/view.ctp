<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= h($coreSeller->name) ?></h2>
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
                        <?= __('Sellers') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Sellers'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Seller'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Seller'), ['action' => 'edit', $coreSeller->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Seller'), ['action' => 'delete', $coreSeller->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreSeller->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($coreSeller->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Status') ?>:</dt>
                        <dd><?= $coreSeller->is_active ? "<span class=\"label label-primary\">Active</span>" : "<span class=\"label label-danger\">Inactive</span>"; ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Code') ?>:</dt>
                        <dd><?= h($coreSeller->code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($coreSeller->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Language') ?>:</dt>
                        <dd><?= $coreSeller->has('core_language') ? $this->Html->link($coreSeller->core_language->name, ['controller' => 'CoreLanguages', 'action' => 'view', $coreSeller->core_language->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Country') ?>:</dt>
                        <dd><?= $coreSeller->has('core_country') ? $this->Html->link($coreSeller->core_country->name, ['controller' => 'CoreCountries', 'action' => 'view', $coreSeller->core_country->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Uuid') ?>:</dt>
                        <dd><?= h($coreSeller->uuid) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= $this->Time->nice($coreSeller->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= $this->Time->nice($coreSeller->modified) ?></dd>
                    </dl>

                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($coreSeller->core_user_roles)) { ?>
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
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($coreSeller->core_user_roles as $coreUserRoles): ?>
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
    <?php if (!empty($coreSeller->core_users)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Users') ?></h5>
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
                            <th><?= __('Status') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($coreSeller->core_users as $coreUsers): ?>
                        <tr>
                            <td><?= h($coreUsers->id) ?></td>
                            <td><?= ($coreUsers->is_active) ? "<span class=\"label label-primary\">Active</span>" : "<span class=\"label label-danger\">Inactive</span>"; ?></td>
                            <td><?= h($coreUsers->email) ?></td>
                            <td><?= h($coreUsers->created) ?></td>
                            <td><?= h($coreUsers->modified) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('Login As'), ['controller' => 'CoreUsers', 'action' => 'loginAs', $coreUsers->id]) ?> |
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
