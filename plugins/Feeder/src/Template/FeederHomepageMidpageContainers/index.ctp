<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Homepage Midpage Containers') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Homepage Midpage Container'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('id') ?></th>
                                    <th><?= $this->Paginator->sort('homepage_id') ?></th>
                                    <th><?= $this->Paginator->sort('videos') ?></th>
                                    <th><?= $this->Paginator->sort('images') ?></th>
                                    <th><?= $this->Paginator->sort('use_video') ?></th>
                                    <th><?= $this->Paginator->sort('click_url') ?></th>
                                    <th><?= $this->Paginator->sort('header_text') ?></th>
                                    <th><?= $this->Paginator->sort('button_text') ?></th>
                                    <th><?= $this->Paginator->sort('button_color') ?></th>
                                    <th><?= $this->Paginator->sort('background_color') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederHomepageMidpageContainers as $feederHomepageMidpageContainer): ?>
                            <tr>
                                <td><?= $this->Number->format($feederHomepageMidpageContainer->id) ?></td>
                                <td>
                                    <?= $feederHomepageMidpageContainer->has('feeder_homepage') ? $this->Html->link($feederHomepageMidpageContainer->feeder_homepage->id, ['controller' => 'FeederHomepages', 'action' => 'view', $feederHomepageMidpageContainer->feeder_homepage->id]) : '' ?>
                                </td>
                                <td><?= 'Desktop Mp4: ' . $feederHomepageMidpageContainer->video_desktop_mp4 . '<br>' .
                                        'Desktop Webm: ' . $feederHomepageMidpageContainer->video_desktop_webm . '<br>' .
                                        'Tablet Mp4: ' . $feederHomepageMidpageContainer->video_tablet_mp4 . '<br>' .
                                        'Tablet Webm: ' . $feederHomepageMidpageContainer->video_tablet_webm . '<br>' .
                                        'Mobile Mp4: ' . $feederHomepageMidpageContainer->video_mobile_mp4 . '<br>' .
                                        'Mobile Webm: ' . $feederHomepageMidpageContainer->video_mobile_webm . '<br>' ?></td>
                                <td><?= 'Desktop: ' . $feederHomepageMidpageContainer->image_desktop . '<br>' .
                                        'Tablet: ' . $feederHomepageMidpageContainer->image_tablet . '<br>' .
                                        'Mobile: ' . $feederHomepageMidpageContainer->image_mobile . '<br>' ?></td>
                                <td><?= h($feederHomepageMidpageContainer->use_video) ?></td>
                                <td><?= h($feederHomepageMidpageContainer->click_url) ?></td>
                                <td><?= h($feederHomepageMidpageContainer->header_text) ?></td>
                                <td><?= h($feederHomepageMidpageContainer->button_text) ?></td>
                                <td><?= h($feederHomepageMidpageContainer->button_color) ?></td>
                                <td><?= h($feederHomepageMidpageContainer->background_color) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederHomepageMidpageContainer->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederHomepageMidpageContainer->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederHomepageMidpageContainer->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederHomepageMidpageContainer->id)]) ?></li>
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
