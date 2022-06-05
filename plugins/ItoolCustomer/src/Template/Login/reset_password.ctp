<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]) ?>

<div class="container" id="forgot-password">
    <?= $this->Html->link( '', ['plugin' => 'ItoolCustomer', 'controller' => 'Login', 'action' => 'login'], ['class' => 'back-button']) ?>
    <div class="row reset-form">
        <div class="col-12">
            <?= $this->Element('ItoolCustomer.forgot_password') ?>
            <?= $this->Html->link( __('Back to sign in'), ['plugin' => 'ItoolCustomer', 'controller' => 'Login', 'action' => 'login'], ['class' => 'back-link']) ?>
        </div>
    </div>
</div>

<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
