<footer>
    <div class="row">
        <div class="col">
            <ul id="footer-links" class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a href="<?= $this->Url->build([
                        'controller' => 'Pages',
                        'action' => 'display',
                        'plugin' => 'Feeder',
                        'impressum-und-datenschutz'
                    ]); ?>" class="nav-link"><?= __('Impressum & Datenschutz'); ?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row legal">
        <div class="col">
            Copyright © 1995-<?= date('Y') ?> eBay Inc. All Rights Reserved. <a
                    href="https://pages.ebay.com/help/policies/user-agreement.html" target="_blank">User Agreement</a>,
            <a
                    href="https://pages.ebay.com/help/policies/privacy-policy.html" target="_blank">Privacy</a>, <a
                    href="https://pages.ebay.com/help/account/cookies-web-beacons.html" target="_blank">Cookies</a> and
            <a
                    href="https://cgi6.ebay.com/ws/eBayISAPI.dll?AdChoiceLandingPage&amp;partner=0" target="_blank"
                    id="gf-AdChoice">AdChoice</a>
        </div>
    </div>
</footer>
