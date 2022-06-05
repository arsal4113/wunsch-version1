<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New Feeder Homepage Midpage Container') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Homepage Midpage Containers'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                    <?= $this->Form->create($feederHomepageMidpageContainer, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('use_video')); ?></label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                                <?= $this->Form->input('use_video', ['label' => false, 'class' => 'custom-checkbox', 'id' => 'use-video']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group video-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('video_desktop_mp4')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('video_desktop_mp4', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'video/mp4']) ?>
                        </div>
                    </div>
                    <div class="form-group video-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('video_desktop_webm')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('video_desktop_webm', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'video/webm']) ?>
                        </div>
                    </div>
                    <div class="form-group video-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('video_tablet_mp4')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('video_tablet_mp4', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'video/mp4']) ?>
                        </div>
                    </div>
                    <div class="form-group video-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('video_tablet_webm')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('video_tablet_webm', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'video/webm']) ?>
                        </div>
                    </div>
                    <div class="form-group video-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('video_mobile_mp4')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('video_mobile_mp4', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'video/mp4']) ?>
                        </div>
                    </div>
                    <div class="form-group video-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('video_mobile_webm')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('video_mobile_webm', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'video/webm']) ?>
                        </div>
                    </div>
                    <div class="form-group image-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('image_desktop')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('image_desktop', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'image/*']) ?>
                        </div>
                    </div>
                    <div class="form-group image-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('image_tablet')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('image_tablet', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'image/*']) ?>
                        </div>
                    </div>
                    <div class="form-group image-file-input">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('image_mobile')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('image_mobile', ['type' => 'file', 'label' => false, 'class' => 'form-control', 'accept' => 'image/*']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('click_url')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('click_url', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('header_text')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('header_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('button_text')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('button_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('button_color')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('button_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('background_color')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('background_color', ['label' => false, 'class' => 'form-control']) ?>
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

            $('#use-video').on('ifToggled', function () {
                displayVideoFileInput($(this).is(':checked'))
            });
        });

        function displayVideoFileInput(useVideo) {

            if (useVideo) {
                $('.video-file-input').css('display', 'block');
                $('.image-file-input').css('display', 'none');
            } else {
                $('.video-file-input').css('display', 'none');
                $('.image-file-input').css('display', 'block');
            }
        }

        displayVideoFileInput(false);
    </script>
<?php $this->end() ?>
