<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Influencers') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Influencer'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?= $this->element('simple_search'); ?>

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('id') ?></th>
                                    <th><?= $this->Paginator->sort('name') ?></th>
                                    <th><?= $this->Paginator->sort('url_path') ?></th>
                                    <th><?= $this->Paginator->sort('title_tag') ?></th>
                                    <th><?= $this->Paginator->sort('meta_description') ?></th>
                                    <th><?= $this->Paginator->sort('robot_tag') ?></th>
                                    <th><?= $this->Paginator->sort('area_1_headline') ?></th>
                                    <th><?= $this->Paginator->sort('area_1_text') ?></th>
                                    <th><?= $this->Paginator->sort('area_2_text') ?></th>
                                    <th><?= $this->Paginator->sort('area_2_link') ?></th>
                                    <th><?= $this->Paginator->sort('area_3_image') ?></th>
                                    <th><?= $this->Paginator->sort('area_3_video') ?></th>
                                    <th><?= $this->Paginator->sort('area_5_text') ?></th>
                                    <th><?= $this->Paginator->sort('area_5_image_1') ?></th>
                                    <th><?= $this->Paginator->sort('area_5_image_2') ?></th>
                                    <th><?= $this->Paginator->sort('area_5_image_3') ?></th>
                                    <th><?= $this->Paginator->sort('area_5_image_4') ?></th>
                                    <th><?= $this->Paginator->sort('area_5_image_5') ?></th>
                                    <th><?= $this->Paginator->sort('area_5_image_6') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederInfluencers as $feederInfluencer): ?>
                            <tr>
                                <td><?= $this->Number->format($feederInfluencer->id) ?></td>
                                <td><?= h($feederInfluencer->name) ?></td>
                                <td><?= h($feederInfluencer->url_path) ?></td>
                                <td><?= h($feederInfluencer->title_tag) ?></td>
                                <td><?= h($feederInfluencer->meta_description) ?></td>
                                <td><?= h($feederInfluencer->robot_tag) ?></td>
                                <td><?= h($feederInfluencer->area_1_headline) ?></td>
                                <td><?= h($feederInfluencer->area_1_text) ?></td>
                                <td><?= h($feederInfluencer->area_2_text) ?></td>
                                <td><?= h($feederInfluencer->area_2_link) ?></td>
                                <td><?= h($feederInfluencer->area_3_image) ?></td>
                                <td><?= h($feederInfluencer->area_3_video) ?></td>
                                <td><?= h($feederInfluencer->area_5_text) ?></td>
                                <td><?= h($feederInfluencer->area_5_image_1) ?></td>
                                <td><?= h($feederInfluencer->area_5_image_2) ?></td>
                                <td><?= h($feederInfluencer->area_5_image_3) ?></td>
                                <td><?= h($feederInfluencer->area_5_image_4) ?></td>
                                <td><?= h($feederInfluencer->area_5_image_5) ?></td>
                                <td><?= h($feederInfluencer->area_5_image_6) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederInfluencer->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederInfluencer->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederInfluencer->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederInfluencer->id)]) ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $this->element('paginator'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
