<footer>
    <div class="row" id="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-2 link-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <a href="<?= $this->Url->build([
                                    'controller' => 'Pages',
                                    'action' => 'display',
                                    'plugin' => 'Feeder',
                                    'about-us'
                                ]); ?>"><?= __('About us') ?></a>
                            </div>
                            <div class="col-12">
                                <a href="<?= $this->Url->build([
                                    'controller' => 'Helps',
                                    'action' => 'view',
                                    'plugin' => 'HelpDesk'
                                ]); ?>"><?= __('Help Desk') ?></a>
                            </div>
                            <div class="col-12">
                                <a href="<?= $this->Url->build([
                                    'controller' => 'Worlds',
                                    'action' => 'view',
                                    'plugin' => 'Feeder'
                                ]); ?>"><?= __('Magazin') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2 link-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?= $this->Html->link(__('AGB'),
                                    '/allgemeine-geschaftsbedingungen',
                                    ['target' => 'blank']) ?>
                            </div>
                            <div class="col-12">
                                <a href="<?= $this->Url->build([
                                    'controller' => 'Pages',
                                    'action' => 'display',
                                    'plugin' => 'Feeder',
                                    'datenschutz'
                                ]); ?>"><?= __('Privacy Policy'); ?></a>
                            </div>
                            <div class="col-12">
                                <?= $this->Html->link(__('Legal notice'), '/impressum') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 newsletter-container">
                    <?= $this->element('ItoolCustomer.newsletter', ['newsletterLabel' => 'footer']); ?>
                </div>
                <div class="col-12 col-lg-2 social-container">
                    <ul class="social-icons">
                        <li class="icons-item instagram-icon">
                            <?= $this->Html->link(__('Instagram'),
                                'https://www.instagram.com/catch_by_ebay/?hl=de', ['target' => 'blank']) ?>
                        </li>
                        <li class="icons-item facebook-icon">
                            <?= $this->Html->link(__('Facebook'), 'https://www.facebook.com/catchbyebay/',
                                ['target' => 'blank']) ?>
                        </li>
                        <li class="icons-item pinterest-icon">
                            <?= $this->Html->link(__('Pinterest'), 'https://www.pinterest.de/catch_by_ebay/pins',
                                ['target' => 'blank']) ?>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    Copyright © <?= date('Y') ?> Neleeco GmbH <?= __('All rights reserved') ?>.
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    (function ($) {
        /*$(document).ready(function () {
            var prevScrollpos = $(window).pageYOffset;
            $(window).scroll(function () {
                var currentScrollPos = window.pageYOffset;
                if ($(window).width() < 480) {
                    if (prevScrollpos > currentScrollPos) {
                        if ($('#cookies-layer').hasClass('show')) {
                            $('#footer.position-fixed').css('bottom', $('#cookies-layer').height());
                        } else {
                            $('#footer').css('bottom', '0');
                        }
                    } else {
                        //$('#footer').css('bottom', '-90px');
                        $('#footer').removeClass('shown');
                    }
                    prevScrollpos = currentScrollPos;
                }
            });
        });*/

        $('input.newsletter-email').on('change, keyup', function () {
            $('.newsletter-button').addClass('typing');
            if ($(this).val().length === 0) {
                $('.newsletter-button').removeClass('typing');
            }
        });

        // pandata GTM tracking helper on footer interactions
        var clicked_item = 'discover';
        $('#footer a').on('click', function (e) {
            clicked_item = $(this).text();
            push2dataLayer({
                'event': 'footerInteraction',
                'clickedItem': clicked_item
            });
        });
    })(jQuery);
</script>
