<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Guide') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Guides'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $feederGuide->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $feederGuide->id)]
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
                    <?= $this->Form->create($feederGuide, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('url')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('url', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('meta_title')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('meta_title', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('meta_description')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('meta_description', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('robots_tag')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('robots_tag', [
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
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('title')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('title', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('description')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('description', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('first_background_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('first_background_image',
                                ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="image-preview">
                            <?= $this->Html->image($feederGuide->first_background_image, ['id' => 'first-background-image-display']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('second_background_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('second_background_image',
                                ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="image-preview">
                            <?= $this->Html->image($feederGuide->second_background_image, ['id' => 'second-background-image-display']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('display_animation')); ?></label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                                <?= $this->Form->input('display_animation', ['type' => 'checkbox', 'label' => false, 'class' => 'custom-checkbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('animation_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('animation_image',
                                ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="image-preview">
                            <?= $this->Html->image($feederGuide->animation_image, ['id' => 'animation-img-display']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('background_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('background_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('use_in_navigation')); ?></label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                                <?= $this->Form->input('use_in_navigation', ['type' => 'checkbox', 'label' => false, 'class' => 'custom-checkbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('navigation_name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('navigation_name', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('sort_order')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('sort_order', ['label' => false, 'class' => 'form-control', 'min' => 0]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('feeder_categories._ids')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('feeder_categories._ids', ['options' => $feederCategories, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('feeder_pillar_pages._ids')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('feeder_pillar_pages._ids', ['options' => $feederPillarPages, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('optional_urls')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('optional_urls', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('optional_url_headers')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('optional_url_headers', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('optional_url_image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('optional_url_image',
                                ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="image-preview">
                            <?= $this->Html->image($feederGuide->optional_url_image, ['id' => 'optional-url-img-display']); ?>
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

        let _URL = window.URL || window.webkitURL;
        $('#animation-image, #first-background-image, #second-background-image').change(function () {
            let file = this.files[0];
            let input = $(this);
            if(file.type.indexOf("image") !== -1){
                img = new Image();
                img.src = _URL.createObjectURL(file);
                img.onload = function () {
                    $("#" + input[0].id + "-display").attr('src', img.src).show();
                };
            }else{
                unsetFileinput(input);
            }
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
