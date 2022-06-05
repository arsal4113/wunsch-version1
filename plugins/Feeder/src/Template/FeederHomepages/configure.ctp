<?php
/** @var \Feeder\Model\Entity\FeederHomepage $feederHomepage */

?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Feeder Homepage') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <?= $this->Form->create($feederHomepage, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('main_logo')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('main_logo', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->link(
                                $this->Html->image($feederHomepage->main_logo, ['id' => 'logo', 'width' => '100px']),
                                $this->Url->image($feederHomepage->main_logo),
                                    ['download' => basename($feederHomepage->main_logo), 'escape' => false]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('time_logo')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('time_logo', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->link(
                                $this->Html->image($feederHomepage->time_logo, ['id' => 'logo', 'width' => '100px']),
                                $this->Url->image($feederHomepage->time_logo),
                                    ['download' => basename($feederHomepage->time_logo), 'escape' => false]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('logo_start_time')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->control('logo_start_time',
                                ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('logo_end_time')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->control('logo_end_time',
                                ['label' => false, 'class' => 'form-control', 'type' => 'date', 'minute' => false, 'empty' => ['year' => 'Choose year...', 'month' => 'Choose month...', 'day' => 'Choose day...', 'hour' => 'Choose hour...']]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('surprise_item_ids')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('surprise_item_ids', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('randomize_surprise_item_ids')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->checkbox('randomize_surprise_item_ids'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('feeder_category_id')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('feeder_category_id', ['label' => false, 'class' => 'form-control', 'options' => $feederCategories, 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('mini_cart_feeder_category_id')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('mini_cart_feeder_category_id', ['label' => false, 'class' => 'form-control', 'options' => $feederCategories, 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('Midpage Container')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('feeder_homepage_midpage_container_id', ['label' => false, 'class' => 'form-control', 'value' => $feederHomepage->feeder_homepage_midpage_container->id ?? null, 'options' => $feederHomepageMidpageContainers, 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('Meta Description') ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('meta_description', ['type' => 'text', 'label' => false, 'class' => 'form-control', 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('Title Tag') ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('title_tag', ['type' => 'text', 'label' => false, 'class' => 'form-control', 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('H1') ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('h1', ['type' => 'text', 'label' => false, 'class' => 'form-control', 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= __('H2') ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('h2', ['type' => 'text', 'label' => false, 'class' => 'form-control', 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('Robots Meta Tag')); ?></label>
                        <div class="col-sm-5">
                            <?php $robotsContent = ['index, follow','noindex, nofollow','noindex, follow'] ?>
                            <?= $this->Form->input('meta_robots_tag', ['class' => 'form-control', 'label' => false, 'empty' => ' ', 'options' => array_combine($robotsContent, $robotsContent)]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('activate_newsletter_popup')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->checkbox('activate_newsletter_popup'); ?>
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

            var _URL = window.URL || window.webkitURL;

            $('#main-logo, #time-logo').change(function () {
                var file = this.files[0];
                var input = $(this);
                img = new Image();
                img.src = _URL.createObjectURL(file);
                img.onload = function () {
                    if (this.width > 500 || this.height > 500) {
                        input.val(null);
                        alert('Image size should be less than 500 pixels.');
                    }
                };
            });
        });
    </script>
<?php $this->end() ?>
