<?= $this->Html->css('Feeder.interestsStyle.css'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Interest') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Interests'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $feederInterest->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $feederInterest->id)]
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
                    <?= $this->Form->create($feederInterest, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('image', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                            <div class="image-preview">
                                <?= $this->Html->image($feederInterest->image, ['id' => 'img-image']); ?>
                            </div>
                        </div>
                        <div class="col-sm-2 control-label"></div>
                        <div class="col-sm-10">
                            <a id="remove-image">Remove Image</a>
                            <div class="removed-checkbox-container">
                                <?= $this->Form->input('image-removed', ['type' => 'checkbox', 'label' => false, 'class' => 'form-control']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('sort_order')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('sort_order', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('feeder_interest_subcategories._ids')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('feeder_interest_subcategories._ids', ['options' => $feederInterestSubcategories, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('gender')) ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->select('gender_id', $customerGenders) ?>
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

        if($('#img-image').height() === 0){
            $('#remove-image').hide();
        }

        let _URL = window.URL || window.webkitURL;

        $('#image').change(function () {
            let file = this.files[0];
            let input = $(this);
            if(file.type.indexOf("image") !== -1){
                img = new Image();
                img.src = _URL.createObjectURL(file);
                img.onload = function () {
                    $("#img-" + input[0].id).attr('src', img.src).show();
                };
                $('#image-removed').prop('checked', false);
                $('#remove-image').show();
            }else{
                unsetFileinput(input);
            }
        });

        $('#remove-image').click(function () {
            $('#image').val("");
            $('#image-removed').prop('checked', true);
            $('#img-image, #remove-image').hide();
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

