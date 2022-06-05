<!DOCTYPE html>
<html>
<head>
    <?= __($this->fetch('productMarkup')) ?>
    <!-- Meta -->
    <meta charset="utf-8">

    <?php if (!empty($canonicalLink = $this->fetch('canonicalLink'))): ?>
    <?= $this->Html->meta(['link' => $canonicalLink, 'rel' => 'canonical']); ?>
    <?php endif; ?>
	
	<?php if ($_SERVER['REQUEST_URI'] == '/customer/login' || $_SERVER['REQUEST_URI'] == '/customer/logout' || strpos($_SERVER['REQUEST_URI'], 'checkout')): ?>	
    <?= $this->Html->meta('robots', 'noindex, follow'); ?>
    <?php elseif (!empty($robotTag = $this->fetch('robotTag'))): ?>
    <?= $this->Html->meta('robots', $robotTag); ?>
    <?php endif; ?>

    <?php
    if (isset($feederCategory)) {
        $metaTags = [
            'og:url' => ['facebook_og_url', 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']],
            'og:type' => ['facebook_og_type', 'website'],
            'og:title' => ['facebook_og_title', $feederCategory->title_tag],
            'og:description' => ['facebook_og_description', $feederCategory->meta_description],
            'og:image' => ['facebook_og_image', !empty($feederCategory->background) ? $feederCategory->background : $feederCategory->image]
        ];
    } else if (isset($pillarPage)) {
        $metaTags = [
            'og:url' => ['facebook_og_url', 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']],
            'og:title' => ['facebook_og_title', $pillarPage->title_tag],
            'og:description' => ['facebook_og_description', $pillarPage->meta_tag],
            'og:image' => ['facebook_og_image', strpos($pillarPage->guide_image, 'http') !== 0
                ? 'https://' . $_SERVER['SERVER_NAME'] . $this->Url->image($pillarPage->guide_image)
                : $pillarPage->guide_image]
        ];
    }

    foreach ($metaTags ?? [] as $key => $metaTag) { ?>
            <meta property="<?= $key ?>" content="<?= !empty($this->fetch($metaTag[0])) ? $this->fetch($metaTag[0]) : $metaTag[1] ?>"/>
    <?php } ?>
    <?php
    $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
    $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");

    if ($iPod || $iPhone || $iPad) {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">';
    } else {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
    }
    ?>
    <meta name="google-site-verification" content="yHJflN9l-wlnOkxeOfX6D_X-F69Dtrp79PC7gf5EH68"/>

    <?php if (!empty($description = $this->fetch('description'))): ?>
    <meta name="description" content="<?= $description ?>"/>
    <?php endif; ?>

    <?= $this->Html->meta('icon', 'CatchTheme.fav.svg', ['type' => 'image/svg+xml']) ?>
    <?= $this->Html->meta('icon', 'CatchTheme.favicon.ico', ['type' => 'image/x-icon']) ?>

    <?php if (isset($title) || !empty($title = $this->fetch('title'))): ?>
    <!-- Title -->
    <title><?= __($title) ?></title>
    <?php endif; ?>
    <!-- CSS -->
    <?= $this->Html->css('styles' . STATIC_MIN, ['media' => 'all']) ?>
    <?php $this->Html->css('ItoolCustomer.customer' . STATIC_MIN, ['block' => true, 'media' => 'all']); ?>
    <?= $this->fetch('css') ?>
    <!-- SCRIPTS -->
    <script>
        window.userLoginCallback = function () {};
        window.userLogedIn = <?= $authUser ?? false ? 'true' : 'false' ?>;
    </script>
    <?= $this->Html->script('jquery-3.2.1.min') ?>
    <?= $this->Html->script('jquery-ui.min.js') ?>
    <?= $this->Html->script('jquery.ui.touch-punch.min.js') ?>
    <?= $this->Html->script('datalayer' . STATIC_MIN); ?>
    <?= $this->Html->script('header' . STATIC_MIN); ?>
    <?= $this->fetch('script') ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-798452524"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'AW-798452524');
    </script>

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

    <!-- Start VWO Async Smartcode -->
    <script type='text/javascript'>
        window._vwo_code = window._vwo_code || (function(){
            var account_id=510959,
                settings_tolerance=2000,
                library_tolerance=2500,
                use_existing_jquery=false,
                is_spa=1,
                hide_element='body',

                /* DO NOT EDIT BELOW THIS LINE */
                f=false,d=document,code={use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){
                        window.settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);var a=d.createElement('style'),b=hide_element?hide_element+'{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}':'',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);this.load('https://dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&f='+(+is_spa)+'&r='+Math.random());return settings_timer; }};window._vwo_settings_timer = code.init(); return code; }());
    </script>
