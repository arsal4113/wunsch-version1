<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New eBay Account') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of eBay Accounts'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->Form->create($ebayAccount, ['class' => 'form-horizontal style-form']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label('is_active'); ?></label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                                <?= $this->Form->input('is_active', ['type' => 'checkbox', 'label' => false]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('code')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('code', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('eBay Account Type'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('ebay_account_type_id', ['label' => false, 'class' => 'form-control', 'options' => $ebayAccountTypes]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('eBay Credential'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('ebay_credential_id', ['label' => false, 'class' => 'form-control', 'options' => $ebayCredentials]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('Seller')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('core_seller_id', ['label' => false, 'class' => 'form-control', 'options' => $coreSellers]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('epn_identifier')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('epn_identifier', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('eBay Sites'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('ebay_sites._ids', ['options' => $ebaySites, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script') ?>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
<?php $this->end() ?>
