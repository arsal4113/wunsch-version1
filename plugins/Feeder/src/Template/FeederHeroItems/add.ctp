<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New Feeder Hero Item') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Hero Items'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                    <?= $this->Form->create($feederHeroItem, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('type')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('type', ['type' => 'select','label' => false, 'class' => 'form-control', 'options' => [1 => __('1 Card Hero Item (Blue)'), 2 => __('2 Card Hero Item (Yellow)'), 3 => __('Quiz Banner Link (1 Card)'), 4 => __('Quiz Banner Link (2 Cards)')]]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('webm')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('webm',
                                ['label' => false, 'class' => 'form-control', 'type' => 'file', 'accept' => 'video/webm']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('mp4')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('mp4',
                                ['label' => false, 'class' => 'form-control', 'type' => 'file', 'accept' => 'video/mp4']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->element('image_with_tags_input', ['image' => 'image']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('item_id')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('item_id', ['type' => 'text','label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('url')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('url', ['type' => 'text','label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('item_image_url')) ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('item_image_url', ['type' => 'text','label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('gender')) ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->select('gender_id', $customerGenders) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('feeder_categories._ids')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('feeder_categories._ids', ['options' => $feederCategories, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('sort_order')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('sort_order', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('start_time')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->control('start_time',
                                ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('end_time')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->control('end_time',
                                ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
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
