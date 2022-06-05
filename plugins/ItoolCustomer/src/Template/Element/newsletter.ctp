<?php
$newsletterContainerId = 'newsletter-' . uniqid();
$buttonText = $buttonText ?? __('Subscribe to Newsletter');
?>

<div id="<?= $newsletterContainerId ?>" class="row newsletter-wrapper">
    <div class="container">
        <div class="newsletter-form">
            <?= $this->Form->create(null, ['role' => 'form']) ?>
            <?= $this->Form->control('email', [
                'type' => 'email',
                'placeholder' => __('E-mail'),
                'class' => 'newsletter-email',
                'id' => $newsletterContainerId . '-email'
            ]) ?>
            <span class="email-error validation-error"><?= __('Enter a valid email address.') ?></span>
            <span class="email-error subscription-error"><?= __('This E-mail is already in use.') ?></span>
            <div class="separator">
                <?= $this->Form->button($buttonText, ['class' => 'redesign-button newsletter-button', 'id' => $newsletterContainerId . '-button']) ?>
            </div>
            <?= $this->Form->end() ?>
            <div class="newsletter-text">
                <p><?= __('You can unsubscribe news letter at any time through your account settings or a links in emails.') ?></p>
            </div>
        </div>
        <!-- else -->
        <div class="subscribed-newsletter" style="display:none">
            <p>
                <?= __d('itool_customer',
                    'Yay, nur noch ein Schritt und du bist immer up to date! Check deinen Posteingang und bestätige die Anmeldung zum Newsletter.') ?>
            </p>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#<?= $newsletterContainerId?>-button').click(
            function (e) {
                e.preventDefault();
                var email = $('#<?= $newsletterContainerId?>-email').val();
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (re.test(email)) {
                    $('.newsletter-wrapper .email-error').hide();
                    $.ajax(
                        {
                            url: '<?= \Cake\Routing\Router::url([
                                'controller' => 'Newsletter',
                                'action' => 'subscribe',
                                'plugin' => 'ItoolCustomer'
                            ]) ?>',
                            method: 'POST',
                            data: {
                                email: email,
                                source: '<?= $newsletterLabel ?>'
                            },
                            success: function (data) {
                                try {
                                    if (data.response.isSubscribed) {
                                        $('.email-error.subscription-error').slideDown(256);
                                    } else {
                                        if (data.response.success) {
                                            $('#<?= $newsletterContainerId ?> .newsletter-form').hide();
                                            $('#<?= $newsletterContainerId ?> .subscribed-newsletter').show();
                                            push2dataLayer({
                                                'event': 'newsletter',
                                                'newsletterAction': 'Requested',
                                                'newsletterLabel': '<?= $newsletterLabel ?>'
                                            });
                                        }
                                    }
                                } catch (e) {
                                    console.log(e);
                                }
                            }
                        }
                    );
                } else {
                    $('.email-error.validation-error').slideDown(256);
                }
            }
        );
    });
</script>
