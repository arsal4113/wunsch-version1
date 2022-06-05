<h3 class="margin-bottom-20 forgot-password-text text-center white"><?= __('Reset your password') ?></h3>
<?= $this->Form->create(null, ['class' => 'm-t', 'role' => 'form']) ?>
<div class="form-group">
    <?= $this->Form->input('new_password', ['type' => 'password', 'label' => false, 'class' => 'form-control', 'placeholder' => __('Please enter your new password here...'), 'autofocus', 'required']) ?>
</div>
<div class="form-group">
    <?= $this->Form->input('confirm_password', ['type' => 'password', 'label' => false, 'class' => 'form-control', 'placeholder' => __('Please confirm your new password here...'), 'required']) ?>
</div>
<?= $this->Form->button('<i class="fa fa-paper-plane"></i> ' . __('Reset password'), ['id' => 'login-button', 'class' => 'btn btn-danger block full-width m-b']); ?>
<?= $this->Form->end() ?>