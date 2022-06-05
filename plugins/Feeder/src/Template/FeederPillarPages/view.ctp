<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederPillarPage->id) ?></h2>
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
                        <?= __('Feeder Pillar Pages') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Pillar Pages'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Pillar Page'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Pillar Page'), ['action' => 'edit', $feederPillarPage->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Pillar Page'), ['action' => 'delete', $feederPillarPage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederPillarPage->id)]) ?> </li>
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
                        <dd><?= $this->Number->format($feederPillarPage->id) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Title Tag') ?>:</dt>
                        <dd><?= h($feederPillarPage->title_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Url Path') ?>:</dt>
                        <dd><?= h($feederPillarPage->url_path) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Meta Description') ?>:</dt>
                        <dd><?= h($feederPillarPage->meta_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Robots Tag') ?>:</dt>
                        <dd><?= h($feederPillarPage->robots_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Url') ?>:</dt>
                        <dd><?= h($feederPillarPage->facebook_og_url) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Image') ?>:</dt>
                        <dd><?= h($feederPillarPage->facebook_og_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Title') ?>:</dt>
                        <dd><?= h($feederPillarPage->facebook_og_title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Facebook Og Description') ?>:</dt>
                        <dd><?= h($feederPillarPage->facebook_og_description) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Block Image') ?>:</dt>
                        <dd><?= h($feederPillarPage->first_block_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Block Title') ?>:</dt>
                        <dd><?= h($feederPillarPage->first_block_title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Block Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->first_block_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Block Cta Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->first_block_cta_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('First Block Cta Link') ?>:</dt>
                        <dd><?= h($feederPillarPage->first_block_cta_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Block Image') ?>:</dt>
                        <dd><?= h($feederPillarPage->second_block_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Block Title') ?>:</dt>
                        <dd><?= h($feederPillarPage->second_block_title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Block Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->second_block_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Block Cta Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->second_block_cta_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Second Block Cta Link') ?>:</dt>
                        <dd><?= h($feederPillarPage->second_block_cta_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Third Block Image') ?>:</dt>
                        <dd><?= h($feederPillarPage->third_block_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Instagram Section Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->instagram_section_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Third Block Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->third_block_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Third Block Follow Color') ?>:</dt>
                        <dd><?= h($feederPillarPage->third_block_follow_color) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fourth Block Title') ?>:</dt>
                        <dd><?= h($feederPillarPage->fourth_block_title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fourth Block Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->fourth_block_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fourth Block Cta Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->fourth_block_cta_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fourth Block Cta Link') ?>:</dt>
                        <dd><?= h($feederPillarPage->fourth_block_cta_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fifth Block Title') ?>:</dt>
                        <dd><?= h($feederPillarPage->fifth_block_title) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fifth Block Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->fifth_block_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fifth Block Cta Text') ?>:</dt>
                        <dd><?= h($feederPillarPage->fifth_block_cta_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Fifth Block Cta Link') ?>:</dt>
                        <dd><?= h($feederPillarPage->fifth_block_cta_link) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
