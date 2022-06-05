<?= $this->Html->css('Feeder.homepageBannerConf'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New Feeder Homepage Banner') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Homepage Banners'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                    <?= $this->Form->create($feederHomepageBanner, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('feeder_homepage_id')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('feeder_homepage_id', ['label' => false, 'class' => 'form-control', 'options' => $feederHomepages, 'value' => 1]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('banner_image')); ?></label>
                        <?= $this->element('image_with_tags_input', ['image' => 'banner_image']); ?>
                        <div class="col-sm-10">
                            <div class="banner-image-preview">
                                <img id="img-banner-image" src="#" style="display: none;"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('breakpoint_images')); ?></label>
                        <div class="col-sm-10">
                            <button type="button" class="btndrp" data-toggle="collapse" data-target="#big" id="bigbnr">
                                Banner Breakpoints &#9660;
                            </button>

                            <div id="big" class="collapse">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 breakpoint-input">
                                    <label><?= $this->Form->label('Large', 'Picture Tag LG Breakpoint'); ?></label>
                                    <?= $this->Form->input('banner_bp_lg', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                                    <div class="banner-image-preview">
                                        <img id="img-banner-bp-lg" src="#" style="display: none;"/>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 breakpoint-input">
                                    <label><?= $this->Form->label('Medium', 'Picture Tag MD Breakpoint'); ?></label>
                                    <?= $this->Form->input('banner_bp_md', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                                    <div class="banner-image-preview">
                                        <img id="img-banner-bp-md" src="#" style="display: none;"/>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 breakpoint-input">
                                    <label><?= $this->Form->label('Small', 'Picture Tag SM Breakpoint'); ?></label>
                                    <?= $this->Form->input('banner_bp_sm', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                                    <div class="banner-image-preview">
                                        <img id="img-banner-bp-sm" src="#" style="display: none;"/>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 breakpoint-input">
                                    <label><?= $this->Form->label('ExtraSmall', 'Picture Tag XS Breakpoint'); ?></label>
                                    <?= $this->Form->input('banner_bp_xs', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                                    <div class="banner-image-preview">
                                        <img id="img-banner-bp-xs" src="#" style="display: none;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('banner_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('banner_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('headline')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('headline', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('headline_font_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('headline_font_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('caption')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('caption', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('caption_font_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('caption_font_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('text_background_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('text_background_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('opacity')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('opacity', ['label' => false, 'class' => 'form-control', 'type' => 'number', 'min' => '0', 'max' => '100']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('cta')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('cta', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('cta_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('cta_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('loader_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('loader_color', ['label' => false, 'class' => 'form-control']) ?>
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

            var _URL = window.URL || window.webkitURL;

            $('#banner-image, #banner-bp-lg, #banner-bp-md, #banner-bp-sm, #banner-bp-xs').change(function () {
                var file = this.files[0];
                var input = $(this);
                var targetWidth, targetHeight, size = 0;

                switch(input[0].id){
                    case 'banner-image':
                        targetWidth = 2700;
                        targetHeight = 700;
                        size = 300000;
                        break;
                    case 'banner-bp-lg':
                        targetWidth = 1920;
                        targetHeight = 500;
                        size = 150000;
                         break;
                    case 'banner-bp-md':
                        targetWidth = 1024;
                        targetHeight = 400;
                        size = 100000;
                        break;
                    case 'banner-bp-sm':
                        targetWidth = 991;
                        targetHeight = 400;
                        size = 100000;
                        break;
                    case 'banner-bp-xs':
                        targetWidth = 480;
                        targetHeight = 250;
                        size = 50000;
                        break;
                }

                if(file.type !== "image/jpeg"){
                    $('#error-' + input[0].id).remove();
                    $('<ul class="error" id="error-' + input[0].id + '"><li><?= __('File type must be jpg.') ?></li></ul>').insertBefore(input);
                    unsetFileinput(input);
                }else{
                    img = new Image();
                    img.src = _URL.createObjectURL(file);
                    img.onload = function () {
                        var errors = checkImage(file, this, input, targetWidth, targetHeight, size);
                        $('#error-' + input[0].id).remove();
                        if(errors.length !== 0){
                            $('<ul class="error" id="error-' + input[0].id + '"></ul>').insertBefore(input);
                            for(var i = 0; i < errors.length; i++){
                                $("#error-" + input[0].id).append('<li>' + errors[i] +'</li>');
                            }
                            unsetFileinput(input);
                        }else{
                            $("#img-" + input[0].id).attr('src', img.src).show();
                        }
                    };
                }
            });

            function unsetFileinput(input){
                input.wrap('<form>').closest('form').get(0).reset();
                input.unwrap();
                $("#img-" + input[0].id).attr('src', '#').hide();
            }

            function checkImage(file, img, input, targetWidth, targetHeight, size){
                var error = [];
                if(file.size >= size){
                    error.push('<?= __('Image size can not exceed') ?> ' + size/1000 + 'kb.');
                }
                if(img.width !== targetWidth){
                    error.push('<?= __('The width of this image must be') ?> ' + targetWidth + ' pixel.');
                }
                if(img.height !== targetHeight){
                    error.push('<?= __('The height of this image must be') ?> ' + targetHeight + ' pixel.');
                }
                return error;
            }
        });
    </script>
<?php $this->end() ?>
