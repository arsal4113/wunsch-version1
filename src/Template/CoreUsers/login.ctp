<div class="container login">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="welcome">
                <h2><?= __('Login')?></h2>
                <p>Please log in</p>
            </div>
            <?= $this->Form->create(null, ['role' => 'form']) ?>
                <div class="form-group">
                    <?= $this->Form->input('email', ['label' => false, 'value' => $email, 'class' => 'form-control', 'placeholder' => __('Mail address'), 'autofocus', 'required']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->input('password', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Password'), 'required']) ?>
                </div>
                <?= $this->Form->button(__('LOGIN'), ['id' => 'login-button', 'class' => 'btn btn-danger block full-width m-b']); ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="forgot-password">
                        <?= $this->Html->link(__('Forgot your password?'), ['controller' => 'CoreUsers', 'action' => 'forgotPassword', 'plugin' => false, 'prefix' => false], ['escape' => false]) ?>
                    </div>
                </div>
            </div>

            <div id="profile-loading-message" hidden><?= __('Your i-Tool3 profile is being prepared..') ?></div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>