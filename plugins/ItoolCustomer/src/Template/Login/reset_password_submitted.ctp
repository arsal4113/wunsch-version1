<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]) ?>

<div class="container" id="forgot-password">
    <?= $this->Html->link("", ['plugin' => 'Feeder', 'controller' => 'Homepage', 'action' => 'index'], ['class' => 'close-button']); ?>
    <div class="row reset-form">
        <div class="col-12">
            <div class="grey-box">
                <div class="row form-forgot-password-box">
                    <div class="form-wrapper">
                        <p class="title"><?= __d('itool_customer', 'Thank you!') ?></p>
                        <p class="reset-info"><?= __d('itool_customer', 'You will revieve an email shortly') ?></p>
                        <p class="reset-info e-mail"><?= __d('itool_customer', 'Email was send to <span class="email">{0}</span>', $email) ?></p>
                        <div class="separator">
                            <button id="resend-password-email-button" class="redesign-button"><?= __('Resend email') ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function ()
    {
        $('#resend-password-email-button').on('click', function (e)
        {console.log("click!");
            $.ajax('/customer/reset-password/submitted', {
                'type': 'POST',
                'data': 'email=<?= $email ?>'
            });
        });
    });
</script>

<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
