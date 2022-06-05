<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true]); ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4">
            <?= $this->cell('ItoolCustomer.AccountNavigation', [$frontUser, 'active' => 'wishlist']) ?>
        </div>
        <div class="col-12 col-md-8">

        </div>
    </div>
</div>
