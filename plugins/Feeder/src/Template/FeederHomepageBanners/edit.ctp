<?= $this->Html->css('Feeder.homepageBannerConf'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Feeder Homepage Banner') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Homepage Banners'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $feederHomepageBanner->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $feederHomepageBanner->id)]
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
                            <?php
                            $bannerImageName = explode('/', $feederHomepageBanner->banner_image);
                            $bannerImageName = end($bannerImageName); ?>
                            <div class="banner-image-preview">
                                <?= $this->Html->image($feederHomepageBanner->banner_image, ['id' => 'img-banner-image']); ?>
                                <a href="<?= $feederHomepageBanner->banner_image ?>" data-filename="<?= $bannerImageName ?>" class="img-download-button">Click to Download</a>
                            </div>
                            <p class="image-name"><?= $bannerImageName ?>
                                <a href="<?= $feederHomepageBanner->banner_image ?>" data-filename="<?= $bannerImageName ?>" class="alt-img-download-button" style="display: none">Download (old)</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('breakpoint_images')); ?></label>
                        <div class="col-sm-10">
                            <button type="button" class="btndrp" id="bigbnr">
                                Banner Breakpoints &#9660;
                            </button>
                            <div id="big" class="collapse">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 breakpoint-input">
                                    <label><?= $this->Form->label('Large', 'Picture Tag LG Breakpoint'); ?></label>
                                    <?= $this->Form->input('banner_bp_lg', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                                    <?php
                                    $bannerImageName = explode('/', $feederHomepageBanner->banner_bp_lg);
                                    $bannerImageName = end($bannerImageName);?>
                                    <div class="banner-image-preview">
                                        <?= $this->Html->image($feederHomepageBanner->banner_bp_lg, ['id' => 'img-banner-bp-lg']); ?>
                                        <a href="<?= $feederHomepageBanner->banner_bp_lg ?>" data-filename="<?= $bannerImageName ?>" class="img-download-button">Click to Download</a>
                                    </div>
                                    <p class="image-name"><?= $bannerImageName ?>
                                        <a href="<?= $feederHomepageBanner->banner_bp_lg ?>" data-filename="<?= $bannerImageName ?>" class="alt-img-download-button" style="display: none">Download (old)</a>
                                    </p>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 breakpoint-input">
                                    <label><?= $this->Form->label('Medium', 'Picture Tag MD Breakpoint'); ?></label>
                                    <?= $this->Form->input('banner_bp_md', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                                    <?php
                                    $bannerImageName = explode('/', $feederHomepageBanner->banner_bp_md);
                                    $bannerImageName = end($bannerImageName); ?>
                                    <div class="banner-image-preview">
                                        <?= $this->Html->image($feederHomepageBanner->banner_bp_md, ['id' => 'img-banner-bp-md']); ?>
                                        <a href="<?= $feederHomepageBanner->banner_bp_md ?>" data-filename="<?= $bannerImageName ?>" class="img-download-button md-font">Click to Download</a>
                                    </div>
                                    <p class="image-name"><?= $bannerImageName ?>
                                        <a href="<?= $feederHomepageBanner->banner_bp_md ?>" data-filename="<?= $bannerImageName ?>" class="alt-img-download-button" style="display: none;">Download (old)</a>
                                    </p>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 breakpoint-input">
                                    <label><?= $this->Form->label('Small', 'Picture Tag SM Breakpoint'); ?></label>
                                    <?= $this->Form->input('banner_bp_sm', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                                    <?php
                                    $bannerImageName = explode('/', $feederHomepageBanner->banner_bp_sm);
                                    $bannerImageName = end($bannerImageName); ?>
                                    <div class="banner-image-preview">
                                        <?= $this->Html->image($feederHomepageBanner->banner_bp_sm, ['id' => 'img-banner-bp-sm']); ?>
                                        <a href="<?= $feederHomepageBanner->banner_bp_sm ?>" data-filename="<?= $bannerImageName ?>" class="img-download-button sm-font">Click to Download</a>
                                    </div>
                                    <p class="image-name"><?= $bannerImageName ?>
                                        <a href="<?= $feederHomepageBanner->banner_bp_sm ?>" data-filename="<?= $bannerImageName ?>" class="alt-img-download-button" style="display: none;">Download (old)</a>
                                    </p>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 breakpoint-input">
                                    <label><?= $this->Form->label('ExtraSmall', 'Picture Tag XS Breakpoint'); ?></label>
                                    <?= $this->Form->input('banner_bp_xs', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                                    <?php
                                    $bannerImageName = explode('/', $feederHomepageBanner->banner_bp_xs);
                                    $bannerImageName = end($bannerImageName); ?>
                                    <div class="banner-image-preview">
                                        <?= $this->Html->image($feederHomepageBanner->banner_bp_xs, ['id' => 'img-banner-bp-xs']); ?>
                                        <a href="<?= $feederHomepageBanner->banner_bp_xs ?>" data-filename="<?= $bannerImageName ?>" class="img-download-button xs-font">Click to Download</a>
                                    </div>
                                    <p class="image-name"><?= $bannerImageName ?>
                                        <a href="<?= $feederHomepageBanner->banner_bp_xs ?>" data-filename="<?= $bannerImageName ?>" class="alt-img-download-button" style="display: none">Download (old)</a>
                                    </p>
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
                radioClass: 'iradio_square-green'
            });

            var _URL = window.URL || window.webkitURL;

            /**
             * hides the download button in case the images got deleted on the server while their path remains in the database
             */
            $('.banner-image-preview').each(function () {
                if($(this).find('img').width() === 0){
                    $(this).find('.img-download-button').hide();
                }
            });
            /**
             * show the download links on the images if they exist
             */
            $('#bigbnr').click(function () {
                if($('#big').is(':visible')){
                    $('#big').slideUp();
                }else{
                    $('#big').slideDown(function () {
                        $('.banner-image-preview').each(function () {
                            if($(this).find('img').width() === 0){
                                $(this).find('.img-download-button').hide();
                            }else{
                                $(this).find('.img-download-button').show();
                            }
                        });
                    });
                }
            });

            /**
             * sets the conditions for the uploaded image and manages the display of the uploaded image and the related buttons
             */
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
                        var errors = checkImage(file, this, targetWidth, targetHeight, size);
                        $('#error-' + input[0].id).remove();
                        if(errors.length !== 0){
                            if(input.attr("id") === "banner-image"){
                                input.closest('.col-sm-10').find('.img-download-button').hide();
                                input.closest('.col-sm-10').find('.alt-img-download-button').show();
                            }else{
                                input.closest('.breakpoint-input').find('.img-download-button').hide();
                                input.closest('.breakpoint-input').find('.alt-img-download-button').show();
                            }
                            $('<ul class="error" id="error-' + input[0].id + '"></ul>').insertBefore(input);
                            for(var i = 0; i < errors.length; i++){
                                $("#error-" + input[0].id).append('<li>' + errors[i] +'</li>');
                            }
                            unsetFileinput(input);
                        }else{
                            var imagePreview = $("#img-" + input[0].id);
                            imagePreview.attr('src', img.src).show();
                            imagePreview.parent().find('.img-download-button').html("Click to Download old Image").show();
                            if(input.attr("id") === "banner-image"){
                                input.closest('.col-sm-10').find('.alt-img-download-button').hide();
                            }else{
                                input.closest('.breakpoint-input').find('.alt-img-download-button').hide();
                            }
                        }
                    };
                }
            });

            /**
             * called if the uploaded image does'nt fit the criteria. Removes the uploaded image from the input.
             * @param input - the input whose value should be deleted
             */
            function unsetFileinput(input){
                input.wrap('<form>').closest('form').get(0).reset();
                input.unwrap();
                $("#img-" + input[0].id).attr('src', '#').hide();
            }

            /**
             * checks if the image fits the criteria
             * @param file - the uploaded file
             * @param img - the loaded image from the file
             * @param targetWidth - the specified width for that image
             * @param targetHeight - the specified height for that image
             * @param size - the specified size for that image
             * @return {Array} - String array that contains up to 3 errors
             */
            function checkImage(file, img, targetWidth, targetHeight, size){
                var error = [];
                if(file.size >= size){
                    error.push('Image size can not exceed ' + size/1000 + 'kb.');
                }
                if(img.width !== targetWidth){
                    error.push('<?= __('The width of this image must be') ?> ' + targetWidth + ' pixel.');
                }
                if(img.height !== targetHeight){
                    error.push('<?= __('The height of this image must be') ?> ' + targetHeight + ' pixel.');
                }
                return error;
            }

            /**
             * creates a new link, that downloads the resource
             * @param blob
             * @param filename
             */
            function forceDownload(blob, filename){
                var a = document.createElement('a');
                a.download = filename;
                a.href = blob;
                a.click();
            }

            /**
             * forces a cross origin download, that has a access-control-allow-origin http header that matches the page origin.
             * @param url
             * @param filename
             */
            function downloadResource(url, filename){
                if(!filename){
                    filename = url.split('\\').pop().split("/").pop();
                }
                fetch(url, {
                     headers: new Headers({
                         'Origin': location.origin
                     }),
                    mode: 'cors'
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        let blobUrl = window.URL.createObjectURL(blob);
                        forceDownload(blobUrl, filename);
                    })
                    .catch(e => console.error(e));
            }

            $('.floating-download-button, .img-download-button, .alt-img-download-button').click(function (e) {
                e.preventDefault();
                downloadResource($(this).attr('href'), $(this).attr('data-filename'));
            })
        });
    </script>
<?php $this->end() ?>
