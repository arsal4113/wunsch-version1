<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Customers') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Form->postLink(__('Download as Csv'), ['action' => 'download'], ['class' => 'btn btn-sm btn-primary']) ?>
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
                                    <th><?= $this->Paginator->sort('first_name') ?></th>
                                    <th><?= $this->Paginator->sort('last_name') ?></th>
                                    <th><?= $this->Paginator->sort('email') ?></th>
                                    <th><?= __('Address') ?></th>
                                    <th><?= __('Postal Code') ?></th>
                                    <th><?= __('City') ?></th>
                                    <th><?= __('Provider') ?></th>
                                    <th><?= __('Last Purchase') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= h($customer->id) ?></td>
                                <td><?= h($customer->first_name) ?></td>
                                <td><?= h($customer->last_name) ?></td>
                                <td><?= h($customer->email) ?></td>
                                <td><?= h($customer->customer_addresses[0]->street_line_1 ?? null) ?></td>
                                <td><?= h($customer->customer_addresses[0]->postal_code ?? null) ?></td>
                                <td><?= h($customer->customer_addresses[0]->city ?? null) ?></td>
                                <td><?= h($customer->ebay_registered ? 'eBay' : ($customer->social_profiles[0]->provider ?? null)) ?></td>
                                <td><?= isset($customer->ebay_checkout_sessions[0]->purchase_order_timestamp)
                                        ? \Cake\I18n\Time::createFromTimestamp($customer->ebay_checkout_sessions[0]->purchase_order_timestamp) : '' ?></td>
                                <td><?= h($customer->modified) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $customer->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $customer->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?></li>
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
