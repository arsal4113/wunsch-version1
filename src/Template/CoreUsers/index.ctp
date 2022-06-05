<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Users') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active">
                <strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add new user'), ['action' => 'add', 'plugin' => false, 'prefix' => false], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('Sellers') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of sellers'), ['controller' => 'CoreSellers', 'action' => 'index', 'plugin' => false, 'prefix' => false]) ?></li>
                        <li><?= $this->Html->link(__('Add new seller'), ['controller' => 'CoreSellers', 'action' => 'add', 'plugin' => false, 'prefix' => false]) ?></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('User Roles') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of user roles'), ['controller' => 'CoreUserRoles', 'action' => 'index', 'plugin' => false, 'prefix' => false]) ?></li>
                        <li><?= $this->Html->link(__('Add new user role'), ['controller' => 'CoreUserRoles', 'action' => 'add', 'plugin' => false, 'prefix' => false]) ?></li>
                    </ul>
                </div>
            </div>
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
                                <th class="centered"><?= $this->Paginator->sort('is_active', __('Status')) ?></th>
                                <th><?= $this->Paginator->sort('core_seller_id', __('Seller')) ?></th>
                                <th><?= $this->Paginator->sort('email') ?></th>
                                <th><?= $this->Paginator->sort('created') ?></th>
                                <th><?= $this->Paginator->sort('modified') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($coreUsers as $coreUser): ?>
                                <tr>
                                    <td><?= $this->Number->format($coreUser->id) ?></td>
                                    <td class="centered"><?= ($coreUser->is_active == 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>' ?></td>
                                    <td>
                                        <?= $coreUser->has('core_seller') ? $this->Html->link($coreUser->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $coreUser->core_seller->id]) : '' ?>
                                    </td>
                                    <td><?= h($coreUser->email) ?></td>
                                    <td><?= h($coreUser->created) ?></td>
                                    <td><?= h($coreUser->modified) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('Login As'), ['action' => 'loginAs', $coreUser->id, 'plugin' => false, 'prefix' => false], ['escape' => false]) ?></li>
                                                <?php
                                                if ($coreUser->is_active == 0) : ?>
                                                    <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Activate'), ['action' => 'activate', $coreUser->id, 'plugin' => false, 'prefix' => false], ['escape' => false]) ?></li>
                                                <?php endif; ?>
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $coreUser->id, 'plugin' => false, 'prefix' => false], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $coreUser->id, 'plugin' => false, 'prefix' => false], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $coreUser->id, 'plugin' => false, 'prefix' => false], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $coreUser->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $this->element('paginator') ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
