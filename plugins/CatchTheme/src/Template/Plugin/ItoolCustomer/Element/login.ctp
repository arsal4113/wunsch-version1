<?php
$loginAction = $this->Url->build([
    'controller' => 'Login',
    'action' => 'login',
    'plugin' => 'ItoolCustomer'
]);
$socialLoginURLs = array();
$link = $this->request->here;
?>
<div id="login-messages">
    <?= $this->Flash->render('login_messages') ?>
</div>
<p class="login-title"><?= __('Anmeldung') ?></p>
<div class="look-at-this">
    <p><?= __('Sign in now') ?></p>
</div>
<?= $this->Form->create(null, ['url' => ['plugin' => 'ItoolCustomer', 'controller' => 'Login', 'action' => 'login'], 'id' => 'login-form']) ?>
<div class="row form-login-box">
    <div class="form-login-wrapper">
        <?php if(isset($redirect)){
            echo $this->Form->control('redirect-url', ['value' => $redirect, 'type' => 'hidden']);
        }?>
        <?= $this->Form->control('email', ['type' => 'email', 'placeholder' => 'E-Mail', 'class' => 'login-email']) ?>
        <div class="email-error"><?= __('Please enter a valid email address.') ?></div>
        <?= $this->Form->control('password', ['type' => 'password', 'placeholder' => __d('itool_customer', 'Password')]) ?>
        <div class="form-login-text">
        <?= $this->Html->link(__d('itool_customer', 'Password forgotten?'), ['controller' => 'Login', 'action' => 'resetPassword', 'plugin' => 'ItoolCustomer'], ['class' => 'col-12 password-forgotten no-padding']) ?>
        </div>
        <?= $this->Form->button(__('Login'), ['id' => 'login-button', 'class' => 'form-login-button redesign-button', 'formnovalidate' => true, ]) ?>
        <div class="col-12 registration-link"><span><?= __d('itool_customer', 'New on catch?') ?></span></div>
        <?= $this->Html->link(__d('itool_customer', 'Not registered?'), ['controller' => 'Registration', 'action' => 'create', 'plugin' => 'ItoolCustomer'], ['class' => 'col-12 not-registered no-padding', 'onclick' => 'loadRecaptcha()']) ?>
        <?php // echo $this->Html->link(__('ebay'), ['plugin' => 'Ebay', 'controller' => 'EbayAuthLandingPages', 'action' => 'login'], ['class' => 'login-ebay-button', 'escape' => false]) // ATM not accepted by eBay ?>
    </div>
</div>
<?= $this->Form->end() ?>
<div class="row social-login">
    <div class="col-12 separator">
        <span><?= __('or login with') ?></span>
    </div>
    <div class="social-icons">
        <?php
        if (!isset($socialLogins)) {
            $socialLogins = ['ebay' => null, 'facebook' => null, 'google' => null, /*'instagram' => null,*/ 'twitter' => null];
        }
        foreach ($socialLogins as $key => $redirectUrl) {
            if ($key == 'facebook') {
                $buttonWrapper = ['class' => 'icons-item facebook', 'block' => true, 'escape' => false, 'rel' => 'nofollow', 'data-type' => $key/*, 'target' => '_blank'*/]; // ist selbstverständlich, oder?
            } else if ($key == 'ebay') {
                $buttonWrapper = ['class' => 'icons-item ebay', 'block' => true, 'escape' => false, 'rel' => 'nofollow', 'data-type' => $key];
            } else {
                $buttonWrapper = ['class' => 'icons-item', 'block' => true, 'escape' => false, 'rel' => 'nofollow', 'data-type' => $key, 'target' => '_blank'];
            }
            if ($key == 'facebook') { // ahiahiahiahiahi..
                $redirectUrl = $this->request->getSession()->read('SocialAuth.redirectUrl');
                if (!$oauth2_state = $this->request->session()->read('oauth2_state')) {
                    //$oauth2_state = $this->request->session()->write('oauth2_state', bin2hex(random_bytes(\SocialConnect\OAuth2\AbstractProvider::STATE_BYTES)));//var_dump($_SESSION);
                }
                ?>
                <script>
                    $(function () // https://developers.facebook.com/docs/facebook-login/web
                    {//return; // MAIN-SWITCH, uncomment to disable fb-login by frame
                        $.ajaxSetup({cache:true});
                        $.getScript('https://connect.facebook.net/en_US/sdk.js', function ()
                        {
                            FB.init({
                                appId: '333046720764660',
                                version: 'v2.8'
                            });
                            //$('#loginbutton, #feedbutton').removeAttr('disabled');
                            FB.getLoginStatus(function (response) { // will stop working on http, see https://developers.facebook.com/blog/post/2018/06/08/enforce-https-facebook-login/
                                //console.log(response);
                                if (response.status !== 'connected') {
                                    $('.social-icons .icons-item[data-type=facebook]').on('click', function (e) {
                                        e.preventDefault();
                                        FB.login(function (response)
                                        {
                                            if (response.status === 'connected') {
                                                document.location.href = $('button[class*="facebook"]').parent().attr('href');
                                            }
                                        }, {
                                            scope: 'email'
                                        });
                                    });
                                } else {
                                    $('.social-icons .icons-item[data-type=facebook]').on('click', function (e)
                                    { // even if logging-out from FB is no more possible..
                                        e.preventDefault();
                                        document.location.href = $('button[class*="facebook"]').parent().attr('href');
                                    });
                                }
                            });
                        });
                    });
                </script>
                <?php
            }
            if ($key == 'ebay') {
                echo $this->Html->link('<button class="' . $key . '-icon"></button>', [
                    'prefix' => false,
                    'plugin' => 'Ebay', 'controller' => 'EbayAuthLandingPages', 'action' => 'login',
                    //'provider' => $key,
                    '?' => ['redirect' => $redirectUrl],
                ],
                $buttonWrapper);
                $socialLoginURLs[$key] = $this->Url->build([
                    'prefix' => false,
                    'plugin' => 'Ebay',
                    'controller' => 'EbayAuthLandingPages',
                    'action' => 'login',
                    '?' => ['redirect' => $link . '#social']]);
            } else {
                echo $this->Html->link('<button class="' . $key . '-icon"></button>', [
                    'prefix' => false,
                    'plugin' => 'ADmad/SocialAuth', 'controller' => 'Auth', 'action' => 'login',
                    'provider' => $key,
                    '?' => ['redirect' => $redirectUrl],
                ],
                $buttonWrapper);
                $socialLoginURLs[$key] = $this->Url->build([
                    'prefix' => false,
                    'plugin' => 'ADmad/SocialAuth',
                    'controller' => 'Auth',
                    'action' => 'login',
                    'provider' => $key,
                    '?' => ['redirect' => $link . '#social']]);
            }
        }
        ?>
    </div>