</head>
<body class="<?= isset($bodyClass) ? $bodyClass . ' ' : '' ?>">

<div class="container-fluid" id="header">
    <header class="row">
        <?= $this->element('header',
            [
                'upper' => $upper,
                'under' => $under,
                'homeUrl' => $homeUrl,
                'searchUrl' => $searchUrl,
                'childCategories' => $childCategories ?? null,
                'customerSegment' => $customerSegment ?? null,
                'selectedCategoryId' => $selectedCategoryId,
                'orangeTitle' => $orangeTitle ?? false
            ]) ?>
    </header>
    <?= $this->fetch('category-filter') ?>
    <?= $this->fetch('page-control') ?>
</div>
<div class="container-fluid" id="content">
    <div class="container" id="messages">
        <div class="row">
            <div class="col">
                <?= $this->Flash->render('auth') ?>
                <?= $this->Flash->render() ?>
                <?= $this->Flash->render('popup-success') ?>
                <?= $this->Flash->render('popup-email') ?>
            </div>
        </div>
    </div>
    <?php if (isset($pillarPage)) echo '<div class="row">' . $this->cell('Feeder.MegaNavi') . '</div>' ?>
    <?= $this->fetch('category-banner') ?>
    <div class="row">
        <?= $this->fetch('content-fluid') ?>
    </div>
    <div class="row content-container-row">
        <div class="container">
            <div class="row content-area">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid footer" id="footer">
    <?= $this->element('footer') ?>
</div>
<div class="container-fluid position-fixed fixed-bottom" id="cookies-layer">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 text-wrapper">
                    <p id="cookies-text">
                        <?= __('Catch verwendet Cookies, um dir das bestmögliche Erlebnis zu ermöglichen. Wenn Du weiter auf der Seite surfst, stimmst du damit der
                                                <a href="{0}" target="_blank">Cookie-Nutzung</a> zu',
                                                'https://catch.app/datenschutz') ?>
                    </p>
                </div>
                <div class="col-12 col-lg-2 button-wrapper">
                    <a href="Javascript:;" class="cookies-close-button"><?= __('Akzeptieren') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('menu') ?>
<?php //echo'<pre>';var_dump($authUser->newsletter);echo'</pre>';
if ((!$authUser ||!$authUser->newsletter) && isset($feederHomepage) && $feederHomepage->activate_newsletter_popup) {
    echo $this->element('ItoolCustomer.newsletter_popup');
}
$userFirstName = '';
if ($authUser) {
    $userFirstName = $authUser->first_name;
}
?>
<script>
    window.userFirstName = <?= json_encode($userFirstName) ?>;
</script>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MG9T7LM"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Pandata General Code -->
<script type="text/javascript">
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
            'pageType': pandata.pageType, // ['category'|'checkout'|'home'|'searchresults'|'product'|'purchase'|...|'Cookieserklärung'|'Datenschutzerklärung'|'Impressum']
            'query': pandata.query, // string search expression (only on search-results page) if provided, undefined otherwise
            'resultsNo': pandata.resultsNo, // 0 or positive on categories and search-results page, undefined otherwise
            'userId': <?= $authUser ?? false ? $authUser->id : 'undefined' ?>,
            'userLoginState': window.userLogedIn
        });
    }

    google.userId = <?= $authUser ?? false ? $authUser->id : 'undefined' ?>;

    // webExtend tracking helper
    <?php
    if ($authUser ?? false) {
        ?>
        ScarabQueue.push(['setEmail', '<?= $authUser->email ?>']);
        <?php
    }
    ?>
    if (typeof transaction_tracking_identifier === 'undefined') {
        ScarabQueue.push(['go']);
    }
</script>
<!-- /Pandata General Code -->
<?php if (!STATIC_MIN) : ?>
    <?= $this->Html->script('catcher'); ?>
    <?= $this->Html->script('cookie') ?>
    <?= $this->Html->script('EbayCheckout.mini-cart') ?>
    <?= $this->Html->script('ItoolCustomer.wishlist') ?>
    <?= $this->Html->script('lazysizes.min') ?>
    <?= $this->Html->script('cookie') ?>
<?php else:  ?>
    <?= $this->Html->script('main.min'); ?>
<?php endif; ?>
</body>
</html>
