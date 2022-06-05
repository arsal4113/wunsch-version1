<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2><?= __('List of eBay Sites') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-6">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New eBay Site'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('ebay_site_id', __('eBay Site Id')) ?></th>
                                <th><?= $this->Paginator->sort('ebay_global_id', __('eBay Global Id')) ?></th>
                                <th><?= $this->Paginator->sort('core_currency_id', __('Currency')) ?></th>
                                <th class="centered"><?= $this->Paginator->sort('is_active') ?></th>
                                <th><?= $this->Paginator->sort('created') ?></th>
                                <th><?= $this->Paginator->sort('modified') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ebaySites as $ebaySite): ?>
                                <tr>
                                    <td><?= $this->Number->format($ebaySite->id) ?></td>
                                    <td><?= h($ebaySite->name) ?></td>
                                    <td><?= $this->Number->format($ebaySite->ebay_site_id) ?></td>
                                    <td><?= h($ebaySite->ebay_global_id) ?></td>
                                    <td>
                                        <?= $ebaySite->has('core_currency') ? $this->Html->link($ebaySite->core_currency->name, ['controller' => 'CoreCurrencies', 'action' => 'view', $ebaySite->core_currency->id, 'plugin' => false]) : '' ?>
                                    </td>
                                    <td class="centered"><?= ($ebaySite->is_active == 1) ? __('Yes') : __('No') ?></td>
                                    <td><?= h($ebaySite->created) ?></td>
                                    <td><?= h($ebaySite->modified) ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $ebaySite->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $ebaySite->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-download"></i>' . ' ' . __('Import Categories'), ['controller' => 'EbayCategories','action' => 'import', $ebaySite->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-download"></i>' . ' ' . __('Import Category Specifics'), ['controller' => 'EbayCategorySpecifics','action' => 'import', $ebaySite->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $ebaySite->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $ebaySite->id)]) ?></li>
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
