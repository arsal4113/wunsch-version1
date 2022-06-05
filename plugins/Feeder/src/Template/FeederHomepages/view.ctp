<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederHomepage->id) ?></h2>
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
                        <?= __('Feeder Homepages') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Homepages'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Homepage'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Homepage'), ['action' => 'edit', $feederHomepage->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Homepage'), ['action' => 'delete', $feederHomepage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederHomepage->id)]) ?> </li>
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
                        <dt><?= __('Big Banner Image') ?>:</dt>
                        <dd><?= h($feederHomepage->big_banner_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Big Banner Link') ?>:</dt>
                        <dd><?= h($feederHomepage->big_banner_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Small Banner Image') ?>:</dt>
                        <dd><?= h($feederHomepage->first_small_banner_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Small Banner Link') ?>:</dt>
                        <dd><?= h($feederHomepage->first_small_banner_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Small Banner Image') ?>:</dt>
                        <dd><?= h($feederHomepage->second_small_banner_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Small Banner Link') ?>:</dt>
                        <dd><?= h($feederHomepage->second_small_banner_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Third Small Banner Image') ?>:</dt>
                        <dd><?= h($feederHomepage->third_small_banner_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Third Small Banner Link') ?>:</dt>
                        <dd><?= h($feederHomepage->third_small_banner_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fourth Small Banner Image') ?>:</dt>
                        <dd><?= h($feederHomepage->fourth_small_banner_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fourth Small Banner Link') ?>:</dt>
                        <dd><?= h($feederHomepage->fourth_small_banner_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Surprise Item Ids') ?>:</dt>
                        <dd><?= h($feederHomepage->surprise_item_ids) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Feeder Category') ?>:</dt>
                        <dd><?= $feederHomepage->has('feeder_category') ? $this->Html->link($feederHomepage->feeder_category->name, ['controller' => 'FeederCategories', 'action' => 'view', $feederHomepage->feeder_category->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederHomepage->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Robots Meta Tag') ?>:</dt>
                        <dd><?= h($feederHomepage->meta_robots_tag) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
