<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true, 'media' => 'all']); ?>

<?php

$handler = ($this->request->getParam('plugin') ?: '')
         . '-' . ($this->request->getParam('controller') ?: '')
         . '-' . ($this->request->getParam('action') ?: '');
$search = $this->request->getQuery('search', false);
$isCustomerLogged = (isset($authUser) && !empty($authUser));
$logoutRender = $this->Flash->render('logout-message');
$resetPasswordRender = $this->Flash->render('reset-password-message');

$wishlistUrl = $this->Url->build([
        "plugin" => "ItoolCustomer",
        "controller" => "Account",
        "action" => "wishlist"
]);

if (!empty($logoutRender)) : ?>
    <div class="col-12 orange-message rendered-message" id="orange-message-container">
        <?= __('You have successfully logged out!') ?>
    </div>
    <script>
        document.body.classList.add('orange-message-shown');
        $(function ()
        {
            setTimeout(function ()
            {
                $('#orange-message-container').remove();
                $('body, .logo-container').removeClass('orange-message-shown');
                $(window).trigger('resize');
            }, 4096);
        });
    </script>
<?php elseif (!empty($resetPasswordRender)) : ?>
    <div class="col-12 orange-message rendered-message reset-password-message" id="orange-message-container">
        <?= __('Your password has been successfully reset.') ?>
    </div>
    <script>
        document.body.classList.add('orange-message-shown');
    </script>
<?php else : ?>
    <?= $this->cell('Feeder.UspBar'); ?>
<?php endif; ?>

