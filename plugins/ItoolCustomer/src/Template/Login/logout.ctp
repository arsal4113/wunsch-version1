<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]); ?>
<div class="customers form">
    <?= $this->Flash->render('auth') ?>
    <?= __('Bye!'); ?>
</div>
<?php if (!$isAjax ?? false) : ?>
    <script>
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});
    </script>
<?php endif; ?>
