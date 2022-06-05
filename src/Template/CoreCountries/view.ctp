<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($coreCountry->name) ?></h2>
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
                        <?= __('Countries') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Countries'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Country'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Country'), ['action' => 'edit', $coreCountry->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Country'), ['action' => 'delete', $coreCountry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coreCountry->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($coreCountry->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Iso Code') ?>:</dt>
                        <dd><?= h($coreCountry->iso_code) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Iso Code 3166-2') ?>:</dt>
                        <dd><?= h($coreCountry->iso_code_3166_2) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($coreCountry->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Default Tax') ?>:</dt>
                        <dd><?= $this->Number->format($coreCountry->default_tax) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($coreCountry->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($coreCountry->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($coreCountry->core_sellers)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Sellers') ?></h5>
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
                            <th class="centered"><?= __('Language Id') ?></th>
                            <th class="centered"><?= __('Is Active') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($coreCountry->core_sellers as $coreSellers): ?>
                        <tr>
                            <td><?= h($coreSellers->id) ?></td>
                            <td><?= h($coreSellers->code) ?></td>
                            <td><?= h($coreSellers->name) ?></td>
                            <td class="centered"><?= h($coreSellers->core_language_id) ?></td>
                            <td class="centered"><?= ($coreSellers->is_active == 1) ? __('Yes') : __('No') ?></td>
                            <td><?= h($coreSellers->created) ?></td>
                            <td><?= h($coreSellers->modified) ?></td>
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