<div class="logo-container">
    <div class="col-12 header">
        <div class="left-wrapper">
            <span id="burger-switch"><span class="icon"></span><span class="homepage"></span><span class="active"></span><?= __('Burger menu open') ?></span>
            <div class="logo">
                <a href="/"><?= $this->Html->image($catchLogo,
                        ['alt' => __('CATCH'), 'id' => 'logo', 'fullBase' => true]) ?></a>
            </div>
        </div>
        <span class="guarantee-message"><?= __('Shop safely with eBay Guarantee') ?></span>
        <div class="magic">
            <span id="search-switch" <?= h($search) ? 'class="search-shown"' : '' ?>><span class="icon"></span><span class="icon-shown"></span><span class="homepage"></span><span class="active"></span> <?= __('Open search input') ?></span>
            <?php
            if ($handler != 'EbayCheckout-EbayCheckoutSessions-view') {
                echo '<span id="user-account"><span class="icon"></span><span class="homepage"></span><span class="active"></span>' . __('User Account') . '</span>';
            }
            ?>
            <?php $wishlistItemCountSpan = '<span class="wishlist-item-count item-count" data-count="0" style="display:none;"></span>'; ?>
            <?php if ($authUser->wishlist_items_count ?? null) : ?>
                <?php
                $wishlistItemCount = $authUser->wishlist_items_count;
                if ($authUser->wishlist_items_count > 99) {
                    $wishlistItemCount = '99+';
                }
                $wishlistItemCountSpan = '<span class="wishlist-item-count item-count" data-count="' . $authUser->wishlist_items_count . '">' . $wishlistItemCount . '</span>'
                ?>
            <?php endif; ?>
            <?php
            echo $this->Html->link('<span id="wishlist" data-redirect="' . $wishlistUrl . '" class="' . (!$isCustomerLogged ? 'user-not-logged' : '') . '"><span class="icon"></span><span class="homepage"></span><span class="active"></span>' . __('wishlist') . $wishlistItemCountSpan . '</span>',
                [
                    'controller' => 'Account',
                    'action' => 'wishlist',
                    'plugin' => 'ItoolCustomer',
                ], [
                    'escape' => false,
                    'onClick' => "return wishlistIconClick()"
                ]);
            ?>
            <?= $this->cell('EbayCheckout.MiniCart::icon'); ?>
            <script>
                function wishlistIconClick() {
                    if (typeof window.userLogedIn !== 'undefined' && window.userLogedIn) {
                        $('#wishlist').removeClass('user-not-logged');
                        return true;
                    }
                    return false;
                }
            </script>
        </div>
    <div class="search-wrapper <?= h($search) ? 'search-shown' : '' ?>">
        <form id="search-form" method="get" action="<?= $searchUrl ?? '/feeder/search' ?>">
            <div class="search row">
                <input id="searchfield" type="text" class="col-12 clearable" name="search"
                       placeholder="<?= __('Search product') ?>"
                       value="<?= h($search) ?>" autocomplete="off"/>
                <span id="close-searchfield" class="close-searchbar"><?= __('') ?></span>
            </div>
            <!--input type="submit"/-->
        </form>
        <div id="search-suggestions"></div>
    </div>
    <div id="login-box-container">
        <div class="info-box <?= (!$isCustomerLogged ? 'user-not-logged' : '')  ?>" id="login-box" >
            <?php if (!$isCustomerLogged) {  ?>
            <div class="login-wrapper <?= (!$isCustomerLogged ? 'user-not-logged' : '')  ?>">
                <div class="button login-button"><?= __('Login') ?></div>
                <div class="registration-link"><span><?= __d('itool_customer', 'New on catch?') ?></span><br>
                    <?= $this->Html->link(__d('itool_customer', 'Not registered?'), ['controller' => 'Registration', 'action' => 'create', 'plugin' => 'ItoolCustomer'], ['class' => 'col-12 not-registered no-padding', 'onclick' => 'loadRecaptcha()']) ?>
                </div>
            </div>
            <?php } ?>
            <ul id="account-navigation">
                <li class="settings <?= (!$isCustomerLogged ? 'user-not-logged' : '')  ?>">
                    <?= $this->Html->link(__d('itool_customer', 'Account edit'), [
                        'controller' => 'Account',
                        'action' => 'edit',
                        'plugin' => 'ItoolCustomer',
                    ], ['class' => 'user-account-edit']) ?>
                </li>
                <li class="orders <?= (!$isCustomerLogged ? 'user-not-logged' : '')  ?>">
                    <?= $this->Html->link(__d('itool_customer','Orders'), [
                        'controller' => 'Account',
                        'action' => 'orders',
                        'plugin' => 'ItoolCustomer'
                    ], ['class' => 'user-account-orders']) ?>
                </li>
                <li class="my-world <?= (!$isCustomerLogged ? 'user-not-logged' : '')  ?>"><?= $this->Html->link(__d('itool_customer','Interessen'), [
                        'controller' => 'Account',
                        'action' => 'interests',
                        'plugin' => 'ItoolCustomer',
                        'view'
                    ], ['class' => 'user-account-interests']) ?></li>
            </ul>
            <div class="logout-wrapper <?= ($isCustomerLogged ? 'user-logged' : '')  ?>">
                <span id="user-name"><?php if ($isCustomerLogged) { echo 'Nicht ' . $authUser->first_name . '? '; } ?></span>
            <?=
                $this->Html->link(__d('itool_customer', 'Log out'), [
                    'controller' => 'Login',
                    'action' => 'logout',
                    'plugin' => 'ItoolCustomer'
                ], ['class' => 'user-account-logout']) ?>
            </div>
        </div>
    </div>
    <?= $this->cell('EbayCheckout.MiniCart', ['authUser' => $authUser, 'feederHomepage' => $feederHomepage]) ?>
</div>

<?php if ($search) echo $this->cell('Feeder.MegaNavi') ?>

<?php if ($orangeTitle ?? false) : ?>
    <div class="col-12 orange-message"><?= __($orangeTitle) ?></div>
<?php endif ?>

<script>
    $(function () {
        catcher.searchSuggestionsUrl = '<?= $this->Url->build([
            'controller' => 'Browse',
            'action' => 'suggest',
            'plugin' => 'Feeder',
        ]); ?>';

        <?php if(isset($feederCategory)): ?>
            catcher.animatedHeader = '<?= $feederCategory->has_animated_header ?>';
        <?php endif; ?>

        catcher.loginSidebarNotLoggedInText = '<p class="additional-message"><span class="burger-menu-icon wishlist"></span><span  class="wishlist-message"><?= __d('itool_customer',
            'Please sign in or register to save your Catch in your wishlist.') ?></span></p>';
    });
</script>
