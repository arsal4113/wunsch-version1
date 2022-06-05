<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Feeder Influencer Mini Category') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Influencer Mini Categories'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $feederInfluencerMiniCategory->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $feederInfluencerMiniCategory->id)]
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
                    <?= $this->Form->create($feederInfluencerMiniCategory, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('url')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('url', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('image')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('image', ['label' => false, 'class' => 'form-control file-upload', 'type' => 'file', 'accept' => 'image/*']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?php
                                if ($feederInfluencerMiniCategory->image) {
                                    echo $this->Html->image($feederInfluencerMiniCategory->image, ['class' => 'preview-image', 'width' => '200px']);
                                    echo '<input type="button" class="btn btn-sm btn-primary remove-button m" value="' . __('Remove') . '">';
                                } else {
                                    echo $this->Html->image('', ['style' => 'display: none', 'class' => 'preview-image', 'width' => '200px']);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('feeder_influencer_id')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('feeder_influencer_id', ['label' => false, 'class' => 'form-control', 'options' => $feederInfluencers]) ?>
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

            $('.file-upload').change(previewFileUpload);
            $('form').on('click', '.remove-button', function (e) {
                resetFileUpload($(this));
            });
        });
    </script>
<?php $this->end() ?>
