<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Ebay Checkout Sessions') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
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
                                    <th><?= $this->Paginator->sort('first_name') ?></th>
                                    <th><?= $this->Paginator->sort('last_name') ?></th>
                                    <th><?= $this->Paginator->sort('email') ?></th>
                                    <th><?= $this->Paginator->sort('address_line_1') ?></th>
                                    <th><?= $this->Paginator->sort('postal_code') ?></th>
                                    <th><?= $this->Paginator->sort('city') ?></th>
                                    <th><?= $this->Paginator->sort('value') ?></th>
                                    <th><?= $this->Paginator->sort('ebay_checkout_session_id') ?></th>
                                    <th><?= $this->Paginator->sort('purchase_order_id') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($sessions as $session): ?>
                            <tr>
                                <td><?= h($session->first_name) ?></td>
                                <td><?= h($session->last_name) ?></td>
                                <td><?= h($session->email) ?></td>
                                <td><?= h($session->address_line_1 ?? '') ?></td>
                                <td><?= h($session->postal_code ?? '') ?></td>
                                <td><?= h($session->city ?? '') ?></td>
                                <td><?= $this->Number->currency($session->value, $session->currency) ?></td>
                                <td><?= h($session->ebay_checkout_session_id) ?></td>
                                <td><?= h($session->purchase_order_id) ?></td>
                                <td><?= h($session->modified) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default">
                                            <?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'viewSession', $session->id], ['escape' => false]) ?>
                                        </button>
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
