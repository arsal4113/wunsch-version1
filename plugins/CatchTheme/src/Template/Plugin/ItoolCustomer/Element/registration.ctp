<?php
$this->assign('title', 'Registrierung | Catch by eBay');
$this->assign('description', 'Registrierung  | CATCH by eBay ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler ► Jetzt entdecken');
?>

<?php $reCaptchaSiteKey = Cake\Core\Configure::read('google_recatpcha_settings.site_key', false) ?>

<div class="customer-registration">
    <?= $this->Html->link('', ['plugin' => 'ItoolCustomer', 'controller' => 'Login', 'action' => 'login'], ['class' => 'back-button']) ?>
    <div class="row">
        <div class="col-12">
            <div class="row customer-info-wrapper">
                <div class="col-12 customer-info">
                    <p class="title"><?= __('Registration')?></p>
                    <div class="look-at-this">
                        <p><?= __('Register now') ?></p>
                    </div>
                    <div class="col widget-title no-items-alert"><?= $this->Flash->render() ?></div>
                    <?= $this->Form->create($customer ?? null, ['url' => ['plugin' => 'ItoolCustomer', 'controller' => 'Registration', 'action' => 'create'], 'id' => 'registration-form']) ?>
                    <fieldset>
                        <?= $this->Form->radio('gender',
                            [['value' => 'M', 'text' => __('Male')],
                                ['value' => 'F', 'text' => __('Female')],
                                ['value' => 'D', 'text' => __('Divers')]
                            ]) ?>
                        <?= $this->Form->control('first_name',
                            [
                                'placeholder' => __('First name'),
                                'required' => 'required'
                            ]) ?>
                        <?= $this->Form->control('last_name',
                            [
                                'placeholder' => __('Last name'),
                                'required' => 'required'
                            ]) ?>
                        <?= $this->Form->control('email',
                            [
                                'placeholder' => __('Email'),
                                'required' => 'required',
                                'id' => 'register-email'
                            ]) ?>
                        <div id="registration-messages">
                            <?= $this->Flash->render() ?>
                        </div>
                        <?= $this->Form->control('password',
                            [
                                'placeholder' => __('Password'),
                                'required' => 'required',
                                'id' => 'register-password'
                            ]) ?>
                        <?= $this->Form->control('password_repeat',
                            [
                                'placeholder' => __('Repeat password'),
                                'required' => 'required',
                                'type' => 'password',
                                'templates' => [
                                    'inputContainer' => '<div class="input password_repeat required">{{content}}</div>'
                                ]
                            ]) ?>
                    </fieldset>
                    <div class="registration-submit-text">
                        <p><?= __('Wir senden dir regelmäßig E-Mails mit Angeboten zu unseren Dienstleistungen. Du kannst dieser Nutzung zu Werbezwecken jederzeit in deinem Konto oder über den Link in den E-Mails kostenlos widersprechen.') ?></p>
                    </div>
                    <?php if($reCaptchaSiteKey) : ?>
                    <div class="g-recaptcha" data-callback="userIsNotARobot" data-sitekey="<?php echo $reCaptchaSiteKey; ?>"></div>
                    <div class="captcha-error" style="display: none;"><?= __('Please solve the captcha.') ?></div>
                    <?php endif; ?>
                    <?= $this->Form->hidden('register_wishlist_item_id', ['id' => 'register-wishlist-item-id']); ?>
                    <div class="registration-ebay-text">
                        <p><?= __('Es gelten die <a target="_blank" href="/allgemeine-geschaftsbedingungen ">catch AGB</a>. Informationen zur Verarbeitung deiner Daten findest du in unserer <a target="_blank" href="/datenschutz">Datenschutzerklärung</a>.') ?></p>
                    </div>

                    <?php if (isset($redirectUrl)): ?>
                        <input type="hidden" name="redirect-url" value="<?= $redirectUrl ?>" />
                    <?php endif ?>

                    <?= $this->Form->button(__('Register'), ['class' => 'redesign-button', 'id' => 'register-button']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="registration-confirm">
    <div class="form-wrapper">
        <p class="title"><?= __('Registration')?></p>
        <p class="small-text"><?= __('Shortly you will receive a link with which you can confirm the creation of your account. Please click this link to complete the build.') ?></p>
        <p class="small-text"><?= __('E-mail was sent to <span class="email-placeholder"></span>.') ?></p>
        <p class="small-text"><?= __('If you did not receive an email, you can request it here again.') ?></p>
        <div class="separator">
            <button id="resend-mail-button" class="redesign-button"><?= __('Resend email') ?></button>
        </div>
    </div>
</div>

<script type="text/javascript">

    var userIsNotARobot = function() {
        document.getElementsByClassName('captcha-error')[0].style.display = 'none';
        pushEcommerce('registrationFlow2');
    };

    (function ($) {
        $(function () {

            // for gender input design
            $('input[type=radio]').after('<span class="checkmark"></span>');

            $('#registration-form').submit(function(event) {
                var recaptcha = $("#g-recaptcha-response").val();
                if (recaptcha === "") {
                    event.preventDefault();
                    $('.captcha-error').slideDown();
                }
            });
        });
    })(jQuery);

    $(function ()
    {
        var loader = $('.ping-pong-loader'),
            registration_error_message = $('.burger-container .burger-wrapper .row .container .burger-menu .burger-menu-content #registration-messages'),
            register_menu_content = $('.register-burger .burger-menu-content .customer-registration'),
            register_confirm = $('.register-burger .burger-menu-content #registration-confirm'),
            resend_mail_button = register_confirm.find('#resend-mail-button');

        // registration-form additional ajax functionality
        $('.burger-menu #register-button').on('click', function (e)
        {
            var registration_form = $(this).closest('#registration-form');
            if (!registration_form.is(':invalid')) {
                e.preventDefault();
                loader.fadeIn(255);
                $.ajax(registration_form.attr('action'), {
                    'type': "POST",
                    'data': registration_form.serialize(),
                    'success': function (data, textStatus, jqXHR)
                    {
                        if (data.response.success) {
                            register_menu_content.hide();
                            register_confirm.find('.email-placeholder').html(data.response.email);
                            register_confirm.show(); // add email and button functionality!
                            resend_mail_button.on('click', function (e)
                            {
                                $.ajax('/customer/registration/resend');
                            });
                            registration_error_message.html('');
                            google.registrationMethod = 'Form Fill'; // just to be sure of default value
                            pushEcommerce('registrationFlow3');
                        } else {
                            registration_error_message.html(data.response.message);
                        }
                        loader.fadeOut(255);
                    }
                });
            }
        });
    });

    function loadRecaptcha()
    {
        var url = "https://www.google.com/recaptcha/api.js?hl=de";
        $.getScript(url);
    }
</script>
