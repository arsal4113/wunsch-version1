<?php

use Feeder\Model\Table\FeederCategoriesTable;

?>
<?= $this->Html->css('Feeder.heroItemConf.css'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New Feeder Category') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active">
                <strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Categories'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->Form->create($feederCategory, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('category_type')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('category_type', [
                                'label' => false,
                                'class' => 'form-control',
                                'options' => [
                                    FeederCategoriesTable::CATEGORY_TYPE_ARTICLE_IDS => FeederCategoriesTable::CATEGORY_TYPE_ARTICLE_IDS,
                                    FeederCategoriesTable::CATEGORY_TYPE_EBAY_CATEGORIES => FeederCategoriesTable::CATEGORY_TYPE_EBAY_CATEGORIES,
                                    FeederCategoriesTable::CATEGORY_TYPE_TOP_SELLERS => FeederCategoriesTable::CATEGORY_TYPE_TOP_SELLERS
                                ],
                                'empty' => true,
                                'value' => true,
                            ]) ?>
                        </div>
                    </div>
                    <div id="form-wrapper" style="display: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('template_type')); ?></label>
                                    <div class="col-md-8 col-sm-10">
                                        <?= $this->Form->input('template_type', [
                                            'label' => false,
                                            'class' => 'form-control',
                                            'options' => [
                                                FeederCategoriesTable::TEMPLATE_TYPE_A => FeederCategoriesTable::TEMPLATE_TYPE_A,
                                                FeederCategoriesTable::TEMPLATE_TYPE_B => FeederCategoriesTable::TEMPLATE_TYPE_B,
                                            ],
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2  control-label"><?= $this->Form->label(__('parent_id')); ?></label>
                                    <div class="col-sm-10">
                                        <?= $this->Form->input('parent_id', ['label' => false, 'class' => 'form-control', 'options' => $parentFeederCategories, 'empty' => true]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('name')); ?></label>
                                    <div class="col-md-8 col-sm-10">
                                        <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?= $this->Form->label(__('url_path')); ?></label>
                                    <div class="col-sm-10">
                                        <?= $this->Form->input('url_path', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('headline')); ?></label>
                                    <div class="col-md-8 col-sm-10">
                                        <?= $this->Form->input('headline', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?= $this->Form->label(__('headline_font_color')); ?></label>
                                    <div class="col-sm-10">
                                        <?= $this->Form->input('headline_font_color', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('headline_guide')); ?></label>
                                    <div class="col-md-8 col-sm-10">
                                        <?= $this->Form->input('headline_guide', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('caption')); ?></label>
                                    <div class="col-md-8 col-sm-10">
                                        <?= $this->Form->input('caption', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?= $this->Form->label(__('caption_font_color')); ?></label>
                                    <div class="col-sm-10">
                                        <?= $this->Form->input('caption_font_color', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('text_background_color')); ?></label>
                                    <div class="col-md-8 col-sm-10">
                                        <?= $this->Form->input('text_background_color', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?= $this->Form->label(__('opacity')); ?></label>
                                    <div class="col-sm-10">
                                        <?= $this->Form->input('opacity', ['label' => false, 'class' => 'form-control', 'type' => 'number', 'min' => '0', 'max' => '100']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?= $this->Form->label(__('use_in_search')); ?></label>
                                    <div class="col-sm-8">
                                        <div class="i-checks">
                                            <?= $this->Form->input('use_in_search', ['type' => 'checkbox', 'label' => false, 'class' => 'custom-checkbox']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?= $this->Form->label(__('is_invisible')); ?></label>
                                    <div class="col-sm-10">
                                        <div class="i-checks">
                                            <?= $this->Form->input('is_invisible', ['type' => 'checkbox', 'label' => false, 'class' => 'custom-checkbox']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submenu">
                            <div class="row wrapper-head">
                                <div class="col-sm-2 placeholder"></div>
                                <div class="col-sm-10 expander">
                                    <span>Banner Adjustments</span>
                                    <div class="small-triangle"></div>
                                </div>
                            </div>
                            <div class="submenu-content" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('banner_image')) ?></label>
                                            <?= $this->element('image_with_tags_input', ['image' => 'banner_image']) ?>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10 image-input-field">
                                                <div class="image-preview">
                                                    <?= $this->Html->image('/', ['id' => 'banner-image-image']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label">
                                                <?= $this->Form->label(__('banner_url')) ?>
                                            </label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('banner_url', ['label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <div class="submenu">
                            <div class="row wrapper-head">
                                <div class="col-sm-2 placeholder"></div>
                                <div class="col-sm-10 expander">
                                    <span>SEO Adjustments</span>
                                    <div class="small-triangle"></div>
                                </div>
                            </div>
                            <div class="submenu-content" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= __('Meta Description') ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('meta_description', ['type' => 'text', 'label' => false, 'class' => 'form-control', 'empty' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= __('Title Tag') ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('title_tag', ['type' => 'text', 'label' => false, 'class' => 'form-control', 'empty' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('robot_tag')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?php $robotTags = ['index,follow','noindex,follow','noindex,nofollow','noindex'] ?>
                                                <?= $this->Form->input('robot_tag', ['class' => 'form-control', 'empty' => ' ', 'options' => array_combine($robotTags, $robotTags), 'label' => false]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= __('SEO Footer Text') ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->textarea('footer_text', ['type' => 'text', 'label' => false, 'class' => 'form-control', 'id' => 'footer-template-markup']) ?>
                                                <button type="button" id="add-footer-template">Add Template</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <div class="submenu">
                            <div class="row wrapper-head">
                                <div class="col-sm-2 placeholder"></div>
                                <div class="col-sm-10 expander">
                                    <span>Inventory Adjustments</span>
                                    <div class="small-triangle"></div>
                                </div>
                            </div>
                            <div class="submenu-content" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="ebay-category-input" style="display: none;">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('ebay_category_id')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('ebay_category_id', ['label' => false, 'class' => 'form-control', 'type' => 'text']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group" id="item-id-input" style="display:none;">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('item_id')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('item_id', ['label' => false, 'class' => 'form-control', 'type' => 'text']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group" id="top-category-input" style="display: none;">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('top_category_id')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('top_category_id',
                                                    [ 'multiple' => true, 'options' => array_combine($soldItemCategories, $soldItemCategories), 'label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('seller_account_type')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('seller_account_type', ['label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => ['BUSINESS' => __('Business'), 'INDIVIDUAL' => __('Individual')]]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('seller_trusted_level')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('seller_trusted_level', ['label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => [null => __(''), 'TOP_RATED' => __('Top Rated'), 'ABOVE_STANDARD' => __('Above Standard')]]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('listing_type')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('listing_type', ['label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => ['FIXED_PRICE' => __('Fixed Price'), 'AUCTION' => __('Auction')]]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('items_condition')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('items_condition', ['label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => [1000 => __('New')]]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('gtin')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('gtin', ['label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('keywords')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('keywords', ['label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('exclude_keywords')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('exclude_keywords', ['label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('include_seller')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('include_seller', ['label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('exclude_seller')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('exclude_seller', ['label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('country')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->select('core_countries._ids', $coreCountries, ['empty' => false, 'label' => false, 'class' => 'form-control country-dropdown', 'multiple' => true, 'required' => true]); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('only_with_sales_prices')); ?></label>
                                            <div class="col-sm-10">
                                                <div class="i-checks">
                                                    <?= $this->Form->input('only_with_sales_prices', ['type' => 'checkbox', 'label' => false, 'class' => 'custom-checkbox']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('price_from')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('price_from', ['label' => false, 'class' => 'form-control', 'min' => 0]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('price_to')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('price_to', ['label' => false, 'class' => 'form-control', 'min' => 0]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <div class="submenu">
                            <div class="row wrapper-head">
                                <div class="col-sm-2 placeholder"></div>
                                <div class="col-sm-10 expander">
                                    <span>Category Adjustments</span>
                                    <div class="small-triangle"></div>
                                </div>
                            </div>
                            <div class="submenu-content" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('start_time')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->control('start_time',
                                                    ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('end_time')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->control('end_time',
                                                    ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('random_skip')); ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('random_skip', ['type' => 'select', 'label' => false, 'class' => 'form-control', 'options' => [null => __('None'), 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6]]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('randomize')); ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('randomize', ['type' => 'select', 'label' => false, 'class' => 'form-control', 'options' => [null => __('None'), 30 => 30, 60 => 60, 90 => 90, 120 => 120, 150 => 150, 180 => 180]]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= __('Quantity') ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('banner_products_factor', [
                                                    'type' => 'select',
                                                    'label' => false,
                                                    'class' => 'form-control',
                                                    'options' => [60 => 60, 120 => 120, 180 => 180]
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('sort_by_input_sequence')); ?></label>
                                            <div class="col-sm-10">
                                                <div class="i-checks">
                                                    <?= $this->Form->input('sort_by_input_sequence', ['type' => 'checkbox', 'label' => false, 'class' => 'custom-checkbox']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= __('Hero Item Positions') ?></label>
                                            <div class="col-sm-10 hero-config-wrapper">
                                                <div class="row">
                                                    <div class="col-md-12 user-tools">
                                                        <select title="design-variants" id="design-variants">
                                                            <option value="0">Desktop</option>
                                                            <option value="1">Desktop-Small</option>
                                                            <option value="2">Tablet-Large</option>
                                                            <option value="3">Tablet</option>
                                                            <option value="4">Mobile</option>
                                                        </select>
                                                        <div class="hero-type-select blue-hero selected-input"></div>
                                                        <div class="hero-type-select yellow-hero unselected-input"></div>
                                                    </div>
                                                </div>
                                                <div class="row position-preview">
                                                    <div class="col-lg-5 col-md-6 col-sm-8 col-12 preview-wrapper">
                                                        <div class="user-input desktop-layout"></div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 preview-wrapper xl-preview">
                                                        <div class="preview-description preview01-title">Desktop-Small</div>
                                                        <div id="preview01" class="preview desktop-sm-layout"></div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 preview-wrapper lg-preview">
                                                        <div class="preview-description preview02-title">Tablet-Large</div>
                                                        <div id="preview02" class="preview tablet-lg-layout"></div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 preview-wrapper md-preview">
                                                        <div class="preview-description preview03-title">Tablet</div>
                                                        <div id="preview03" class="preview tablet-layout"></div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-12 preview-wrapper sm-preview">
                                                        <div class="preview-description preview04-title">Mobile</div>
                                                        <div id="preview04" class="preview mobile-layout"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <div class="submenu">
                            <div class="row wrapper-head">
                                <div class="col-sm-2 placeholder"></div>
                                <div class="col-sm-10 expander">
                                    <span>Facebook Og Adjustments</span>
                                    <div class="small-triangle"></div>
                                </div>
                            </div>
                            <div class="submenu-content" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= __('Facebook Og Url') ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('facebook_og_url', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= __('Facebook Og Type') ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('facebook_og_type', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= __('Facebook Og Title') ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('facebook_og_title', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= __('Facebook Og Description') ?></label>
                                            <div class="col-sm-10">
                                                <?= $this->Form->input('facebook_og_description', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 col-sm-2 control-label"><?= __('Facebook Og Image') ?></label>
                                            <div class="col-md-8 col-sm-10">
                                                <?= $this->Form->input('facebook_og_image', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <?= $this->element('animated_header_fieldset') ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?= $this->Form->label(__('image')); ?></label>
                            <?= $this->element('image_with_tags_input', ['image' => 'image']); ?>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 image-input-field">
                                <div class="image-preview">
                                    <?= $this->Html->image('/', ['id' => 'image-image']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('background_color')); ?></label>
                                    <div class="col-md-8 col-sm-10">
                                        <?= $this->Form->input('background_color', ['label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?= $this->Form->label(__('sort_order')); ?></label>
                                    <div class="col-sm-10">
                                        <?= $this->Form->input('sort_order', ['label' => false, 'class' => 'form-control', 'min' => 0]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="video-element-input">
                                    <label class="col-md-4 col-sm-2 control-label"><?= $this->Form->label(__('categories_video_element')); ?></label>
                                    <div class="col-md-8 col-sm-10">
                                        <?= $this->Form->select('feeder_categories_video_element_id', $feederCategoriesVideoElements, ['empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group widget-replaced">
                            <label class="col-sm-2 control-label"><?= __('Banner Small Positions') ?></label>
                            <div class="col-sm-10">
                                <?= $this->Form->input('banner_small_positions', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                            </div>
                        </div>
                        <div class="form-group widget-replaced">
                            <label class="col-sm-2 control-label"><?= __('Banner Large Positions') ?></label>
                            <div class="col-sm-10">
                                <?= $this->Form->input('banner_large_positions', ['type' => 'text', 'label' => false, 'class' => 'form-control']) ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
                                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script') ?>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        let itemIdInput = $('#item-id-input'),
            ebayCategoryInput = $('#ebay-category-input'),
            topCategoryInput = $('#top-category-input'),
            videoElementInput = $('#video-element-input'),
            typeSelect = $('#category-type'),
            templateSelect = $('#template-type'),
            formWrapper = $('#form-wrapper'),
            _URL = window.URL || window.webkitURL;

        $('#image, #banner-image, #image-selected, #animated-header-image').change(function () {
            let file = this.files[0],
                input = $(this);

            img = new Image();
            img.src = _URL.createObjectURL(file);
            img.onload = function () {
                $("#" + input[0].id + "-image").attr('src', img.src).show().parent().show();
            };
            $(this).next('.alert').remove();
            if (file.size > 150 * 1024) {
                $(this).after('<div class="alert alert-danger"><?= __('Hinweis: Upload größer als 150 kb!')?></div>');
            }
        });

        /**
         * expands and retracts the "Adjustment" sections
         */
        $('.expander').click(function () {
            $(this).parent().parent().find('.submenu-content').stop().slideToggle();
            $(this).find('.small-triangle').toggleClass('rotated');
        });

        typeSelect.change(function () {
            formWrapper.stop();
            let categoryType = $(this).val();
            if(categoryType !== "") {
                formWrapper.slideDown();
                changeCategoryType(categoryType);
            } else {
                formWrapper.slideUp();
            }
        });
        templateSelect.change(function () {
            changeTemplateType($(this).val());
        });
        function changeCategoryType(categoryType) {
            ebayCategoryInput.add(itemIdInput).add(topCategoryInput).hide();
            if(categoryType === "<?= FeederCategoriesTable::CATEGORY_TYPE_EBAY_CATEGORIES ?>"){
                itemIdInput.hide();
                ebayCategoryInput.show();
                topCategoryInput.hide();
            }else if(categoryType === "<?= FeederCategoriesTable::CATEGORY_TYPE_ARTICLE_IDS ?>"){
                itemIdInput.show();
                ebayCategoryInput.hide();
                topCategoryInput.hide();
            }else if(categoryType === "<?= FeederCategoriesTable::CATEGORY_TYPE_TOP_SELLERS?>"){
                itemIdInput.hide();
                ebayCategoryInput.hide();
                topCategoryInput.show();
            }
        }

        function changeTemplateType(templateType) {
            if(templateType === "<?= FeederCategoriesTable::TEMPLATE_TYPE_A ?>"){
                videoElementInput.hide();
            }else if(templateType === "<?= FeederCategoriesTable::TEMPLATE_TYPE_B ?>") {
                videoElementInput.show();
            }
        }

        changeCategoryType(typeSelect.val());
        changeTemplateType(templateSelect.val());

        const footerTemplateInput = $('#footer-template-markup');
        $('#add-footer-template').click(function () {
            if (footerTemplateInput.val() === '') {
                footerTemplateInput.height(265);
                footerTemplateInput.val(
                    '<div class="footer-text-container">\n' +
                    '    <h2>[Überschrift]</h2>\n' +
                    '    <div class="footer-text-wrapper">\n' +
                    '        <div class="footer-text">\n' +
                    '            <h3>[1. Teilüberschrift linke Seite]</h3>\n' +
                    '            <p>[Erster Paragraph linke Seite]</p>\n' +
                    '        </div>\n' +
                    '        <div class="footer-text">\n' +
                    '            <h3>[1. Teilüberschrift rechte Seite]</h3>\n' +
                    '            <p>[Erster Paragraph rechte Seite]</p>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '</div>'
                );
            }
        });

        var smallHeroIdInput = $('#banner-small-positions');
        var largeHeroIdInput = $('#banner-large-positions');
        var largeSelector = $('.yellow-hero');
        var smallSelector = $('.blue-hero');
        var designSelector = $('#design-variants');
        var userInput = $('.user-input');
        var productFactorInput = $('#banner-products-factor');
        var layouts = ['desktop-layout', 'desktop-sm-layout', 'tablet-lg-layout', 'tablet-layout', 'mobile-layout'];

        /**
         * changes the appearance of the user input and the previews according to the selected layout
         */
        designSelector.change(function () {
            userInput.removeClass(layouts[activeLayout]);
            activeLayout = parseInt($(this).val());
            userInput.addClass(layouts[activeLayout]);
            var count = 1;
            var titleString;
            for(var i = 0; i < 5; i++){
                if(i !== activeLayout){
                    $('#preview0' + count).attr('class', 'preview ' + layouts[i]);
                    switch(i){
                        case 0:
                            titleString = 'Desktop';
                            break;
                        case 1:
                            titleString = 'Desktop-Small';
                            break;
                        case 2:
                            titleString = 'Tablet-Large';
                            break;
                        case 3:
                            titleString = 'Tablet';
                            break;
                        case 4:
                            titleString = 'Mobile';
                            break;
                    }
                    $('.preview0' + count + '-title').html(titleString);
                    count++;
                }
            }
        });

        /**
         * repopulates the inputs and previews if the user changes the product Factor
         */
        productFactorInput.change(function () {
            productFactor = parseInt(productFactorInput.val());
            removeArrayValues([smallHeroPositions, largeHeroPositions]);
            populateUserInput();
            populatePreview();
            updatePositionInputs();
        });

        /** how many selectable fields should be rendered */
        var productFactor;
        var databaseProductFactor = <?= json_encode($feederCategory->banner_products_factor) ?>;
        if(databaseProductFactor !== null){
            productFactor = databaseProductFactor;
        }else{
            productFactor = <?= json_encode($defaultProductsFactor) ?>;
        }
        /** 0 = single banner (blue) mode, 1 = double banner (yellow) mode */
        var heroMode = 0;
        /** the active layout for the user input that the user has selected */
        var activeLayout = 0;
        /** the arrays that hold the positional information for the hero banners */
        var smallHeroPositions;
        var largeHeroPositions;
        var databaseSmallPositions = <?= json_encode($feederCategory->banner_small_positions) ?>;
        var databaseLargePositions = <?= json_encode($feederCategory->banner_large_positions) ?>;
        if(databaseSmallPositions === "" && databaseLargePositions === ""){
            smallHeroPositions = JSON.parse("[" + <?= json_encode($defaultSmallBannerPos) ?> + "]");
            largeHeroPositions = JSON.parse("[" + <?= json_encode($defaultLargeBannerPos) ?> + "]");
        }else{
            smallHeroPositions = JSON.parse("[" + databaseSmallPositions + "]");
            largeHeroPositions = JSON.parse("[" + databaseLargePositions + "]");
        }

        /** manage the user input concerning the hero mode */
        smallSelector.click(function () {
            if(!$(this).hasClass('selected-input')){
                $(this).addClass('selected-input').removeClass('unselected-input');
                largeSelector.removeClass('selected-input').addClass('unselected-input');
                heroMode = 0;
                checkSelectable()
            }
        });
        largeSelector.click(function () {
            if(!$(this).hasClass('selected-input')){
                $(this).addClass('selected-input').removeClass('unselected-input');
                smallSelector.removeClass('selected-input').addClass('unselected-input');
                heroMode = 1;
                checkSelectable()
            }
        });

        /**
         * populates the user input section with divs the user can click on
         */
        function populateUserInput(){
            userInput.html('');
            for(var i = 0; i < productFactor; i++){
                if(smallHeroPositions.indexOf(i) > -1){
                    userInput.append('<div id="sel-' + i + '" class="selector blue-selected">' + (i + 1) + '</div>');
                }else if(largeHeroPositions.indexOf(i) > -1){
                    userInput.append('<div id="sel-' + i + '" class="selector yellow-selected">' + (i + 1) + '</div>');
                    i++;
                    userInput.append('<div id="sel-' + i + '" class="selector yellow-selected yellow-follow">' + (i + 1) + '</div>');
                }else{
                    userInput.append('<div id="sel-' + i + '" class="selector">' + (i + 1) + '</div>')
                }
            }
            checkSelectable();
        }

        /**
         * populates the smaller preview containers next to the user input
         */
        function populatePreview(){
            $.each([$('#preview01'), $('#preview02'), $('#preview03'), $('#preview04')], function (key, val) {
                $(val).html('');
            });
            var previewContainer;
            for(var i = 1; i <= 4; i++){
                previewContainer = $('#preview0' + i);
                for(var j = 0; j < productFactor; j++){
                    if(smallHeroPositions.indexOf(j) > -1){
                        previewContainer.append('<div class="preview-selector blue-selected">' + (j + 1) + '</div>');
                    }else if(largeHeroPositions.indexOf(j) > -1){
                        previewContainer.append('<div class="preview-selector yellow-selected">' + (j + 1) + '</div>');
                        j++;
                        previewContainer.append('<div class="preview-selector yellow-selected">' + (j + 1) + '</div>');
                    }else{
                        previewContainer.append('<div class="preview-selector">' + (j + 1) + '</div>')
                    }
                }
            }
        }

        populateUserInput();
        populatePreview();

        /**
         * checks if a field is selectable as hero field, depending on heroMode.
         */
        function checkSelectable(){
            if(heroMode === 1){
                $('.selector').each(function (index) {
                    $(this).removeClass('selectable');
                    index++;
                    if(index % 2 !== 0 && index % 3 !== 0 && index % 4 !== 0 && index % 5 !== 0 && index % 6 !== 0 && index !== productFactor){
                        $(this).addClass("selectable");
                    }
                })
            }else{
                $('.selector').each(function () {
                    $(this).addClass('selectable');
                })
            }
        }

        /**
         * enables selection of selectable elements by clicking on them.
         */
        userInput.on('click', '.selector', function () {
            var id = parseInt($(this).attr('id').replace('sel-', ''));
            clickAssignSelectorClass(this, id);
            updatePreview();
        });

        /**
         * updated the preview displays when the banner selection is updated by the user
         */
        function updatePreview(){
            var previews = $('.preview');
            $.each(previews, function(index, previewItem){
                var preview = $(previewItem);
                $.each(preview.children(), function (index, selectorItem) {
                    var selector = $(selectorItem);
                    selector.removeClass('blue-selected yellow-selected');
                    if(smallHeroPositions.indexOf(index) > -1){
                        selector.addClass('blue-selected');
                    }else if(largeHeroPositions.indexOf(index) > -1 || largeHeroPositions.indexOf(index - 1) > -1){
                        selector.addClass('yellow-selected');
                    }
                })
            });
        }

        /**
         * assigns and removes the correct css-classes if the user clicks on a selector
         * @param selector
         * @param id
         */
        function clickAssignSelectorClass(selector, id){
            if($(selector).hasClass('selectable')){
                if(heroMode === 0){
                    if($(selector).hasClass('yellow-selected')){
                        $(selector).removeClass('yellow-selected');
                        if($(selector).hasClass('yellow-follow')){
                            $(selector).removeClass('yellow-follow');
                            $('#sel-' + (id - 1)).removeClass('yellow-selected');
                            manageHeroArrays(false, id - 1, true);
                        }else{
                            $('#sel-' + (id + 1)).removeClass('yellow-selected yellow-follow');
                            manageHeroArrays(false, id, true);
                        }
                    }
                    if($(selector).hasClass('blue-selected')){
                        $(selector).removeClass('blue-selected');
                        manageHeroArrays(true, id, true);
                    }else{
                        $(selector).addClass('blue-selected');
                        manageHeroArrays(true, id, false);
                    }
                }else{
                    if($(selector).hasClass('yellow-selected')){
                        $(selector).removeClass('yellow-selected');
                        if($(selector).hasClass('yellow-follow')){
                            $(selector).removeClass('yellow-follow');
                            $('#sel-' + (id - 1)).removeClass('yellow-selected');
                            manageHeroArrays(true, id - 1, true);
                        }else{
                            $('#sel-' + (id + 1)).removeClass('yellow-selected yellow-follow');
                            manageHeroArrays(false, id, true);
                        }
                    }else{
                        if($(selector).hasClass('blue-selected')){
                            $(selector).removeClass('blue-selected');
                            manageHeroArrays(true, id, true);
                        }
                        $(selector).addClass('yellow-selected');
                        $('#sel-' + (id + 1)).addClass('yellow-selected yellow-follow');
                        manageHeroArrays(false, id, false);

                        if($('#sel-' + (id + 1)).hasClass('blue-selected')){
                            $('#sel-' + (id + 1)).removeClass('blue-selected');
                            manageHeroArrays(true, id + 1, true);
                        }
                    }
                }
            }
        }

        /**
         * adds and removes ids from the hero Arrays and updates the values of the database input fields.
         * @param smallArray
         * @param id
         * @param remove
         */
        function manageHeroArrays(smallArray, id, remove){
            var array = smallArray ? smallHeroPositions : largeHeroPositions;
            if(remove){
                array.splice(array.indexOf(id), 1);
            }else{
                array.push(id);
                array.sort(function(a,b){return a-b});
            }
            updatePositionInputs();
        }

        /**
         * removes values from the position arrays if they are bigger than the product Factor.
         */
        function removeArrayValues(arrays){
            for(var h = 0; h < 2; h++){
                var array = arrays[h];
                for(var i = 0; i < array.length; i++){
                    if(array[i] >= productFactor){
                        array.splice(i, 1);
                    }
                }
            }
        }

        /**
         * updates the form inputs for the hero banner positions if they are changed
         */
        function updatePositionInputs(){
            smallHeroIdInput.val(smallHeroPositions.toString());
            largeHeroIdInput.val(largeHeroPositions.toString());
        }
    });
</script>
<?php $this->end() ?>
