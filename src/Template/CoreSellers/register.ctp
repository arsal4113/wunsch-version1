<h3 class="margin-bottom-20 text-center white"><?= __('Please sign up') ?></h3>
<?php

//Unlock for Security Component
$this->Form->unlockField('g-recaptcha-response');
$this->Form->unlockField('botdetect_captcha');
$this->Form->unlockField('BDC_BackWorkaround_RegisterPageCaptcha');
$this->Form->unlockField('BDC_UserSpecifiedCaptchaId');
$this->Form->unlockField('BDC_VCID_RegisterPageCaptcha');

if ($userIsChinese) {
    // google is blocked in china, use botdetect captcha for chinese users
} else if ($currentLanguageCode === 'de') {
    echo "<script src='https://www.google.com/recaptcha/api.js?hl=de'></script>";
} else if ($currentLanguageCode === 'es') {
    echo "<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>";
} else if ($currentLanguageCode === 'it') {
    echo "<script src='https://www.google.com/recaptcha/api.js?hl=it'></script>";
} else if ($currentLanguageCode === 'fr') {
    echo "<script src='https://www.google.com/recaptcha/api.js?hl=fr'></script>";
} else {
    echo "<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>";
}
?>

<?= $this->Form->create($coreSeller, ['class' => 'm-t', 'role' => 'form']) ?>
<div class="form-group">
    <?= $this->Form->input('first_name', ['label' => false, 'class' => 'form-control', 'placeholder' => __('First name') . '*', 'autofocus', 'required']) ?>
</div>
<div class="form-group">
    <?= $this->Form->input('last_name', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Last name') . '*', 'required']) ?>
</div>
<div class="form-group">
    <?= $this->Form->input('email', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Email') . '*', 'required', 'error' => false]) ?>
</div>
<div class="form-group">
    <?= $this->Form->input('password', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Password') . '*', 'required']) ?>
</div>
<div class="form-group">
    <?= $this->Form->input('confirm_password', ['label' => false, 'class' => 'form-control', 'type' => 'password', 'placeholder' => __('Confirm password') . '*', 'required']) ?>
</div>
<?php

if ($useRegisterCaptcha) {
    if ($userIsChinese) { ?>
        <div class="form-group">
            <?= captcha_image_html(); ?>
        </div>
        <div class="form-group">
            <?= $this->Form->input('botdetect_captcha', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Retype the characters from the picture') . '*', 'maxlength' => '10', 'required']) ?>
        </div>
    <?php } else { ?>
        <div class="g-recaptcha" data-sitekey="<? echo $reCaptchaSiteKey; ?>"></div>
    <?php }
}?>

<?= $this->Form->button(__('Register'), ['id' => 'register-button', 'class' => 'btn btn-danger block full-width m-b']); ?>
<div class="login text-center">
    <?= $this->Html->link('<small>' . __('Already registered? Log in here.') . '</small>', ['controller' => 'CoreUsers', 'action' => 'login', 'plugin' => false, 'prefix' => false], ['escape' => false]) ?>
</div>
<?= $this->Form->end() ?>

<?php $this->start('script') ?>
<script>

    function showDropdown(element) {
        $(element).closest('.dropdown').find('.dropdown-content').toggleClass('show');
    }

    $(window).click(function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = $(".dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = $(dropdowns[i]);
                if(openDropdown.hasClass('show')) {
                    openDropdown.removeClass('show');
                }
            }
        }
    });

    $(document).ready(function () {

        $(document).ready(function() {
            $(".language-selector .dropdown-content .flag").click(function (evt) {
                evt.preventDefault();
                $.get('/core_sellers/setLanguage/' + $(this).data('languageCode'), function (data) {
                    location.reload();
                });
            });

        });
    });
</script>
<?php $this->end() ?>