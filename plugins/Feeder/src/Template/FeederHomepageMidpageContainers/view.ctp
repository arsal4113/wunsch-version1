<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederHomepageMidpageContainer->id) ?></h2>
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
                        <?= __('Feeder Homepage Midpage Containers') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Homepage Midpage Containers'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Homepage Midpage Container'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Homepage Midpage Container'), ['action' => 'edit', $feederHomepageMidpageContainer->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Homepage Midpage Container'), ['action' => 'delete', $feederHomepageMidpageContainer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederHomepageMidpageContainer->id)]) ?> </li>
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
                        <dd><?= $feederHomepageMidpageContainer->has('feeder_homepage') ? $this->Html->link($feederHomepageMidpageContainer->feeder_homepage->id, ['controller' => 'FeederHomepages', 'action' => 'view', $feederHomepageMidpageContainer->feeder_homepage->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Video Desktop Mp4') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->video_desktop_mp4) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Video Tablet Mp4') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->video_tablet_mp4) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Video Mobile Mp4') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->video_mobile_mp4) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Video Desktop Webm') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->video_desktop_webm) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Video Tablet Webm') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->video_tablet_webm) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Video Mobile Webm') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->video_mobile_webm) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image Desktop') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->image_desktop) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image Tablet') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->image_tablet) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image Mobile') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->image_mobile) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Click Url') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->click_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Header Text') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->header_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Button Text') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->button_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Button Color') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->button_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Background Color') ?>:</dt>
                        <dd><?= h($feederHomepageMidpageContainer->background_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederHomepageMidpageContainer->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Use Video') ?>:</dt>
                        <dd><?= $feederHomepageMidpageContainer->use_video ? __('Yes') : __('No'); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
