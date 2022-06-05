<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederCategory->name) ?></h2>
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
                        <?= __('Feeder Categories') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Categories'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Category'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Category'), ['action' => 'edit', $feederCategory->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Category'), ['action' => 'delete', $feederCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederCategory->id)]) ?> </li>
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
                        <dt><?= __('Parent Feeder Category') ?>:</dt>
                        <dd><?= $feederCategory->has('parent_feeder_category') ? $this->Html->link($feederCategory->parent_feeder_category->name, ['controller' => 'FeederCategories', 'action' => 'view', $feederCategory->parent_feeder_category->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($feederCategory->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Category Type') ?>:</dt>
                        <dd><?= h($feederCategory->category_type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Template Type') ?>:</dt>
                        <dd><?= h($feederCategory->template_type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Url Path') ?>:</dt>
                        <dd><?= h($feederCategory->url_path) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Headline') ?>:</dt>
                        <dd><?= h($feederCategory->headline) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Headline Guide') ?>:</dt>
                        <dd><?= h($feederCategory->headline_guide) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Caption') ?>:</dt>
                        <dd><?= h($feederCategory->caption) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Use In Search') ?>:</dt>
                        <dd><?= h($feederCategory->use_in_search) ? __('Yes') : __('No'); ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Is Invisible') ?>:</dt>
                        <dd><?= h($feederCategory->is_invisible) ? __('Yes') : __('No'); ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Has animated header') ?>:</dt>
                        <dd><?= h($feederCategory->has_animated_header) ? __('Yes') : __('No') ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Ebay Category') ?>:</dt>
                        <dd><?= $feederCategory->has('ebay_category') ? $this->Html->link($feederCategory->ebay_category->name, ['controller' => 'EbayCategories', 'action' => 'view', $feederCategory->ebay_category->id]) : '' ?></dd>
                    </dl>
                    <?php if (!empty($feederCategory->top_category_id)) { ?>
                    <dl class="dl-horizontal">
                        <dt><?= __('Top Categories') ?>:</dt>
                        <dd><?= $feederCategory->top_category_id ?></dd>
                    </dl>
                    <?php } ?>
                    <dl class="dl-horizontal">
                        <dt><?= __('Gtin') ?>:</dt>
                        <dd><?= h($feederCategory->gtin) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Keywords') ?>:</dt>
                        <dd><?= h($feederCategory->keywords) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Seller Account Type') ?>:</dt>
                        <dd><?= h($feederCategory->seller_account_type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Seller Trusted Level') ?>:</dt>
                        <dd><?= h($feederCategory->seller_trusted_level) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Listing Type') ?>:</dt>
                        <dd><?= h($feederCategory->listing_type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Items Condition') ?>:</dt>
                        <dd><?= h($feederCategory->items_condition) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Include Seller') ?>:</dt>
                        <dd><?= h($feederCategory->include_seller) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Exclude Seller') ?>:</dt>
                        <dd><?= h($feederCategory->exclude_seller) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Country') ?>:</dt>
                        <?php
                        $countryIsoCodes = [];
                        foreach ($feederCategory->core_countries as $country) {
                            $countryIsoCodes[] = $country->iso_code;
                        }
                        ?>
                        <dd><?= mb_strimwidth((implode(',', $countryIsoCodes)), 0, 17, '...') ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort By Input Sequence') ?>:</dt>
                        <dd><?= h($feederCategory->sort_by_input_sequence) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederCategory->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Lft') ?>:</dt>
                        <dd><?= $this->Number->format($feederCategory->lft) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Rght') ?>:</dt>
                        <dd><?= $this->Number->format($feederCategory->rght) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Price From') ?>:</dt>
                        <dd><?= $this->Number->format($feederCategory->price_from) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Price To') ?>:</dt>
                        <dd><?= $this->Number->format($feederCategory->price_to) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Only With Sales Prices') ?>:</dt>
                        <dd><?= $feederCategory->only_with_sales_prices ? __('Yes') : __('No'); ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= $this->Number->format($feederCategory->sort_order) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($feederCategory->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($feederCategory->created) ?></dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Url') ?>:</dt>
                        <dd><?= h($feederCategory->facebook_og_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Type') ?>:</dt>
                        <dd><?= h($feederCategory->facebook_og_type) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Title') ?>:</dt>
                        <dd><?= h($feederCategory->facebook_og_title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Description') ?>:</dt>
                        <dd><?= h($feederCategory->facebook_og_description) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Image') ?>:</dt>
                        <dd><?= h($feederCategory->facebook_og_image) ?></dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt><?= __('Meta Description') ?>:</dt>
                        <dd><?= h($feederCategory->meta_description) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('SEO Footer Text') ?>:</dt>
                        <dd><?= h($feederCategory->footer_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Title Tag') ?>:</dt>
                        <dd><?= h($feederCategory->title_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Robot Tag') ?>:</dt>
                        <dd><?= h($feederCategory->robot_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Canonical Link') ?>:</dt>
                        <dd><?= h($feederCategory->canonical_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Start Time') ?>:</dt>
                        <dd><?= h($feederCategory->start_time) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('End Time') ?>:</dt>
                        <dd><?= h($feederCategory->end_time) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($feederCategory->child_feeder_categories)) { ?>
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
                            <th><?= __('Ebay Category Id') ?></th>
                            <th><?= __('Gtin') ?></th>
                            <th><?= __('Keywords') ?></th>
                            <th><?= __('Seller Account Type') ?></th>
                            <th><?= __('Listing Type') ?></th>
                            <th><?= __('Items Condition') ?></th>
                            <th><?= __('Include Seller') ?></th>
                            <th><?= __('Exclude Seller') ?></th>
                            <th><?= __('Country') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Min Price') ?></th>
                            <th><?= __('Max Price') ?></th>
                            <th><?= __('Sort Order') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($feederCategory->child_feeder_categories as $childFeederCategories): ?>
                        <tr>
                            <td><?= h($childFeederCategories->id) ?></td>
                            <td><?= h($childFeederCategories->parent_id) ?></td>
                            <td><?= h($childFeederCategories->lft) ?></td>
                            <td><?= h($childFeederCategories->rght) ?></td>
                            <td><?= h($childFeederCategories->name) ?></td>
                            <td><?= h($childFeederCategories->ebay_category_id) ?></td>
                            <td><?= h($childFeederCategories->gtin) ?></td>
                            <td><?= h($childFeederCategories->keywords) ?></td>
                            <td><?= h($childFeederCategories->seller_account_type) ?></td>
                            <td><?= h($childFeederCategories->listing_type) ?></td>
                            <td><?= h($childFeederCategories->items_condition) ?></td>
                            <td><?= h($childFeederCategories->include_seller) ?></td>
                            <td><?= h($childFeederCategories->exclude_seller) ?></td>
                            <?php
                            $countryIsoCodes = [];
                            foreach ($childFeederCategories->core_countries as $country) {
                                $countryIsoCodes[] = $country->iso_code;
                            }
                            ?>
                            <td><?= mb_strimwidth((implode(',', $countryIsoCodes)), 0, 17, '...') ?></td>
                            <td><?= h($childFeederCategories->price_from) ?></td>
                            <td><?= h($childFeederCategories->price_to) ?></td>
                            <td><?= h($childFeederCategories->sort_order) ?></td>
                            <td><?= h($childFeederCategories->start_time) ?></td>
                            <td><?= h($childFeederCategories->end_time) ?></td>
                            <td><?= h($childFeederCategories->modified) ?></td>
                            <td><?= h($childFeederCategories->created) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => 'FeederCategories', 'action' => 'view', $childFeederCategories->id]) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => 'FeederCategories', 'action' => 'edit', $childFeederCategories->id]) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeederCategories', 'action' => 'delete', $childFeederCategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childFeederCategories->id)]) ?>
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
