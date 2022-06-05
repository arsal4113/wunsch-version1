<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-7">
        <h2><?= h($feederInfluencer->name) ?></h2>
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
                        <?= __('Feeder Influencers') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of Feeder Influencers'), ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add New Feeder Influencer'), ['action' => 'add']) ?></li>
                        <li><?= $this->Html->link(__('Edit Feeder Influencer'), ['action' => 'edit', $feederInfluencer->id]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Form->postLink(__('Delete Feeder Influencer'), ['action' => 'delete', $feederInfluencer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederInfluencer->id)]) ?> </li>
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
                        <dd><?= h($feederInfluencer->name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Url Path') ?>:</dt>
                        <dd><?= h($feederInfluencer->url_path) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Title Tag') ?>:</dt>
                        <dd><?= h($feederInfluencer->title_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Meta Description') ?>:</dt>
                        <dd><?= h($feederInfluencer->meta_description) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Robot Tag') ?>:</dt>
                        <dd><?= h($feederInfluencer->robot_tag) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 1 Headline') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_1_headline) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 1 Text') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_1_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 2 Text') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_2_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 2 Link') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_2_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 3 Image') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_3_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 3 Video') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_3_video) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 5 Text') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_5_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 5 Image 1') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_5_image_1) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 5 Image 2') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_5_image_2) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 5 Image 3') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_5_image_3) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 5 Image 4') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_5_image_4) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 5 Image 5') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_5_image_5) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 5 Image 6') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_5_image_6) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 6 Image 1') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_6_image_1) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 6 Image 2') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_6_image_2) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 6 Image 3') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_6_image_3) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 7 Text') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_7_text) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 7 Mobile Text') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_7_text_mobile) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 8 Image') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_8_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 8 Headline 1') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_8_headline_1) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 8 Headline 2') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_8_headline_2) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 8 Subline') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_8_subline) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 8 Button Link') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_8_button_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area8 World') ?>:</dt>
                        <dd><?= $feederInfluencer->has('area8_world') ? $this->Html->link($feederInfluencer->area8_world->name, ['controller' => 'FeederCategories', 'action' => 'view', $feederInfluencer->area8_world->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 8 Ig Name') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_8_ig_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 8 Ig Link') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_8_ig_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 9 Image') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_9_image) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 9 Headline 1') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_9_headline_1) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 9 Headline 2') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_9_headline_2) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 9 Subline') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_9_subline) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 9 Button Link') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_9_button_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area9 World') ?>:</dt>
                        <dd><?= $feederInfluencer->has('area9_world') ? $this->Html->link($feederInfluencer->area9_world->name, ['controller' => 'FeederCategories', 'action' => 'view', $feederInfluencer->area9_world->id]) : '' ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 9 Ig Name') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_9_ig_name) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Area 9 Ig Link') ?>:</dt>
                        <dd><?= h($feederInfluencer->area_9_ig_link) ?></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><?= __('Id') ?>:</dt>
                        <dd><?= $this->Number->format($feederInfluencer->id) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($feederInfluencer->feeder_influencer_mini_categories)) { ?>
    <div class="ibox">
        <div class="ibox-title">
            <h5><?= __('Related Feeder Influencer Mini Categories') ?></h5>
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
                            <th><?= __('Name') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Image') ?></th>
                            <th><?= __('Feeder Influencer Id') ?></th>
                            <th class="actions centered"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($feederInfluencer->feeder_influencer_mini_categories as $feederInfluencerMiniCategories): ?>
                        <tr>
                            <td><?= h($feederInfluencerMiniCategories->id) ?></td>
                            <td><?= h($feederInfluencerMiniCategories->name) ?></td>
                            <td><?= h($feederInfluencerMiniCategories->url) ?></td>
                            <td><?= h($feederInfluencerMiniCategories->image) ?></td>
                            <td><?= h($feederInfluencerMiniCategories->feeder_influencer_id) ?></td>
                            <td class="actions centered">
                                <?= $this->Html->link(__('View'), ['controller' => 'FeederInfluencerMiniCategories', 'action' => 'view', $feederInfluencerMiniCategories->id]) ?> |
                                <?= $this->Html->link(__('Edit'), ['controller' => 'FeederInfluencerMiniCategories', 'action' => 'edit', $feederInfluencerMiniCategories->id]) ?> |
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeederInfluencerMiniCategories', 'action' => 'delete', $feederInfluencerMiniCategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feederInfluencerMiniCategories->id)]) ?>
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
