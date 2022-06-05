<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= h($ebayAccountType->name) ?></h2>
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
                        <?= __('eBay Account Types') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of eBay Account Types'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New eBay Account Type'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit eBay Account Type'), ['action' => 'edit', $ebayAccountType->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete eBay Account Type'), ['action' => 'delete', $ebayAccountType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ebayAccountType->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($ebayAccountType->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Is Active') ?>:</dt>
                        <dd><?= ($ebayAccountType->is_active == 1) ? __('Yes') : __('No') ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($ebayAccountType->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Type') ?>:</dt>
                        <dd><?= h($ebayAccountType->type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Login URL') ?>:</dt>
                        <dd><?= h($ebayAccountType->login_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($ebayAccountType->created) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($ebayAccountType->modified) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($ebayAccountType->ebay_accounts)) { ?>
        <div class="ibox">
            <div class="ibox-title">
                <h5><?= __('Related eBay Accounts') ?></h5>
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
                                <th><?= __('Ebay Credential') ?></th>
                                <th><?= __('Seller') ?></th>
                                <th><?= __('Is Active') ?></th>
                                <th><?= __('Name') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Modified') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            <?php foreach ($ebayAccountType->ebay_accounts as $ebayAccounts): ?>
                                <tr>
                                    <td><?= h($ebayAccounts->id) ?></td>
                                    <td><?= h($ebayAccounts->ebay_credential->key_set_name) ?></td>
                                    <td><?= h($ebayAccounts->core_seller->name) ?></td>
                                    <td><?= ($ebayAccounts->is_active == 1) ? __('Yes') : __('No') ?></td>
                                    <td><?= h($ebayAccounts->name) ?></td>
                                    <td><?= h($ebayAccounts->created) ?></td>
                                    <td><?= h($ebayAccounts->modified) ?></td>
                                    <td class="actions centered">
                                        <?= $this->Html->link(__('View'), ['controller' => 'EbayAccounts', 'action' => 'view', $ebayAccounts->id, 'plugin' => 'Ebay']) ?> |
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'EbayAccounts', 'action' => 'edit', $ebayAccounts->id, 'plugin' => 'Ebay']) ?> |
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'EbayAccounts', 'action' => 'delete', $ebayAccounts->id, 'plugin' => 'Ebay'], ['confirm' => __('Are you sure you want to delete # {0}?', $ebayAccounts->id)]) ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (!empty($ebayAccountType->ebay_credentials)) { ?>
        <div class="ibox">
            <div class="ibox-title">
                <h5><?= __('Related eBay Credentials') ?></h5>
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
                                <th><?= __('Key Set Name') ?></th>
                                <th><?= __('App Id') ?></th>
                                <th><?= __('Dev Id') ?></th>
                                <th><?= __('Cert Id') ?></th>
                                <th class="actions centered"></th>
                            </tr>
                            <?php foreach ($ebayAccountType->ebay_credentials as $ebayCredentials): ?>
                                <tr>
                                    <td><?= h($ebayCredentials->id) ?></td>
                                    <td><?= h($ebayCredentials->key_set_name) ?></td>
                                    <td><?= h($ebayCredentials->app_id) ?></td>
                                    <td><?= h($ebayCredentials->dev_id) ?></td>
                                    <td><?= h($ebayCredentials->cert_id) ?></td>
                                    <td class="actions centered">
                                        <?= $this->Html->link(__('View'), ['controller' => 'EbayCredentials', 'action' => 'view', $ebayCredentials->id, 'plugin' => 'Ebay']) ?> |
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'EbayCredentials', 'action' => 'edit', $ebayCredentials->id, 'plugin' => 'Ebay']) ?> |
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'EbayCredentials', 'action' => 'delete', $ebayCredentials->id, 'plugin' => 'Ebay'], ['confirm' => __('Are you sure you want to delete # {0}?', $ebayCredentials->id)]) ?>
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
