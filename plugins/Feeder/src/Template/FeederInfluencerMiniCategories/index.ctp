<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Feeder Influencer Mini Categories') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Feeder Influencer Mini Category'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('url') ?></th>
                                    <th><?= $this->Paginator->sort('image') ?></th>
                                    <th><?= $this->Paginator->sort('feeder_influencer_id') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($feederInfluencerMiniCategories as $feederInfluencerMiniCategory): ?>
                            <tr>
                                <td><?= $this->Number->format($feederInfluencerMiniCategory->id) ?></td>
                                <td><?= h($feederInfluencerMiniCategory->name) ?></td>
                                <td><?= h($feederInfluencerMiniCategory->url) ?></td>
                                <td><?= h($feederInfluencerMiniCategory->image) ?></td>
                                <td>
                                    <?= $feederInfluencerMiniCategory->has('feeder_influencer') ? $this->Html->link($feederInfluencerMiniCategory->feeder_influencer->name, ['controller' => 'FeederInfluencers', 'action' => 'view', $feederInfluencerMiniCategory->feeder_influencer->id]) : '' ?>
                                </td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $feederInfluencerMiniCategory->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $feederInfluencerMiniCategory->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $feederInfluencerMiniCategory->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $feederInfluencerMiniCategory->id)]) ?></li>
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
