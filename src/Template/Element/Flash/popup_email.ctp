<div class="popup-shown">
    <div class="popup-message">
        <div class="message-box">
<!--            <p class="msg">--><?////= ($message) ?><!--Keine Bestätigungs-E-Mail erhalten?</p>-->
            <div class="msg <?= h($key) ?>"><span>Keine Bestätigungs-E-Mail erhalten?</span></div>
            <p class="text-email-repeat"><?= __('Hier kannst du sie erneut anfordern.') ?></p>
            <?= $this->Form->create() ?>
                <?= $this->Form->control('email', ['type' => 'email', 'placeholder' => 'E-mail', 'id' => 'confirmation-email']) ?>
                <?= $this->Form->button(__('Registrierungslink anfordern'), ['class' => 'redesign-button popup-email-button']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
