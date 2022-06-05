<?php
$this->assign('title', 'Anmelden | Catch by eBay');
$this->assign('description', 'Anmelden | CATCH by eBay ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler ► Jetzt entdecken');
?>

<div id="password-messages">
    <?= $this->Flash->render() ?>
</div>

<?= $this->Form->create(null, ['url' => ['plugin' => 'ItoolCustomer', 'controller' => 'Login', 'action' => 'resetPasswordSubmitted'], 'id' => 'password-form']) ?>

<div class="grey-box">
    <div class="row form-forgot-password-box">
        <div class="form-wrapper">
            <p class="title"><?= __d('itool_customer', 'Reset password')?></p>
            <p class="reset-info"><?= __d('itool_customer', 'Please enter your email address to receive a link to reset your password.') ?></p>
            <?= $this->Form->control('email', ['placeholder' => __d('itool_customer', 'Email'), 'class' => 'login-email']) ?>
            <div class="password-forgotten-email-error"><?= __('Please enter a valid email address.') ?></div>
            <div class="separator">
                <?= $this->Form->button(__d('itool_customer', 'Request new password'), ['id' => "password-button", 'class' => 'form-password-button redesign-button', 'formnovalidate' => true/*, 'disabled' => 'disabled'*/]) ?>
            </div>
        </div>
    </div>
</div>

<div class="separator">
    <a href="Javascript:;" id="back-to-login-link" class="grey-link"><?= __('back to login') ?></a>
</div>
<br />

<?= $this->Form->end() ?>

<div id="password-reset-confirm">
    <div class="form-wrapper">
        <p class="title"><?= __d('itool_customer', 'Reset password')?></p>
        <p class="small-text"><?= __('Shortly you will receive a link with which you can reset your password. Please click on it to change your password.') ?></p>
        <p class="small-text"><?= __('E-mail was sent to <span class="email-placeholder"></ span>.') ?></p>
        <p class="small-text"><?= __('If you did not receive an email, you can request it here again.') ?></p>
        <div class="separator">
            <button id="resend-password-mail-button" class="redesign-button"><?= __('Resend email') ?></button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function ()
    {
        var password_forgotten_email_input = $('.form-forgot-password-box .form-login-wrapper #email'),
            password_forgotten_email_error = $('.password-forgotten-email-error');

        password_forgotten_email_input.on('keyup change', function (e) {
            if (!$(this).val() ||$(this).is(':invalid')) {
                password_forgotten_email_error.show();
                $('#password-button').attr('disabled', "disabled");
            } else {
                password_forgotten_email_error.hide();
                $('#password-button').removeAttr('disabled');
            }
        });

        var loader = $('.ping-pong-loader'),
            password_error_message = $('.burger-container .burger-wrapper .row .container .burger-menu .burger-menu-content #password-messages'),
            password_menu_content = $('.password-burger #password-form'),
            password_confirm = $('.password-burger .burger-menu-content #password-reset-confirm'),
            resend_password_mail_button = password_confirm.find('#resend-password-mail-button');

        // password-reset additional ajax functionality
        $('.burger-menu #password-button').on('click', function (e)
        {
            var password_form = $(this).closest('#password-form');
            e.preventDefault();
            loader.fadeIn(255);
            $.ajax(password_form.attr('action'), {
                'type': "POST",
                'data': password_form.serialize(),
                'success': function (data, textStatus, jqXHR)
                {
                    if (data.response.success) {
                        password_menu_content.hide();
                        password_confirm.find('.email-placeholder').html(data.response.email);
                        password_confirm.show();
                        resend_password_mail_button.on('click', function (e)
                        {
                            $.ajax('/customer/reset-password/submitted', {
                                'type': 'POST',
                                'data': password_form.serialize()
                            });
                        });
                        password_error_message.html('');
                    } else {
                        password_error_message.html(data.response.message);
                    }
                    loader.fadeOut(255);
                }
            });
        });
    });
</script>
