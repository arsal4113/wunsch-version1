<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="container" id="main-login-page">
    <?= $this->element('ItoolCustomer.login', ['redirect', $redirect]) ?>
</div>
<?php if (!$isAjax ?? false) : ?>
<script>
    $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
</script>
<?php endif; ?>

