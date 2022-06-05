<?php $this->Html->css('Feeder.unsubscribed-message' . STATIC_MIN, ['block' => true, 'media' => 'all']); ?>

<?php
$this->assign('title', __(''));
$this->assign('description', __(''));
//$this->start('content-fluid'); ?>

<div class="row justify-content-center unsubscribed-message">
    <div class="col-10 col-md-8">
        <h2><?= __('Schade, dass du gehst...') ?></h2>
        <p><?= __('Es tut uns leid, dich als Newsletter-Abonnenten zu verabschieden!') ?></p>
        <p><?= __('Hiermit bestätigen wir dir, dass du dich erfolgreich von allen Marketing Emails zu aktuellen Kampagnen,  Aktionen und Angeboten von Catch abgemeldet hast.') ?></p>
        <p><?= __('Bitte habe noch etwas Geduld. Die finale Abmeldung kann bis zu 7 Tage in Anspruch nehmen. Falls du es dir anders überlegst, kannst du dich jederzeit wieder für unseren Newsletter registrieren. Wir freuen uns, wenn du mal wieder vorbeischaust!') ?></p>
        <p>
            <span><?= __('Wir werden dich vermissen!') ?></span>
            <br>
            <span><?= __('Dein Catch Team') ?></span>
        </p>
        <a href="/" class="redesign-button"><?= __('Zur Startseite') ?></a>
    </div>
</div>

<?php //$this->end(); ?>
<script>
    $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
</script>
