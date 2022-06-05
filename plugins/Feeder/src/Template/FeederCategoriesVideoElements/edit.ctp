<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-5">
        <h2><?= __('Edit Feeder Categories Video Element') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Feeder Categories Video Elements'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $feederCategoriesVideoElement->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $feederCategoriesVideoElement->id)]
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
                    <?= $this->Form->create($feederCategoriesVideoElement, ['class' => 'form-horizontal style-form', 'type' => 'file']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('is_active')); ?></label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                            <?= $this->Form->input('is_active', ['label' => false, 'class' => 'custom-checkbox']) ?>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->input('removed_media', ['type' => 'hidden']) ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('video_mp4')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('video_mp4', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'accept' => 'video/mp4']) ?>
                        </div>
                        <div class="col-sm-1">
                            <?= $this->Html->link(__('Remove'), '', ['class' => 'btn btn-sm btn-primary',
                                'onclick' => 'document.getElementById("removed-media").value += "video_mp4,"; this.className += "disabled"; return false']) ?>
                        </div>
                        <div class="card-img-wrapper col-sm-4">
                            <?= ($file = $feederCategoriesVideoElement->video_mp4) ?
                                $this->Html->link(
                                    '<video class="lazyload" autoplay loop muted playsinline preload="">' .
                                    '<source src="' . $this->Url->image($file) . '" type="video/mp4">' .
                                    '</video>',
                                    $this->Url->image($file),
                                    ['download' => basename($file), 'escape' => false]) : '' ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('video_webm')); ?></label>
                        <div class="col-sm-4">
                            <?= $this->Form->input('video_webm', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'accept' => 'video/webm']) ?>
                        </div>
                        <div class="col-sm-1">
                            <?= $this->Html->link(__('Remove'), '', ['class' => 'btn btn-sm btn-primary',
                                'onclick' => 'document.getElementById("removed-media").value += "video_webm,"; this.className += "disabled"; return false']) ?>
                        </div>
                        <div class="card-img-wrapper col-sm-4">
                            <?= ($file = $feederCategoriesVideoElement->video_webm) ?
                                $this->Html->link(
                                    '<video class="lazyload" autoplay loop muted playsinline preload="">' .
                                    '<source src="' . $this->Url->image($file) . '" type="video/webm">' .
                                    '</video>',
                                    $this->Url->image($file),
                                    ['download' => basename($file), 'escape' => false]) : '' ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('background_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('background_color', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('headline')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('headline', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('headline_color')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('headline_color', ['label' => false, 'class' => 'form-control']) ?>
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
        });
    </script>
<?php $this->end() ?>
