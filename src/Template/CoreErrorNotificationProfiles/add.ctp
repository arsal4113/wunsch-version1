<div class="row mt">
    <div class="col-lg-9">
        <h3><i class="fa fa-angle-right"></i> <?= __('Add New Core Error Notification Profile') ?></h3>
    </div>
    <div class="col-lg-3">
        <div class="btn-group btn-group-justified btn-actions">
            <div class="btn-group">
                <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Core Error Notification Profiles'), ['action' => 'index'], ['class' => 'btn btn-sm btn-info', 'escape' => false]) ?>
            </div>
        </div>
    </div>    
</div>
<section id="unseen">
    <?= $this->Form->create($coreErrorNotificationProfile, ['class' => 'form-horizontal style-form']); ?>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('core_seller_id')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('core_seller_id', ['label' => false, 'class' => 'form-control', 'options' => $coreSellers, 'empty' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('name')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('type')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('type', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('code')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('code', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('sub_code')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('sub_code', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('email_to')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('email_to', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('email_cc')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('email_cc', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('email_bcc')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('email_bcc', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('email_subject')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('email_subject', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('is_active')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('is_active', ['label' => false, 'class' => 'custom-checkbox']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('is_running')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('is_running', ['label' => false, 'class' => 'custom-checkbox']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('last_run')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('last_run', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('run_interval')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('run_interval', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('next_run')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('next_run', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('max_execution_time')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('max_execution_time', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('last_alive')); ?></label>
        <div class="col-sm-10">
            <?= $this->Form->input('last_alive', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="btn-group form-actions">
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-default btn-sm btn-success']) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
    </div>    
    <?= $this->Form->end() ?>
</section>