</div>

<script>
    window.socialLoginURLs = <?= json_encode($socialLoginURLs) ?>;
    window.loginAction = <?= json_encode($loginAction) ?>;
    window.socialLogin = window.location.hash.substring(1) === 'social';
    $(function ()
    {
        var login_error_message = $('.burger-container .burger-wrapper .row .container .burger-menu .burger-menu-content #login-messages'),
            email_input = $('.form-login-box .form-login-wrapper #email'),
            email_error = $('.form-login-box .email-error'),
            loader = $('.ping-pong-loader'),
            password_reset = $('.password-forgotten'),
            registration = $('.not-registered');

        if (login_error_message.text().trim()) {
            var check = setInterval(function ()
            {
                if ($('#user-account').length) {
                    $('#user-account').trigger('click');
                    clearInterval(check);
                }
            }, 100);
        }

        email_input.on('keyup change', function () {
            if ($(this).is(':invalid')) {
                email_error.show();
                $('#login-button').attr('disabled', "disabled");
            } else {
                email_error.hide();
                $('#login-button').removeAttr('disabled');
            }
        });

        password_reset.on('click', function () {
            $('.newsletter-wrapper').hide();
            $('.additional-message').hide();
            $('#back-to-login').show();
        });
        registration.on('click', function () {
        	//e.preventDefault();
            $('#burger-content').hide();
            $('#user-close').show();
            $('.newsletter-wrapper').hide();
            $('.additional-message').hide();
            $('#back-to-login').show();
        });

        $('.social-icons .icons-item').on('click', function () {
            window.localStorage.setItem('pandata_login_type', $(this).data('type'));
            pushEcommerce('registrationFlow2/3');
        });

        // login-form additional ajax functionality
        $('.burger-menu #login-button').on('click', function (e)
        {
            e.preventDefault();
            var login_form = $(this).closest('#login-form');
            loader.fadeIn(255);
            $.ajax(login_form.attr('action'), {
                'type': 'POST',
                'data': login_form.serialize(),
                'success': function (data)
                {
                    if (data.response.success) {
                        let loginCallback = window.userLoginCallback;
                        catcher.hideMenu();
                        var forms_container = $('#user-content .burger-wrapper .row .container .burger-menu');
                        window.localStorage.setItem('pandata_login_type', 'account'); // reset to default, ATM superfluous but active (more reliability)
                        window.localStorage.setItem('pandata_login_userid', data.response.user_id);
                        catcher.userName = data.response.user_name;
                        catcher.redirectAfterLogin = data.response.redirectAfterLogin;
                        console.log('catcher.userName = ' + catcher.userName);
                        pushEcommerce('login', null);
                        $('.menu-account > .container').removeClass('user-not-logged');
                        $('#login-box .login-wrapper').removeClass('user-not-logged');
                        $('#login-box').removeClass('user-not-logged');
                        $('#login-box #account-navigation li').removeClass('user-not-logged');
                        $('#login-box .logout-wrapper').addClass('user-logged');
                        if (catcher.userName !== '') {
                            $('#login-box .logout-wrapper #user-name').append('Nicht ' + catcher.userName + '?');
                        }
                        $('.additional-message').hide();
                        window.userLogedIn = true;
                        $.ajax({
                            'url': '/customer/navigation',
                            'success': function (data) {
                                if (catcher.redirectAfterLogin !== null) {
                                    window.location.href = catcher.redirectAfterLogin;
                                }
                                forms_container.parent().addClass('user-logged-in account-navigation');
                                $('#user-content').hide();
                                if(catcher.redirectAfterLogin && !catcher.redirectAfterLogin.includes("interests")){
                                    $('#login-box-container').show();
                                    $('#login-box-container').addClass('show');
                                    $('#login-box').show();
                                }
                                try {
                                    loginCallback();
                                } catch (e) {
                                    console.log(e);
                                }
                                loader.fadeOut(255);
                            }
                        });
                        try {
                            if(typeof data.response.wishlistItemCount !== 'undefined' && data.response.wishlistItemCount) {
                                var wishlistify = $.fn.wishlistify();
                                wishlistify.showItemCount(data.response.wishlistItemCount);
                            }
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        window.userLogedIn = false;
                        if (data.response.hasOwnProperty('email')) {
                            email_input.val(data.response.email);
                        }
                        login_error_message.html(data.response.message);
                        loader.fadeOut(255);
                    }
                }
            });
        });
    });
</script>
