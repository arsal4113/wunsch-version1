<?= $this->Html->css('Feeder.heroItemConf.css'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Feeder Hero Item') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Hero Items'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $feederHeroItem->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $feederHeroItem->id)]
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
                            <?php
                            $imageName = explode('/', $feederHeroItem->image);
                            $imageName = end($imageName); ?>
                            <div class="image-preview inline">
                                <?= $this->Html->image($feederHeroItem->image, ['id' => 'image-preview']); ?>
                                <a href="<?= $feederHeroItem->image ?>" data-filename="<?= $imageName ?>" class="floating-download-button">Click to Download</a>
                            </div>
                            <p class="image-name"><?= $imageName ?></p>
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
                radioClass: 'iradio_square-green'
            });

            var _URL = window.URL || window.webkitURL;
            var imagePreview = $('#image-preview');

            $(window).resize(function () {
                setFontSize();
            });

            /**
             * set the font size of the on image download button depending on the image width
             */
            function setFontSize(){
                if(imagePreview.width() > imagePreview.height()){
                    $('.floating-download-button').css('font-size', imagePreview.width() / 17);
                }else{
                    $('.floating-download-button').css('font-size', imagePreview.width() / 10);
                }
            }
            setFontSize();

            /**
             * load the uploaded img and display it, show download button
             */
            $('#image').change(function () {
                var file = this.files[0];
                var input = $(this);
                img = new Image();
                img.src = _URL.createObjectURL(file);
                img.onload = function () {
                    $("#image-preview").attr('src', img.src);
                    input.closest('.col-sm-10').find(".image-name").html(file.name);
                    input.closest('.col-sm-10').find("a").html("Download (old)");
                    setFontSize();
                };
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
                        let blobUrl = window.URL.createObjectURL(blob);
                        forceDownload(blobUrl, filename);
                    })
                    .catch(e => console.error(e));
            }

            $('.floating-download-button').click(function (e) {
                e.preventDefault();
                downloadResource($(this).attr('href'), $(this).attr('data-filename'));
            })
        });
    </script>
<?php $this->end() ?>
