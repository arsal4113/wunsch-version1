<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederHomepageBanner->id) ?></h2>
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
                        <?= __('Feeder Homepage Banners') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Homepage Banners'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Homepage Banner'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Homepage Banner'), ['action' => 'edit', $feederHomepageBanner->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Homepage Banner'), ['action' => 'delete', $feederHomepageBanner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederHomepageBanner->id)]) ?> </li>
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
                        <dt><?= __('Feeder Homepage') ?>:</dt>
                        <dd><?= $feederHomepageBanner->has('feeder_homepage') ? $this->Html->link($feederHomepageBanner->feeder_homepage->id, ['controller' => 'FeederHomepages', 'action' => 'view', $feederHomepageBanner->feeder_homepage->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Banner Image') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->banner_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Banner Link') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->banner_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Banner Bp Lg') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->banner_bp_lg) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Banner Bp Md') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->banner_bp_md) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Banner Bp Sm') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->banner_bp_sm) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Banner Bp Xs') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->banner_bp_xs) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederHomepageBanner->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= $this->Number->format($feederHomepageBanner->sort_order) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Start Time') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->start_time) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('End Time') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->end_time) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Modified') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->modified) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Created') ?>:</dt>
                        <dd><?= h($feederHomepageBanner->created) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
