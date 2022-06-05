<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]); ?>
<div class="container" id="change-password">
    <div class="row content-wrapper">
        <div class="col-12">
            <h1><?= __('Change your password') ?></h1>
            <div class="form-wrapper">
                <?= $this->Form->create($customer) ?>
                <div class="container form-container">
                    <fieldset>
                        <legend><?= __('Enter your new password.') ?></legend>
                        <?= $this->Form->control('old_password', ['type' => 'password', 'placeholder' => __('Enter your old password')]) ?>
                        <?= $this->Form->control('password', ['type' => 'password', 'value' => '', 'placeholder' => __('New Password')]) ?>
                        <?= $this->Form->control('password_repeat', ['type' => 'password', 'value' => '', 'placeholder' => __('Confirm New Password')]) ?>
                    </fieldset>
                    <?= $this->Form->button(__('Change Password')); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
