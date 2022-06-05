<?php

$couponAmount = 10;
$couponCode = 'PENG10';

$newsletterSubscribeUrl = \Cake\Routing\Router::url([
    'controller' => 'Newsletter',
    'action' => 'subscribe',
    'plugin' => 'ItoolCustomer'
]);

?>

<div id="newsletter-popup">
    <div id="newsletter-popup-rocket"></div>
    <div id="newsletter-popup-text">
        <?= __('Stay up to date and catch up') ?>
        <span><?= __('{0}% discount', $couponAmount) ?></span>
    </div>
    <div id="newsletter-popup-form-wrapper">
        <?php
        echo $this->Form->create(null, ['id' => 'newsletter-popup-form', 'role' => 'form'])
           . $this->Form->control('newsletter-popup-form-input', [
                 'type' => 'email',
                 'placeholder' => __('E-mail')

             ])
           . '<span class="email-error">' . __('Enter a valid email address.') . '</span>'
           . '<span class="email-error-subscribed">' . __('This E-mail is already in use.') . '</span>'
           . $this->Form->button(__('Subscribe to Newsletter'), ['id' => 'newsletter-popup-form-submit', 'disabled' => 'disabled'])
           . $this->Form->end();
        ?>
    </div>
    <div id="newsletter-popup-code">
        <?= __('Already finished!') ?>
        <br />
        <?= __('Your one-time {0}%', $couponAmount) ?>
        <br />
        <?= __('Code is <span class="code">{0}</span>', $couponCode) ?>
        <br />
        <button><span class="initial"><?= __('Copy code') ?></span><span class="hidden">√ <?= __('Yay, your code has been copied!') ?></span></button>
    </div>
    <div id="newsletter-popup-close">
        <span><?= __('close') ?></span>
    </div>
    <div id="newsletter-popup-loader"><?= $this->Html->image('catch-loader.gif') ?></div>
</div>

<script>
    $(function ()
    {
        if (sessionStorage.getItem('newsletter_popup_closed')) return; // showing popup for each browser session..

        var newsletter_popup = $('#newsletter-popup'),
            newsletter_popup_text = $('#newsletter-popup-text'),
            newsletter_popup_form = $('#newsletter-popup-form'),
            newsletter_popup_form_input = $('#newsletter-popup-form-input'),
            newsletter_popup_form_error = $('#newsletter-popup-form-wrapper span.email-error'),
            newsletter_popup_form_error_subscribed = $('#newsletter-popup-form-wrapper span.email-error-subscribed'),
            newsletter_popup_form_submit = $('#newsletter-popup-form-submit'),
            newsletter_popup_code = $('#newsletter-popup-code'),
            newsletter_popup_code_copy = $('#newsletter-popup-code button'),
            newsletter_popup_close = $('#newsletter-popup-close');

        function trackNewsletter (action)
        {
            push2dataLayer({
                'event': (action == 'Offered') ? 'newsletterImpression' : 'newsletter',
                'newsletterAction': action ? action.trim() : 'Requested',
                'newsletterLabel': 'coupon'
            });
        }

        newsletter_popup.delay(2048).animate({
            right: 0
        }, 1536, 'easeOutBounce', function ()
        {
            trackNewsletter('Offered');
        });

        newsletter_popup_form.on('submit', function (e)
        {
            e.preventDefault();

            newsletter_popup.addClass('is-loading');

            $.ajax({
                url: '<?= $newsletterSubscribeUrl ?>',
                method: 'POST',
                data: {
                    email: newsletter_popup_form_input.val(),
                    source: 'popup'
                },
                success: function (data, textStatus, jqXHR)
                {
                    try {
                        if (data.response.success == true) {
                            if (data.response.isSubscribed == true) {
                                newsletter_popup_form_error_subscribed.addClass('shown');
                            } else {
                                newsletter_popup_text.hide();
                                newsletter_popup_form.parent().hide();
                                newsletter_popup_code.show();
                                trackNewsletter();
                                newsletter_popup_code_copy.on('click', function (e)
                                {
                                    newsletter_code_input = $("<input>");
                                    $('body').append(window.newsletter_code_input);
                                    newsletter_code_input.val(newsletter_popup_code.children('.code').text()).select();
                                    document.execCommand("copy");
                                    newsletter_code_input.remove();

                                    var initial_message = $(this).children('.initial');
                                    initial_message.animate({
                                        width: 0
                                    }, 128, function ()
                                    {
                                        $(this).siblings('.hidden').animate({
                                            width: '100%'
                                        }, 128);
                                    });
                                    trackNewsletter('Copied');
                                    $(this).off();
                                });
                                sessionStorage.setItem('newsletter_popup_closed', true);
                            }
                        }
                        else {
                            console.log(data.response);
                        }
                    } catch (e) {
                        console.log(e);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            }).always(function () {
                newsletter_popup.removeClass('is-loading');
            });
        });

        newsletter_popup_form_input.on('change keyup mouseup', function (e)
        {
            var val = $(this).val().trim();
            $(this).val(val);
            var check = (val.includes(".") && $(this).is(':valid'));

            if (check) {
                newsletter_popup_form_submit.prop('disabled', false);
                newsletter_popup_form_error.removeClass('shown');
                newsletter_popup_form_input.addClass('valid').removeClass('invalid');
            } else {
                newsletter_popup_form_submit.prop('disabled', true);
                newsletter_popup_form_error.addClass('shown');
                newsletter_popup_form_input.addClass('invalid').removeClass('valid');
            }

            return check;
        });

        newsletter_popup_close.on('click', function (e)
        {
            newsletter_popup.animate({
                right: -361
            }, 256, function ()
            {
                sessionStorage.setItem('newsletter_popup_closed', true);
                if (newsletter_popup_text.is(':visible')) {
                    trackNewsletter('Closed');
                }
            });
        });
    });
</script>
