<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New Feeder Influencer') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Influencers'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                    <?= $this->Form->create($feederInfluencer, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('url_path')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('url_path', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('title_tag')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('title_tag', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('meta_description')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('meta_description', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('robot_tag')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('robot_tag', [
                                'label' => false,
                                'class' => 'form-control',
                                'options' => [
                                    'index, follow' => 'index, follow',
                                    'noindex, follow' => 'noindex, follow',
                                    'noindex, nofollow' => 'noindex, nofollow',
                                    'noindex' => 'noindex'
                                ],
                                'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_1_headline')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_1_headline', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_1_text')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_1_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_2_text')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_2_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_2_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_2_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_3_image')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_3_image', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_3_video')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_3_video', ['label' => false, 'class' => 'form-control file-upload video-upload', 'type' => 'file', 'accept' => 'video/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?php
                            if ($feederInfluencer->area_3_video) {
                                echo '<input type="button" class="btn btn-sm btn-primary remove-button m" value="' . __('Remove') . '">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_5_text')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_5_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_5_image_1')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_5_image_1', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_5_image_2')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_5_image_2', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_5_image_3')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_5_image_3', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_5_image_4')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_5_image_4', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_5_image_5')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_5_image_5', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_5_image_6')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_5_image_6', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_6_image_1')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_6_image_1', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_6_image_2')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_6_image_2', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_6_image_3')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_6_image_3', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_7_text')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_7_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_7_text_mobile')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_7_text_mobile', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_8_image')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_8_image', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_8_headline_1')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_8_headline_1', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_8_headline_2')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_8_headline_2', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_8_subline')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_8_subline', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_8_button_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_8_button_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_8_world_id')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_8_world_id', ['label' => false, 'class' => 'form-control', 'options' => $area8Worlds, 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_8_ig_name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_8_ig_name', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_8_ig_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_8_ig_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_9_image')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('area_9_image', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->Html->image('', ['class' => 'preview-image', 'width' => '200px']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_9_headline_1')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_9_headline_1', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_9_headline_2')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_9_headline_2', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_9_subline')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_9_subline', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_9_button_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_9_button_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_9_world_id')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_9_world_id', ['label' => false, 'class' => 'form-control', 'options' => $area9Worlds, 'empty' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_9_ig_name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_9_ig_name', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('area_9_ig_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('area_9_ig_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                        </div>
                    </div>
                    <?= $this->Form->input('removed_media', ['type' => 'hidden']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script') ?>
    <script>
        function previewFileUpload() {
            const input = $(this);
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewImage = input.closest('.form-group').find('.preview-image');
                    previewImage.attr('src', e.target.result).show();

                    const removeButton = '<input type="button" class="btn btn-sm btn-primary remove-button m" value="<?= __('Remove') ?>">';
                    if (input.closest('.form-group').find('.remove-button').length === 0) {
                        previewImage.after(removeButton);
                    }
                };
                reader.readAsDataURL(this.files[0]);
            }
        }

        function resetFileUpload(removeButton) {
            if (removeButton && removeButton.length > 0) {
                removeButton.prev('.preview-image').attr('src', '').hide();
                const fileUpload = removeButton.closest('.form-group').find('.file-upload');
                fileUpload.val('');
                removeButton.remove();
                $('#removed-media').val($('#removed-media').val() + fileUpload.attr('name') + ',')
            }
        }

        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('form .preview-image').hide();
            $('.file-upload').not('.video-upload').change(previewFileUpload);
            $('form').on('click', '.remove-button', function (e) {
                resetFileUpload($(this));
            });
        });
    </script>
<?php $this->end() ?>
