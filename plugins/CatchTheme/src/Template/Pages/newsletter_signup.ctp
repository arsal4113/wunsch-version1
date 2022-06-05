<?php
$this->Html->css('Feeder.newsletter-signup' . STATIC_MIN, ['block' => true, 'media' => 'all']);
$this->assign('title', __('Newsletter Sign up'));
$this->assign('description', __('Catch Newsletter Sign up'));
?>

<?php $this->start('content-fluid') ?>
<?= $this->cell('Feeder.MegaNavi') ?>
<?php $this->end() ?>

<div class="newsletter-signup-content">
    <div class="text-wrapper">
        <p><?= __('Geschafft – deine Emailadresse wurde bestätigt. Ab jetzt bekommst du die neuesten Catchs per Email gesendet, damit du nichts mehr verpasst.') ?></p>
        <div class="image-wrapper"></div>
    </div>
    <div class="button-wrapper">
        <a href="/"><?= __('Zur Startseite') ?></a>
    </div>
</div>

<script>
	sessionStorage.setItem('newsletter_popup_closed', true);
</script>

<?php /*$this->end();*/ ?>
