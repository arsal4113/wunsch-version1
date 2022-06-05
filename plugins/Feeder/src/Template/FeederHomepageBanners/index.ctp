<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Homepage Banners') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Homepage Banner'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('feeder_homepage_id') ?></th>
                                    <th><?= $this->Paginator->sort('banner_image') ?></th>
                                    <th><?= $this->Paginator->sort('banner_link') ?></th>
                                    <th><?= $this->Paginator->sort('headline') ?></th>
                                    <th><?= $this->Paginator->sort('sort_order') ?></th>
                                    <th><?= $this->Paginator->sort('start_time') ?></th>
                                    <th><?= $this->Paginator->sort('end_time') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederHomepageBanners as $feederHomepageBanner): ?>
                            <tr>
                                <td><?= $this->Number->format($feederHomepageBanner->id) ?></td>
                                <td>
                                    <?= $feederHomepageBanner->has('feeder_homepage') ? $this->Html->link($feederHomepageBanner->feeder_homepage->id, ['controller' => 'FeederHomepages', 'action' => 'view', $feederHomepageBanner->feeder_homepage->id]) : '' ?>
                                </td>
                                <td><?= h($feederHomepageBanner->banner_image) ?></td>
                                <td><?= h($feederHomepageBanner->banner_link) ?></td>
                                <td><?= h($feederHomepageBanner->headline) ?></td>
                                <td><?= $this->Number->format($feederHomepageBanner->sort_order) ?></td>
                                <td><?= h($feederHomepageBanner->start_time) ?></td>
                                <td><?= h($feederHomepageBanner->end_time) ?></td>
                                <td><?= h($feederHomepageBanner->modified) ?></td>
                                <td><?= h($feederHomepageBanner->created) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederHomepageBanner->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederHomepageBanner->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederHomepageBanner->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederHomepageBanner->id)]) ?></li>
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
