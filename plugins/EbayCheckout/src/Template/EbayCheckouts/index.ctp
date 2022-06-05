<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Ebay Checkouts') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Ebay Checkout'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                                    <th><?= $this->Paginator->sort('core_seller_id') ?></th>
                                    <th><?= $this->Paginator->sort('name') ?></th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('x_frame_origins') ?></th>
                                    <th><?= $this->Paginator->sort('logo') ?></th>
                                    <th><?= $this->Paginator->sort('main_color') ?></th>
                                    <th><?= $this->Paginator->sort('second_color') ?></th>
                                    <th><?= $this->Paginator->sort('font') ?></th>
                                    <th><?= $this->Paginator->sort('font_color') ?></th>
                                    <th><?= $this->Paginator->sort('background_image') ?></th>
                                    <th><?= $this->Paginator->sort('background_image_position') ?></th>
                                    <th><?= $this->Paginator->sort('background_color') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ebayCheckouts as $ebayCheckout): ?>
                            <tr>
                                <td><?= $this->Number->format($ebayCheckout->id) ?></td>
                                <td>
                                    <?= $ebayCheckout->has('core_seller') ? $this->Html->link($ebayCheckout->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $ebayCheckout->core_seller->id]) : '' ?>
                                </td>
                                <td><?= h($ebayCheckout->name) ?></td>
                                <td><?= h($ebayCheckout->title) ?></td>
                                <td><?= h($ebayCheckout->x_frame_origins) ?></td>
                                <td><?= h($ebayCheckout->logo) ?></td>
                                <td><?= h($ebayCheckout->main_color) ?></td>
                                <td><?= h($ebayCheckout->second_color) ?></td>
                                <td><?= h($ebayCheckout->font) ?></td>
                                <td><?= h($ebayCheckout->font_color) ?></td>
                                <td><?= h($ebayCheckout->background_image) ?></td>
                                <td><?= h($ebayCheckout->background_image_position) ?></td>
                                <td><?= h($ebayCheckout->background_color) ?></td>
                                <td><?= h($ebayCheckout->modified) ?></td>
                                <td><?= h($ebayCheckout->created) ?></td>
                                <td class="actions centered">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?= __('Actions') ?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link('<i class="fa fa-search"></i>' . ' ' . __('View'), ['action' => 'view', $ebayCheckout->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $ebayCheckout->id], ['escape' => false]) ?></li>
                                            <li><?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $ebayCheckout->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $ebayCheckout->id)]) ?></li>
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
