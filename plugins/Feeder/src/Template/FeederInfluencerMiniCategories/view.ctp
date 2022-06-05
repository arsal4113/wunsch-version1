<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederInfluencerMiniCategory->name) ?></h2>
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
                        <?= __('Feeder Influencer Mini Categories') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Influencer Mini Categories'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Influencer Mini Category'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Influencer Mini Category'), ['action' => 'edit', $feederInfluencerMiniCategory->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Influencer Mini Category'), ['action' => 'delete', $feederInfluencerMiniCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederInfluencerMiniCategory->id)]) ?> </li>
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
                        <dt><?= __('Name') ?>:</dt>
                        <dd><?= h($feederInfluencerMiniCategory->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Url') ?>:</dt>
                        <dd><?= h($feederInfluencerMiniCategory->url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Image') ?>:</dt>
                        <dd><?= h($feederInfluencerMiniCategory->image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Feeder Influencer') ?>:</dt>
                        <dd><?= $feederInfluencerMiniCategory->has('feeder_influencer') ? $this->Html->link($feederInfluencerMiniCategory->feeder_influencer->name, ['controller' => 'FeederInfluencers', 'action' => 'view', $feederInfluencerMiniCategory->feeder_influencer->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederInfluencerMiniCategory->id) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
