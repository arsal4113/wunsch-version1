<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederHeroItem->id) ?></h2>
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
                        <?= __('Feeder Hero Items') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Hero Items'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Hero Item'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Hero Item'), ['action' => 'edit', $feederHeroItem->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Hero Item'), ['action' => 'delete', $feederHeroItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederHeroItem->id)]) ?> </li>
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
                        <dt><?= __('Type') ?>:</dt>
                        <dd><?= h($feederHeroItem->type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Webm') ?>:</dt>
                        <dd><?= h($feederHeroItem->webm) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Mp4') ?>:</dt>
                        <dd><?= h($feederHeroItem->mp4) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image') ?>:</dt>
                        <dd><?= h($feederHeroItem->image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Item Id') ?>:</dt>
                        <dd><?= h($feederHeroItem->item_id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Url') ?>:</dt>
                        <dd><?= h($feederHeroItem->url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Item image Url') ?>:</dt>
                        <dd><?= h($feederHeroItem->item_image_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Gender') ?>:</dt>
                        <dd><?= h($feederHeroItem->customer_gender->gender) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Is Active') ?>:</dt>
                        <dd><?= $feederHeroItem->is_active ? __('Yes') : __('No'); ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederHeroItem->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= $this->Number->format($feederHeroItem->sort_order) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($feederHeroItem->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($feederHeroItem->created) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($feederHeroItem->feeder_categories)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Feeder Categories') ?></h5>
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
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Item Id') ?></th>
                            <th><?= __('Image') ?></th>
                            <th><?= __('Ebay Category Id') ?></th>
                            <th><?= __('Gtin') ?></th>
                            <th><?= __('Keywords') ?></th>
                            <th><?= __('Seller Account Type') ?></th>
                            <th><?= __('Seller Trusted Level') ?></th>
                            <th><?= __('Listing Type') ?></th>
                            <th><?= __('Items Condition') ?></th>
                            <th><?= __('Include Seller') ?></th>
                            <th><?= __('Exclude Seller') ?></th>
                            <th><?= __('Country') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Price From') ?></th>
                            <th><?= __('Price To') ?></th>
                            <th><?= __('Sort Order') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($feederHeroItem->feeder_categories as $feederCategory): ?>
                        <tr>
                            <td><?= h($feederCategory->id) ?></td>
                            <td><?= h($feederCategory->parent_id) ?></td>
                            <td><?= h($feederCategory->lft) ?></td>
                            <td><?= h($feederCategory->rght) ?></td>
                            <td><?= h($feederCategory->name) ?></td>
                            <td><?= h($feederCategory->item_id) ?></td>
                            <td><?= h($feederCategory->image) ?></td>
                            <td><?= h($feederCategory->ebay_category_id) ?></td>
                            <td><?= h($feederCategory->gtin) ?></td>
                            <td><?= h($feederCategory->keywords) ?></td>
                            <td><?= h($feederCategory->seller_account_type) ?></td>
                            <td><?= h($feederCategory->seller_trusted_level) ?></td>
                            <td><?= h($feederCategory->listing_type) ?></td>
                            <td><?= h($feederCategory->items_condition) ?></td>
                            <td><?= h($feederCategory->include_seller) ?></td>
                            <td><?= h($feederCategory->exclude_seller) ?></td>
                            <?php
                            $countryIsoCodes = [];
                            foreach ($feederCategory->core_countries as $country) {
                                $countryIsoCodes[] = $country->iso_code;
                            }
                            ?>
                            <td><?= mb_strimwidth((implode(',', $countryIsoCodes)), 0, 17, '...') ?></td>
                            <td><?= h($feederCategory->start_time) ?></td>
                            <td><?= h($feederCategory->end_time) ?></td>
                            <td><?= h($feederCategory->price_from) ?></td>
                            <td><?= h($feederCategory->price_to) ?></td>
                            <td><?= h($feederCategory->sort_order) ?></td>
                            <td><?= h($feederCategory->modified) ?></td>
                            <td><?= h($feederCategory->created) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => 'FeederCategories', 'action' => 'view', $feederCategory->id]) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => 'FeederCategories', 'action' => 'edit', $feederCategory->id]) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeederCategories', 'action' => 'delete', $feederCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederCategory->id)]) ?>
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
