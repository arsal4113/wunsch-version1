<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <h2><?= __('List of Configurations') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
            <li class="active">
                <strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['pass'][0])) ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-plus"></i>' . ' ' . __('Add New Configuration'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>

<?php $iboxCnt = 0; ?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?= $this->Form->create(null, ['class' => 'form-horizontal style-form']); ?>

        <?php foreach ($configurations as $key => $secondLevel) { ?>

            <div class="ibox <?php if ($iboxCnt > 0) echo 'collapsed'; ?>">
                <a class="collapse-link">
                    <div class="ibox-title">
                        <h5><?= h($key) ?></h5>
                        <div class="ibox-tools">
                            <i class="fa fa-chevron-down"></i>
                        </div>
                    </div>
                </a>
                <div class="ibox-content">
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <?php foreach ($secondLevel as $key => $thirdLevel) {
                                if (!isset($thirdLevel['value'])) { ?>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse-<?= $key ?>"
                                                   aria-expanded="false" class="collapsed"><?= $key ?></a>
                                            </h5>
                                        </div>
                                        <div id="collapse-<?= $key ?>" class="panel-collapse collapse"
                                             aria-expanded="false"
                                             style="height: 0px;">
                                            <div class="panel-body">
                                                <?php foreach ($thirdLevel as $key => $value) { ?>
                                                    <div class="form-group" style="height: 34px;">
                                                        <label class="col-sm-4 control-label" style="text-align: left;">
                                                            <label
                                                                for="core-seller-id"><?= \Cake\Utility\Inflector::humanize(h($key)) ?></label>
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <?= $this->Form->input($value['id'], ['label' => false, 'value' => $value['value'], 'class' => 'form-control']) ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <div class="form-group" style="height: 34px;">
                                        <label class="col-sm-4 control-label" style="text-align: left;">
                                            <label
                                                for="core-seller-id"><?= \Cake\Utility\Inflector::humanize(h($key)) ?></label>
                                        </label>
                                        <div class="col-sm-8">
                                            <?= $this->Form->input($thirdLevel['id'], ['label' => false, 'value' => $thirdLevel['value'], 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php $iboxCnt++; ?>
        <?php } ?>

        <div class="col-sm-12" align="right">
            <?= $this->Form->submit(__('Save'), ['class' => 'btn btn-sm btn-primary margin-top-30']) ?>
        </div>

        <?php $this->Form->end() ?>
    </div>
</div>



