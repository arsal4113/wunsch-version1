<div class="row mt">
    <div class="col-lg-9">
        <h3><i class="fa fa-angle-right"></i> <?= h($coreErrorNotificationProfile->name) ?></h3>
    </div>
    <div class="col-lg-3">
        <div class="btn-group btn-group-justified btn-actions">
            <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                    <?= __('Core Error Notification Profiles') ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><?= $this->Html->link(__('List of Core Error Notification Profiles'), ['action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Add New Core Error Notification Profile'), ['action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('Edit Core Error Notification Profile'), ['action' => 'edit', $coreErrorNotificationProfile->id]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Form->postLink(__('Delete Core Error Notification Profile'), ['action' => 'delete', $coreErrorNotificationProfile->id], ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $coreErrorNotificationProfile->id)]) ?> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section id="unseen">
    <h4 class="mb"><i class="fa fa-angle-right"></i> <?= __('General Information') ?></h4>
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Core Seller')); ?></label>
        <div class="col-sm-10">
            <p><?= $coreErrorNotificationProfile->has('core_seller') ? $this->Html->link($coreErrorNotificationProfile->core_seller->name, ['controller' => 'CoreSellers', 'action' => 'view', $coreErrorNotificationProfile->core_seller->id]) : '' ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Name')); ?></label>
        <div class="col-sm-10">
            <p><?= h($coreErrorNotificationProfile->name) ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Type')); ?></label>
        <div class="col-sm-10">
            <p><?= h($coreErrorNotificationProfile->type) ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Code')); ?></label>
        <div class="col-sm-10">
            <p><?= h($coreErrorNotificationProfile->code) ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Sub Code')); ?></label>
        <div class="col-sm-10">
            <p><?= h($coreErrorNotificationProfile->sub_code) ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Email To')); ?></label>
        <div class="col-sm-10">
            <p><?= h($coreErrorNotificationProfile->email_to) ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Email Cc')); ?></label>
        <div class="col-sm-10">
            <p><?= h($coreErrorNotificationProfile->email_cc) ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Email Bcc')); ?></label>
        <div class="col-sm-10">
            <p><?= h($coreErrorNotificationProfile->email_bcc) ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Email Subject')); ?></label>
        <div class="col-sm-10">
            <p><?= h($coreErrorNotificationProfile->email_subject) ?></p>
        </div>
    	</div>  
	</div>         
	<div class="row"> 
    	<div class="form-group">
    	    <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Id')); ?></label>
    	    <div class="col-sm-10">
    	        <p><?= $this->Number->format($coreErrorNotificationProfile->id) ?></p>
    	    </div>
    	</div>
	</div>
	<div class="row"> 
    	<div class="form-group">
    	    <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Run Interval')); ?></label>
    	    <div class="col-sm-10">
    	        <p><?= $this->Number->format($coreErrorNotificationProfile->run_interval) ?></p>
    	    </div>
    	</div>
	</div>
	<div class="row"> 
    	<div class="form-group">
    	    <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Max Execution Time')); ?></label>
    	    <div class="col-sm-10">
    	        <p><?= $this->Number->format($coreErrorNotificationProfile->max_execution_time) ?></p>
    	    </div>
    	</div>
	</div>
	<div class="row"> 
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Last Run')); ?></label>
	        <div class="col-sm-10">
	            <p><?= h($coreErrorNotificationProfile->last_run) ?></p>
	        </div>
	    </div>
	</div>
	<div class="row"> 
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Next Run')); ?></label>
	        <div class="col-sm-10">
	            <p><?= h($coreErrorNotificationProfile->next_run) ?></p>
	        </div>
	    </div>
	</div>
	<div class="row"> 
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Last Alive')); ?></label>
	        <div class="col-sm-10">
	            <p><?= h($coreErrorNotificationProfile->last_alive) ?></p>
	        </div>
	    </div>
	</div>
	<div class="row"> 
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Created')); ?></label>
	        <div class="col-sm-10">
	            <p><?= h($coreErrorNotificationProfile->created) ?></p>
	        </div>
	    </div>
	</div>
	<div class="row"> 
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Modified')); ?></label>
	        <div class="col-sm-10">
	            <p><?= h($coreErrorNotificationProfile->modified) ?></p>
	        </div>
	    </div>
	</div>
	<div class="row">
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Is Active')); ?></label>
	        <div class="col-sm-10">
	            <p><?= $coreErrorNotificationProfile->is_active ? __('Yes') : __('No'); ?></p>
	        </div>
	    </div>
	</div>
	<div class="row">
	    <div class="form-group">
	        <label class="col-sm-2 col-sm-2 control-label"><?= $this->Form->label(__('Is Running')); ?></label>
	        <div class="col-sm-10">
	            <p><?= $coreErrorNotificationProfile->is_running ? __('Yes') : __('No'); ?></p>
	        </div>
	    </div>
	</div>
</section>
