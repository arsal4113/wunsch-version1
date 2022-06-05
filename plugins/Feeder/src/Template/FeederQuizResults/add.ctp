<?php

use Feeder\Model\Table\FeederQuizResultsTable;

?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('Add New Quiz Result') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active">
                <strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Quiz Results'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
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
                    <?= $this->Form->create($feederQuizResult, ['class' => 'form-horizontal style-form', 'id' => 'quiz-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('name')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('quiz_description')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('quiz_description', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('headline')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('headline', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('explanation')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('explanation', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('button_text')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('button_text', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('button_link')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('button_link', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('image')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('image_src', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
                            <div class="image-preview">
                                <?= $this->Html->image($feederQuizResult->image_src, ['id' => 'result-img']); ?>
                            </div>
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

        $('#image-src').change(function () {
            let file = this.files[0];
            let input = $(this);
            if(file.type.indexOf("image") !== -1){
                img = new Image();
                img.src = _URL.createObjectURL(file);
                img.onload = function () {
                    $("#result-img").attr('src', img.src).show();
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
