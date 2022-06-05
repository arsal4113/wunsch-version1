<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of eBay Accounts') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New eBay Account'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                <th><?= $this->Paginator->sort('ebay_account_type_id', __('eBay Account Type')) ?></th>
                                <th><?= $this->Paginator->sort('core_seller_id', __('Seller')) ?></th>
                                <th class="centered"><?= $this->Paginator->sort('is_active') ?></th>
                                <th class="centered"><?= $this->Paginator->sort('token_expiration_time') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ebayAccounts as $ebayAccount): ?>
                                <tr>
                                    <td><?= h($ebayAccount->id) ?></td>
                                    <td><?= h($ebayAccount->name) ?></td>
                                    <td>
                                        <?= $ebayAccount->has('ebay_account_type') ? h($ebayAccount->ebay_account_type->name) : '' ?>
                                    </td>
                                    <td>
                                        <?= $ebayAccount->has('core_seller') ? h($ebayAccount->core_seller->name) : '' ?>
                                    </td>

                                    <td class="centered"><?= ($ebayAccount->is_active == 1) ? __('Yes') : __('No') ?></td>

                                    <td class="centered"><?= !empty($ebayAccount->token_expiration_time) ? h($ebayAccount->token_expiration_time) : __('Token not available') ?></td>
                                    <td class="actions centered">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= __('Actions') ?> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $ebayAccount->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $ebayAccount->id], ['escape' => false]) ?></li>
                                                <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $ebayAccount->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $ebayAccount->id)]) ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-paper-plane"></i>' . ' ' . __('Request Token'), ['action' => 'requestToken', $ebayAccount->id], ['escape' => false, 'target' => '_blank', 'onclick' => "$('.fetchToken-$ebayAccount->id' ).show(5);"]); ?></li>
                                                <?php
                                                $display = 'none';
                                                if(!empty($ebaySessions) && isset($ebaySessions[$ebayAccount->id])) {
                                                    $display = 'inline';
                                                }
                                                ?>
                                                <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Fetch Token'), ['action' => 'fetchToken', $ebayAccount->id], ['class' => 'fetchToken-' . $ebayAccount->id, 'escape' => false, 'style' => 'display: ' . $display]); ?></li>
                                                <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('Show Api Access Limits'), ['plugin' => 'Ebay', 'controller' => 'ebay_accounts', 'action' => 'getApiCallLimits', $ebayAccount->id], ['escape' => false]) ?></li>
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
