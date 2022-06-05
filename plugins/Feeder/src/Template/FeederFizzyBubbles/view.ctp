<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederFizzyBubble->id) ?></h2>
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
                        <?= __('Feeder Fizzy Bubble') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Fizzy Bubbles'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Fizzy Bubble'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Fizzy Bubble'), ['action' => 'edit', $feederFizzyBubble->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Fizzy Bubble'), ['action' => 'delete', $feederFizzyBubble->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederFizzyBubble->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($feederFizzyBubble->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Title') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->title_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Title Color') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->title_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Title Opacity') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->title_opacity) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Subline Text') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->subline_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Subline Color') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->subline_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Subline Opacity') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->subline_opacity) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image Src') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->image_src) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image Alt Tag') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->img_alt_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Active') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->active) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Active') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->use_on) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Sort Order') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->sort_order) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Start Time') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->start_time) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('End Time') ?>:</dt>
                        <dd><?= h($feederFizzyBubble->end_time) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
