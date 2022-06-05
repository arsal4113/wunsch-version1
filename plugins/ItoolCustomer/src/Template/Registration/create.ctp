<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div id="main-registration-page">
    <div class="customer-registration-form">
        <?= $this->element('ItoolCustomer.registration') ?>
    </div>
</div>
<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
