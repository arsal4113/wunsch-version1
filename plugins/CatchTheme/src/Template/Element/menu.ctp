<?php
$isCustomerLogged = (isset($authUser) && !empty($authUser))
?>
<div class="burger-container" id="user-content">
    <div class="burger-wrapper">
        <div class="row menu-close">
            <div class="container">
                <span id="user-close" class="close-button"></span>
                <span id="back-to-login" class="close-button">
                    <?= __('zurück'); ?>
                </span>
            </div>
        </div>
        <div class="row menu-account">
            <div
                class="container <?php echo ($isCustomerLogged) ? 'user-logged-in' : 'user-not-logged' ?>">
                <div
                    class="<?php echo ($isCustomerLogged) ? 'user-logged-in account-navigation' : 'login-wrapper' ?>">
                    <?php
                    if ($isCustomerLogged) {
                        echo $this->cell('ItoolCustomer.AccountNavigation', [$authUser]);
                        ?>
                        <script type="text/javascript">
                            $('#resend-email-text').hide();
                        </script>
                        <?php
                    } else {
                        echo $this->cell('ItoolCustomer.UserForms',
                            ['socialLogins' => $socialLogins ?? null]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row menu-about <?php echo ($isCustomerLogged) ? 'show' : '' ?>">
            <div class="container">
                <p><?= __('All about us') ?></p>
                <ul class="about-links">
                    <li><a id="burger-about-us" href="<?= $this->Url->build([
                            'controller' => 'Pages',
                            'action' => 'display',
                            'plugin' => 'Feeder',
                            'about-us'
                        ]); ?>"><?= __('About us') ?></a></li>
                    <li><a id="user-account-wltn" href="<?= $this->Url->build([
                            'controller' => 'Worlds',
                            'action' => 'index',
                            'plugin' => 'Feeder'
                        ]); ?>"><?= __('Worlds') ?></a></li>
                    <li><a id="burger-help-contact" href="<?= $this->Url->build([
                            'controller' => 'Helps',
                            'action' => 'view',
                            'plugin' => 'HelpDesk'
                        ]); ?>"><?= __('Help & Contact') ?></a></li>
                    <li><a id="burger-legal-notice"
                           href="https://pages.ebay.de/help/policies/legal-imprint.html"
                           target="_blank"><?= __('Legal notice') ?></a></li>
                </ul>
            </div>
        </div>
        <!-- If newsletter submission false -->
        <?= $this->element('ItoolCustomer.newsletter', ['newsletterLabel' => 'modal']) ?>
    </div>
</div>

<div class="burger-container" id="burger-content">
    <div class="burger-wrapper">
        <div class="row menu-close">
            <div class="container">
                <span id="burger-close" class="close-button"></span>
            </div>
        </div>
        <div class="row menu-categories">
            <div class="col-12 category-navigation">
                <div class="container">
                    <!-- HARDCODE -->
                    <ul id="menu-navbar" class="burger-navbar burger-menu">
                        <li><?= $this->Html->link('Girls Fashion', '/girls-fashion'); ?></li>
                        <li><?= $this->Html->link('Boys Fashion', '/boys-fashion'); ?></li>
                        <li><?= $this->Html->link('Sport', '/sport'); ?></li>
                        <li><?= $this->Html->link('Beauty', '/beauty'); ?></li>
                        <li><?= $this->Html->link('Tech Gadgets', '/tech-gadgets'); ?></li>
                        <li><?= $this->Html->link('Home Sweet Home', '/home-sweet-home'); ?></li>
                        <li><?= $this->Html->link('Geschenke unter 10€', '/geschenke-unter-10'); ?></li>
                    </ul>
                    <!-- /HARDCODE -->
                </div>
            </div>
        </div>
        <div class="row menu-about show">
            <div class="container">
                <p><?= __('All about us') ?></p>
                <ul class="about-links">
                    <li><a id="burger-about-us" href="<?= $this->Url->build([
                            'controller' => 'Pages',
                            'action' => 'display',
                            'plugin' => 'Feeder',
                            'about-us'
                        ]); ?>"><?= __('About us') ?></a></li>
                    <li><a id="user-account-wltn" href="<?= $this->Url->build([
                            'controller' => 'Worlds',
                            'action' => 'index',
                            'plugin' => 'Feeder'
                        ]); ?>"><?= __('Worlds') ?></a></li>
                    <li><a id="burger-help-contact" href="<?= $this->Url->build([
                            'controller' => 'Helps',
                            'action' => 'view',
                            'plugin' => 'HelpDesk'
                        ]); ?>"><?= __('Help & Contact') ?></a></li>
                    <li><a id="burger-legal-notice"
                           href="https://pages.ebay.de/help/policies/legal-imprint.html"
                           target="_blank"><?= __('Legal notice') ?></a></li>
                </ul>
            </div>
        </div>
        <div class="row menu-social">
            <div class="container">
                <p><?= __('Follow us') ?></p>
                <ul class="social-icons">
                    <li class="icons-item facebook-icon">
                        <?= $this->Html->link(__('Facebook'), 'https://www.facebook.com/catchbyebay/',
                            ['target' => 'blank']) ?>
                    </li>
                    <li class="icons-item instagram-icon">
                        <?= $this->Html->link(__('Instagram'),
                            'https://www.instagram.com/catch_by_ebay/?hl=de', ['target' => 'blank']) ?>
                    </li>
                    <li class="icons-item pinterest-icon">
                        <?= $this->Html->link(__('Pinterest'), 'https://www.pinterest.de/catch_by_ebay/pins',
                            ['target' => 'blank']) ?>
                    </li>

                </ul>
                <?php if ($showNewsletterField) {
                    echo $this->element('ItoolCustomer.newsletter', ['newsletterLabel' => 'modal']);
                } ?>
            </div>
        </div>
    </div>
</div>

<div class="burger-container" id="mobile-navi">
    <div class="burger-wrapper">
        <div class="row menu-close">
            <div class="container">
                <span id="navi-close" class="close-button"></span>
            </div>
        </div>
        <?= $this->cell('Feeder.MegaNavi::moreCategories') ?>
    </div>
</div>
