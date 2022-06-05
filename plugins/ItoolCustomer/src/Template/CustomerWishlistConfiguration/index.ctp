<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('Customer Wishlist Configuration') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
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
                                    <th><?= $this->Paginator->sort('randomize') ?></th>
                                    <th><?= $this->Paginator->sort('banner_products_factor') ?></th>
                                    <th><?= $this->Paginator->sort('banner_small_positions') ?></th>
                                    <th><?= $this->Paginator->sort('banner_large_positions') ?></th>
                                    <th class="actions centered"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($customerWishlistConfigurations as $customerWishlistConfiguration): ?>
                            <tr>
                                <td><?= h($customerWishlistConfiguration->id) ?></td>
                                <td><?= h($customerWishlistConfiguration->randomize) ?></td>
                                <td><?= h($customerWishlistConfiguration->banner_products_factor) ?></td>
                                <td><?= h($customerWishlistConfiguration->banner_small_positions) ?></td>
                                <td><?= h($customerWishlistConfiguration->banner_large_positions) ?></td>
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
