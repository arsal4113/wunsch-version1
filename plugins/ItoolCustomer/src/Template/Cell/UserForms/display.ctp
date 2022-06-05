<div class="burger-menu">
    <div class="ping-pong-loader"></div>
    <section class="login-burger">
        <?php
        //if ($handler != 'ItoolCustomer-Login-login') {
            ?>
            <div class="burger-menu-content">
                <?= $this->element('ItoolCustomer.login', ['socialLogins' => $socialLogins ?? null]) ?>
                <div class="burger-login"></div>
            </div>
            <?php
        //}
        ?>
    </section>
    <section class="register-burger">
        <?php
        if ($handler != 'ItoolCustomer-Registration-create') {
            ?>
            <div class="burger-menu-header active">
                <a id="user-account-register"><?= __('Registration') ?></a>
            </div>
            <div class="burger-menu-content">
                <?= $this->element('ItoolCustomer.registration', ['socialLogins' => $socialLogins ?? null]) ?>
            </div>
            <?php
        }
        ?>
    </section>
    <section class="password-burger">
        <?php
        if ($handler != 'ItoolCustomer-Login-resetPassword') {
            ?>
            <div class="burger-menu-content">
                <?= $this->element('ItoolCustomer.forgot_password') ?>
            </div>
            <?php
        }
        ?>
    </section>
</div>

<script type="text/javascript">
    $(function ()
    {
        <?php
        if ($handler != 'ItoolCustomer-Login-login') {
            ?>
            $('.password-forgotten').on('click', function (e) {
                e.preventDefault();
                $('#burger-content').hide();
                $('section.login-burger').hide();
                $('section.password-burger').show();
            });
            <?php
        }
        ?>

        <?php
        if ($handler == 'ItoolCustomer-Login-login') {
            ?>
            $('.burger-menu .register-burger').show();
            <?php
        }
        ?>
    });
    $('.redesign-button').on('touch click', function() {
        $('.redesign-button').addClass('clicked');
        setTimeout(function () {
            $('.redesign-button').removeClass('clicked');
        }, 3000);

    });
</script>
