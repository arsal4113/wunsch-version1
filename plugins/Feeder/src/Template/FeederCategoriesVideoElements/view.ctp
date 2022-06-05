<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederCategoriesVideoElement->id) ?></h2>
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
                        <?= __('Feeder Categories Video Elements') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Categories Video Elements'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Categories Video Element'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Categories Video Element'), ['action' => 'edit', $feederCategoriesVideoElement->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Categories Video Element'), ['action' => 'delete', $feederCategoriesVideoElement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederCategoriesVideoElement->id)]) ?> </li>
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
                        <dt><?= __('Video Mp4') ?>:</dt>
                        <dd><?= h($feederCategoriesVideoElement->video_mp4) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Video Webm') ?>:</dt>
                        <dd><?= h($feederCategoriesVideoElement->video_webm) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Background Color') ?>:</dt>
                        <dd><?= h($feederCategoriesVideoElement->background_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Headline') ?>:</dt>
                        <dd><?= h($feederCategoriesVideoElement->headline) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Headline Color') ?>:</dt>
                        <dd><?= h($feederCategoriesVideoElement->headline_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederCategoriesVideoElement->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Is Active') ?>:</dt>
                        <dd><?= $feederCategoriesVideoElement->is_active ? __('Yes') : __('No'); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
