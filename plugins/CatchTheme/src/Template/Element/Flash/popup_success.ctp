<div class="popup-shown registration-popup">
    <div class="popup-message">
        <div class="popup-close"><button type="button" class="close popup-close-button"></button></div>
        <div class="message-box">
            <div class="msg"><span><?= __($message) ?></span></div>
            <p class="email-sent"><?= __('Wir haben dir soeben eine Bestätigungs-E-Mail zugesandt. Bitte klicke den enthaltenen Link an, um die Registrierung abzuschließen.') ?></p>
            <?= $this->Form->create(null,['url' => '/']) ?>
                <?= $this->Form->button(__('Zur Startseite'), ['class' => 'redesign-button popup-button']); ?>
            <?= $this->Form->end() ?>

            <?php
            if (!$params['is_active']) {
                ?>
                <p id="resend-email-text"><?= __('Keine E-Mail erhalten? Klicke ') ?><?= $this->Html->link(__('hier.'), [
                    'controller' => 'Registration',
                    'action' => 'resend',
                    'plugin' => 'ItoolCustomer'
                ]) ?></p>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.popup-message .popup-close button').on('click', function (e) {
        $('#messages .popup-shown').fadeOut(255);
    });
</script>
