<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="yHJflN9l-wlnOkxeOfX6D_X-F69Dtrp79PC7gf5EH68"/>
    <?= $this->Html->meta('icon', '/catch_theme/fav.svg', ['type' => 'image/svg+xml']) ?>
    <?= $this->Html->meta('icon', '/catch_theme/favicon.ico', ['type' => 'image/x-icon']) ?>
    <title><?= __($this->fetch('title')) ?></title>

    <?php if (!empty($canonicalLink = $this->fetch('canonicalLink'))): ?>
        <?= $this->Html->meta(['link' => $canonicalLink, 'rel' => 'canonical']); ?>
    <?php endif; ?>
    <?= __($this->fetch('productMarkup')) ?>
    <?php
    if (isset($loadOptimizely) && !empty($loadOptimizely)) { // https://help.optimizely.com/Set_Up_Optimizely/Best_practices_for_site_performance_with_Optimizely
        echo '<script src="https://cdn.optimizely.com/js/' . \Cake\Core\Configure::read('Tracking.optimizely_project_id', 11114068981) . '.js"></script>';
    }
    ?>
    <!-- CSS -->
    <?= $this->Html->css('CatchTheme.styles' . STATIC_MIN, ['fullBase' => true, 'media' => 'all']); ?>
    <?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true, 'fullBase' => true, 'media' => 'all']); ?>
    <?= $this->fetch('css') ?>
    <!-- SCRIPTS -->
    <?= $this->Html->script('jquery-3.2.1.min') ?>
    <?= $this->Html->script('jquery-ui.min.js') ?>
    <?= $this->Html->script('datalayer' . STATIC_MIN); ?>
    <?php if (!STATIC_MIN) : ?>
        <?= $this->Html->script('jquery-3.2.1.min') ?>
        <?= $this->Html->script('jquery-ui.min.js') ?>
        <?= $this->Html->script('catcher'); ?>
        <?= $this->Html->script('header'); ?>
        <?= $this->Html->script('cookie') ?>
        <?= $this->Html->script('datalayer'); ?>
        <?= $this->Html->script('EbayCheckout.mini-cart') ?>
        <?= $this->Html->script('ItoolCustomer.wishlist') ?>
        <?= $this->Html->script('lazysizes.min') ?>
        <?= $this->Html->script('cookie') ?>
    <?php else:  ?>
        <?= $this->Html->script('CatchTheme.main.min', ['fullBase' => true]); ?>
    <?php endif; ?>
    <?php echo $this->fetch('script') ?>

    <!-- GA Remarketing Code -->
    <script type="text/javascript">
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    </script>

    <!-- Google Tag Manager -->
    <script type="text/javascript">
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MG9T7LM');
    </script>
    <!-- End Google Tag Manager -->

    <!-- webExtend -->
    <script>
        var ScarabQueue = ScarabQueue || [];
        (function(id) {
            if (document.getElementById(id)) return;
            var js = document.createElement('script'); js.id = id;
            js.src = '//cdn.scarabresearch.com/js/18F1C5DFE12291BD/scarab-v2.js';
            var fs = document.getElementsByTagName('script')[0];
            fs.parentNode.insertBefore(js, fs);
        })('scarab-js-api');
    </script>

    <!-- Hotjar Tracking Code for https://catch.app/ -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:1154627,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
</head>
<body class="error404">
<div class="container-fluid" id="header">
    <header class="row">
        <?= $this->element('header',
            [
                'upper' => $upper,
                'under' => $under,
                'homeUrl' => $homeUrl,
                'searchUrl' => $searchUrl,
                'childCategories' => $childCategories,
                'customerSegment' => $customerSegment,
                'selectedCategoryId' => $selectedCategoryId
            ]) ?>
        <div id="navigation-container" class=" container-fluid"><?= $this->fetch('category-navigation') ?></div>
    </header>
    <?= $this->fetch('category-filter') ?>
    <?= $this->fetch('page-control') ?>
</div>
<div class="container-fluid" id="error-content">
    <div class="row">
        <div class="container error-404">
            <div class="error-message">
                <div class="x-large"></div>
                <p>Sorry! Das war ein<br> Griff ins Klo :/</p>
                <p style="color: black;"><?= $upper ?></p>
            </div>
            <div class="image-wrapper">
                <a href="https://catch.app/feeder/search?search=Klob%C3%BCrste" class="image-link"></a>
            </div>
            <div class="text-wrapper">
                <p>Toilettenbürste<br>Kaktus und viele mehr<br>
                    <a href="https://catch.app/feeder/search?search=Klob%C3%BCrste"><?= __('Hier lang') ?></a>
                </p>
                <div class="vector"></div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('menu') ?>

<div class="container-fluid footer" id="footer">
    <?= $this->element('footer') ?>
</div>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MG9T7LM"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
    if (window.addEventListener) {
        window.addEventListener('load', callDataLayer, false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', callDataLayer());
    }

    <?php
    if ($user_id = $this->request->getSession()->consume('Pandata.just_logged')) {
    ?>
    window.localStorage.setItem('pandata_login_userid', <?= $user_id ?>);
    pushEcommerce('login', null);
    google.userId = <?= $user_id ?>;
    <?php
    }
    ?>

    function callDataLayer()
    {
        push2dataLayer({
            'basketProducts': pandata.basketProducts, // array of one or more item-objects, if cart is populated, [] otherwise
            'country': 'de',
            'currencyCode': 'EUR',
            'ecommerce': google.ecommerce, // object with specific tracking data, as of documentation, possibily shared with other not-overlapping data
            'event': google.event, // ['page'|'promotionClick'] default is 'page'
            'hashM': <?= $authUser ?? false ? "'" . md5($authUser->email) . "'" : 'undefined' ?>,
            'itemSiteId': 77, // for eBay Germany, EBAY-DE
            'localeLang': 'de',
            'lstgCurncyId': 'EUR', // as of feedback received, same as currencyCode?
            'pageType': '404',
            'query': pandata.query, // string search expression (only on search-results page) if provided, undefined otherwise
            'resultsNo': pandata.resultsNo, // 0 or positive on categories and search-results page, undefined otherwise
            'userId': <?= $authUser ?? false ? $authUser->id : 'undefined' ?>,
            'userLoginState': window.userLogedIn
        });
    }

    (function ($) {
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg', ['_full' => true]); ?>', type: 'white'});
        $('#error-content .image-link, #error-content .text-wrapper p a').on('click', function (e) {
            pushEcommerce('error404image', null);
        });
    })(jQuery);

    google.userId = <?= $authUser ?? false ? $authUser->id : 'undefined' ?>;

    // webExtend tracking helper
    <?php
    if ($authUser ?? false) {
    ?>
    ScarabQueue.push(['setEmail', '<?= $authUser->email ?>']);
    <?php
    }
    ?>
    ScarabQueue.push(['go']);
</script>
</body>
</html>

