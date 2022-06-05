<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('List of Customers') ?></h2>
        <ol class="breadcrumb">
            <li><?= __('Customers') ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Customer'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?= $this->element('simple_search'); ?>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <?php foreach ($coreCustomers as $coreCustomer): ?>
                        <div class="col-lg-3">
                            <div class="contact-box center-version">
                                <a href="#">
                                    <?= $this->Html->image('/img/landing/shattered.png', ['alt' => 'avatar', 'class' => 'img-circle']) ?>
                                    <h3 class="m-b-xs"><strong><?= h($coreCustomer->firstname) . ' ' . h($coreCustomer->lastname) ?></strong></h3>
                                    <small><?= h($coreCustomer->core_seller->name) ?></small><br/>
                                    <small><?= h($coreCustomer->email) ?></small>
                                    <div class="hr-line-dashed"></div>
                                    <small><?= __('Created: ') . $this->Time->nice($coreCustomer->created) ?></small><br/>
                                    <small><?= __('Modified: ') . $this->Time->nice($coreCustomer->modified) ?></small>
                                </a>
                                <div class="contact-box-footer">
                                    <div class="m-t-xs btn-group">
                                        <?= $this->Html->link('<i class="fa fa-pencil"></i>' . ' ' . __('Edit'), ['action' => 'edit', $coreCustomer->id], ['escape' => false, 'class' => 'btn btn-xs btn-white']) ?>
                                        <?= $this->Form->postLink('<i class="fa fa-trash"></i>' . ' ' . __('Delete'), ['action' => 'delete', $coreCustomer->id], ['escape' => false, 'class' => 'btn btn-xs btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $coreCustomer->id)]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="clearfix"></div>
                    <?= $this->element('paginator'); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
