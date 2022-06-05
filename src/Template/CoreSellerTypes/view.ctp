<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($coreSellerType->name) ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-5">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('Core Seller Types') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Core Seller Types'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Core Seller Type'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Core Seller Type'), ['action' => 'edit', $coreSellerType->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Core Seller Type'), ['action' => 'delete', $coreSellerType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreSellerType->id)]) ?> </li>
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
                        <dt><?= __('Core User Role') ?>:</dt>
                        <dd><?= $coreSellerType->has('core_user_role') ? $this->Html->link($coreSellerType->core_user_role->name, ['controller' => 'CoreUserRoles', 'action' => 'view', $coreSellerType->core_user_role->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Code') ?>:</dt>
                        <dd><?= h($coreSellerType->code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($coreSellerType->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Redirect Url') ?>:</dt>
                        <dd><?= h($coreSellerType->redirect_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($coreSellerType->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($coreSellerType->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($coreSellerType->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($coreSellerType->core_sellers)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Core Sellers') ?></h5>
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
                            <th><?= __('Core Language Id') ?></th>
                            <th><?= __('Core Country Id') ?></th>
                            <th><?= __('Is Active') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Core Seller Type Id') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($coreSellerType->core_sellers as $coreSellers): ?>
                        <tr>
                            <td><?= h($coreSellers->id) ?></td>
                            <td><?= h($coreSellers->code) ?></td>
                            <td><?= h($coreSellers->name) ?></td>
                            <td><?= h($coreSellers->core_language_id) ?></td>
                            <td><?= h($coreSellers->core_country_id) ?></td>
                            <td><?= h($coreSellers->is_active) ?></td>
                            <td><?= h($coreSellers->created) ?></td>
                            <td><?= h($coreSellers->modified) ?></td>
                            <td><?= h($coreSellers->core_seller_type_id) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => 'CoreSellers', 'action' => 'view', $coreSellers->id]) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CoreSellers', 'action' => 'edit', $coreSellers->id]) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'CoreSellers', 'action' => 'delete', $coreSellers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreSellers->id)]) ?>
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
