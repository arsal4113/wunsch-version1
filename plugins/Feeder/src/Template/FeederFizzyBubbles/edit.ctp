<?= $this->Html->css('Feeder.heroItemConf.css'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Fizzy Bubble') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Fizzy Bubbles'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $feederFizzyBubble->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $feederFizzyBubble->id)]
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
                    <?= $this->Form->create($feederFizzyBubble, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('url')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('url', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('title_text')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('title_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('title_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('title_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('title_background_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('title_background_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('title_opacity')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('title_opacity', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('subline_text')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('subline_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('subline_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('subline_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('subline_background_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('subline_background_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('subline_opacity')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('subline_opacity', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('image')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('image_src', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                            <?php
                            $imageName = explode('/', $feederFizzyBubble->image_src);
                            $imageName = end($imageName);
                            $imageSource = strpos($feederFizzyBubble->image_src, "http") === false ? '/img/' . $feederFizzyBubble->image_src : $feederFizzyBubble->image_src;
                            ?>
                            <div class="image-preview inline">
                                <?= $this->Html->image($feederFizzyBubble->image_src, ['id' => 'fizzy-img']); ?>
                                <a href="<?= $imageSource ?>" data-filename="<?= $imageName ?>" class="floating-download-button">Click to Download</a>
                            </div>
                            <p class="image-name"><?= $imageName ?></p>
                        </div>
                        <label class="col-sm-1 control-label"><?= $this->Form->label(__('img_alt_tag')); ?></label>
                        <div class="col-sm-5">
                            <?= $this->Form->input('img_alt_tag', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('active')); ?></label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                                <?= $this->Form->input('active', ['type' => 'checkbox', 'label' => false, 'class' => 'custom-checkbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('use_on')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('use_on', ['label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => ['BOTH' => __('Both'), 'HOMEPAGE' => __('Homepage'), 'BROWSE' => __('Catch Category - Template B')]]) ?>
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

        let _URL = window.URL || window.webkitURL,
            imagePreview = $('.image-preview'),
            downloadButton = $('.floating-download-button');

        $(window).resize(function () {
            setFontSize();
        });

        /**
         * set the font size of the on image download button depending on the image width
         */
        function setFontSize(){
            if(imagePreview.width() > imagePreview.height()){
                downloadButton.css('font-size', imagePreview.width() / 17);
            }else{
                downloadButton.css('font-size', imagePreview.width() / 10);
            }
        }
        setFontSize();


        $('#image-src').change(function () {
            let file = this.files[0];
            let input = $(this);
            if(file.type.indexOf("image") !== -1){
                img = new Image();
                img.src = _URL.createObjectURL(file);
                img.onload = function () {
                    $("#fizzy-img").attr('src', img.src).show();
                    input.closest('.col-sm-10').find(".image-name").html(file.name);
                    input.closest('.col-sm-10').find("a").html("Download (old)");
                    setFontSize();
                };
                $(this).next('.alert').remove();
                if (file.size > 150 * 1024) {
                    $(this).after('<div class="alert alert-danger"><?= __('Hinweis: Upload größer als 150 kb!')?></div>');
                }
            }else{
                unsetFileinput(input);
            }
        });

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
                    if(blob.type.includes("image")){
                        let blobUrl = _URL.createObjectURL(blob);
                        forceDownload(blobUrl, filename);
                    }else{
                        console.log("Some error occurred");
                        console.log(blob);
                    }
                })
                .catch(e => console.error(e));
        }

        downloadButton.click(function (e) {
            e.preventDefault();
            downloadResource($(this).attr('href'), $(this).attr('data-filename'));
        });

        /**
         * called if the uploaded image doesn't fit the criteria. Removes the uploaded image from the input.
         * @param input - the input whose value should be deleted
         */
        function unsetFileinput(input){
            input.wrap('<form>').closest('form').get(0).reset();
            input.unwrap();
            $("#img-" + input[0].id).attr('src', '#').hide();
        }
    });
</script>
<?php $this->end() ?>
