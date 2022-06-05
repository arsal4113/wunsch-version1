<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= __('Edit User') ?></h2>
        <ol class="breadcrumb">
            <li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
            <li class="active">
                <strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <?= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of Users'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
                </div>
                <div class="btn-group">
                    <?=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $coreUser->id],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $coreUser->id)]
                    )
                    ?>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('Sellers') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of sellers'), ['controller' => 'CoreSellers', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add new seller'), ['controller' => 'CoreSellers', 'action' => 'add']) ?></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" type="button">
                        <?= __('User Roles') ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?= $this->Html->link(__('List of user roles'), ['controller' => 'CoreUserRoles', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link(__('Add new user role'), ['controller' => 'CoreUserRoles', 'action' => 'add']) ?></li>
                    </ul>
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
                    <?= $this->Form->create($coreUser, ['class' => 'form-horizontal style-form']); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label('Seller'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('core_seller_id', ['options' => $coreSellers, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label('email'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('email', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label('password'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('cpassword', ['type' => 'password', 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label(__('Password confirmation')); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('rpassword', ['type' => 'password', 'value' => '', 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label('Status'); ?></label>
                        <div class="col-sm-10">
                            <div class="i-checks">
                                <?= $this->Form->input('is_active', ['label' => false]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label('User Roles'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('core_user_roles._ids', ['options' => $coreUserRoles, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= $this->Form->label('redirect_url'); ?></label>
                        <div class="col-sm-10">
                            <?= $this->Form->input('redirect_url', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= $this->Html->link(__('Cancel'), ['controller' => 'CoreUsers', 'action' => 'index'], ['class' => 'btn btn-sm btn-danger']) ?>
                            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

