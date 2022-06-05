<?php if ($coreSellers) : ?>
    <?php echo $this->Form->create(null, [
        'url' => ['controller' => 'CoreUsers', 'action' => 'setSuperSellerId', 'plugin' => false]]); ?>
    <?php echo $this->Form->input('super_seller_id', [
        'label' => false,
        'class' => 'form-control',
        'options' => [null => __('Select seller...')] + $coreSellers->toArray(),
        'onchange' => "this.form.submit()",
        'value' => $this->request->session()->read('Auth.User.super_user_core_seller_id')
    ]); ?>
    <?php echo $this->Form->end(); ?>
<?php endif; ?>