<ul id="account-navbar" class="account-navbar logged-in-burger-menu">
    <li class="account-edit <?= $active == 'edit' ? 'active' : '' ?>">
        <?= $this->Html->link(__d('itool_customer', 'Account edit'), [
            'controller' => 'Account',
            'action' => 'edit',
            'plugin' => 'ItoolCustomer'
        ], ['class' => 'user-account-edit']) ?>
    </li>
    <li class="account-orders <?= $active == 'orders' ? 'active' : '' ?>">
        <?= $this->Html->link(__d('itool_customer','Orders'), [
            'controller' => 'Account',
            'action' => 'orders',
            'plugin' => 'ItoolCustomer'
        ], ['class' => 'user-account-orders']) ?></li>
    <li class="account-interests <?= $active == 'interests' ? 'active' : '' ?>">
        <?= $this->Html->link(__d('itool_customer','Interests'), [
            'controller' => 'Account',
            'action' => 'interests',
            'plugin' => 'ItoolCustomer'
        ], ['class' => 'user-account-interests']) ?>
    </li>
</ul>
