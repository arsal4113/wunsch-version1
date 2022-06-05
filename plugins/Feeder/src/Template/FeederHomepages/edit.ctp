<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Feeder Homepage') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Homepages'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $feederHomepage->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $feederHomepage->id)]
                    )
                    ?>
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
                    <?= $this->Form->create($feederHomepage, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('big_banner_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('big_banner_image', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('big_banner_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('big_banner_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('first_small_banner_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('first_small_banner_image', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('first_small_banner_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('first_small_banner_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('second_small_banner_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('second_small_banner_image', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('second_small_banner_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('second_small_banner_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('third_small_banner_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('third_small_banner_image', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('third_small_banner_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('third_small_banner_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('fourth_small_banner_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('fourth_small_banner_image', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('fourth_small_banner_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('fourth_small_banner_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('surprise_item_ids')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('surprise_item_ids', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('feeder_category_id')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('feeder_category_id', ['label' => false, 'class' => 'form-control', 'options' => $feederCategories, 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('mini_cart_feeder_category_id')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('mini_cart_feeder_category_id', ['label' => false, 'class' => 'form-control', 'options' => $feederCategories, 'empty' => true]) ?>
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
