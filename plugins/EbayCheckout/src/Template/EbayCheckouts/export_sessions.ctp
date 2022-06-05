<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Download Checkout Sessions Data') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->getParam('controller'))) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->getParam('action'))) ?></strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->Form->create(false, ['class' => 'form-horizontal style-form']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('startTime')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->control('startTime',
                            ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'default' => $startTime,
                            'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('endTime')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->control('endTime',
                            ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'default' => $endTime,
                            'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                        </div>
                    </div>
                    <?php foreach ($filteredValues as $filteredValue) { ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__($filteredValue)); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input($filteredValue,
                            [ 'multiple' => true, 'options' => $$filteredValue, 'label' => false]) ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('subscribedNewsletter')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('subscribedNewsletter',
                            ['label' => false, 'type' => 'select', 'empty' => ' ', 'options' => [true => 'Yes', false => 'No']]) ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= $this->Html->link(__('Cancel'), ['action' => 'exportSessions'], ['class' => 'btn btn-sm btn-danger']) ?>
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
