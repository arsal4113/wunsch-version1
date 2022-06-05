<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederGuide->id) ?></h2>
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
                        <?= __('Feeder Guide') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Guides'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Guide'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Guide'), ['action' => 'edit', $feederGuide->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Guide'), ['action' => 'delete', $feederGuide->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederGuide->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($feederGuide->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Url') ?>:</dt>
                        <dd><?= h($feederGuide->url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Meta Title') ?>:</dt>
                        <dd><?= h($feederGuide->meta_title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Meta Description') ?>:</dt>
                        <dd><?= h($feederGuide->meta_description) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Robots Tag') ?>:</dt>
                        <dd><?= h($feederGuide->robots_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Title') ?>:</dt>
                        <dd><?= h($feederGuide->title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Description') ?>:</dt>
                        <dd><?= h($feederGuide->description) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Background Image') ?>:</dt>
                        <dd><?= h($feederGuide->first_background_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Background Image') ?>:</dt>
                        <dd><?= h($feederGuide->second_background_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Display Animation') ?>:</dt>
                        <dd><?= h($feederGuide->display_animation) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Animation Image') ?>:</dt>
                        <dd><?= h($feederGuide->animation_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Background Color') ?>:</dt>
                        <dd><?= h($feederGuide->background_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Use in navigation') ?>:</dt>
                        <dd><?= h($feederGuide->use_in_navigation) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Navigation Name') ?>:</dt>
                        <dd><?= h($feederGuide->navigation_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= h($feederGuide->sort_order) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
