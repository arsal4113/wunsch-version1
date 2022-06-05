<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]); ?>

<div class="container" id="forgot-password">
    <?= $this->Html->link("", ['plugin' => 'Feeder', 'controller' => 'Homepage', 'action' => 'index'], ['class' => 'close-button']); ?>
    <div class="row reset-form">
        <div class="col-12">
            <?= $this->Form->create($customer, ['id' => 'reset-form']) ?>
            <div class="grey-box">
                <div class="row form-forgot-password-box">
                    <div class="form-wrapper">
                        <p class="title"><?= __d('itool_customer', 'Change your password') ?></p>
                        <p class="col-12 reset-info"><?= __d('itool_customer', 'Hello! Enter a new password here to replace the old one. Safety first!') ?></p>
                        <div class="col-12"><?= $this->Form->control('password', ['placeholder' => __d('itool_customer', 'Password')]) ?></div>
                        <div class="col-12"><?= $this->Form->control('password_repeat', ['placeholder' => __d('itool_customer', 'Password repeat'), 'type' => 'password']) ?></div>
                        <div class="col-12"><?= $this->Form->button(__d('itool_customer', 'Change password'), ['class' => 'redesign-button']) ?></div>
                    </div>
                </div>
            </div>
            <?= $this->Form->end() ?>
            <?= $this->Html->link( __('Back to sign in'), ['plugin' => 'ItoolCustomer', 'controller' => 'Login', 'action' => 'login'], ['class' => 'back-link']) ?>
        </div>
    </div>
</div>

<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
