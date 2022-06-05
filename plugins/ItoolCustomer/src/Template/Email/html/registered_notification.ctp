<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <style>
        /* CUSTOM FONT VISUELT*/
        @font-face {
            font-family: 'Visuelt-Bold';
        url('https://catch.app/catch_theme/css/fonts/visuelt-bold.woff') format('woff'), /* Modern Browsers */
        url('https://catch.app/catch_theme/css/fonts/visuelt-bold.ttf') format('truetype'), /* Safari, Android, iOS */
        url('https://catch.app/catch_theme/css/fonts/visuelt-bold.svg#webfont') format('svg'); /* Legacy iOS */
        }
        @font-face {
            font-family: 'Visuelt-Regular';
        url('https://catch.app/catch_theme/css/fonts/visuelt-regular.woff') format('woff'), /* Modern Browsers */
        url('https://catch.app/catch_theme/css/fonts/visuelt-regular.ttf') format('truetype'), /* Safari, Android, iOS */
        url('https://catch.app/catch_theme/css/fonts/visuelt-regular.svg#webfont') format('svg'); /* Legacy iOS */
        }

        body {
            font-family: 'visuelt-regular', sans-serif;
            max-width: 600px;
            margin: auto;
        }
        header {
            margin-top: 10px;
        }
        .container {
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }
        .header {
            width: 125px;
            margin: auto;
            text-align: center;
        }
        .header a {
            font-size: 11px;
            line-height: 17px;
            color: #B3B3B3;
        }
        .header img {
            width: 104px;
            height: 100%;
            margin-top: 10px;
        }
        .page-content {
            margin-top: 8px;
            text-align: center;
        }
        .top-nav {
            font-size: 13px;
            line-height: 23px;
            max-width: 310px;
            margin: auto;
        }
        .top-nav a {
            color: #000000;
            text-decoration: none;
            margin: 0 10px;
        }
        .first-block h2 {
            font-family: 'visuelt-bold', sans-serif;
            font-size: 20px;
            line-height: 25px;
            margin-top: 20px;
            margin-bottom: 15px;
        }
        .first-block p {
            font-size: 14px;
            line-height: 22px;
            max-width: 340px;
            margin:0 auto 30px;
            padding-left: 125px;
            padding-right: 125px;
        }
        .first-block a {
            width: 200px;
            height: 40px;
            display: block;
            line-height: 40px;
            border-radius: 20px;
            color: #ffffff;
            background: #FDBE51;
            margin: 7px auto;
            text-decoration: none;
        }
        .middle-block {
            background-color: #F2F2F3;
            margin-top: 30px;
            height: 60px;
        }
        .middle-block .social-media {
            max-width: 280px;
            margin: auto;
            padding: 10px 0;
        }
        .middle-block .social-media a {
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 20px;
            margin: 0 10px;
        }
        .middle-block .social-media a.facebook {
            background: #FFFFFF url('<?= $this->Url->image('CatchTheme.fb.svg', ['fullBase' => true]) ?>') no-repeat center;
        }
        .middle-block .social-media a.instagram {
            background: #FFFFFF url('<?= $this->Url->image('CatchTheme.instagram.svg', ['fullBase' => true]) ?>') no-repeat center;
        }
        .middle-block .social-media a.pinterest {
            background: #FFFFFF url('<?= $this->Url->image('CatchTheme.pinterest.svg', ['fullBase' => true]) ?>') no-repeat center;
        }
        .bottom-block {
            background-color: #BEBEBE;
            padding: 25px 50px;
        }
        .bottom-block p {
            font-size: 11px;
            line-height: 19px;
            color: #ffffff;
            margin: 0 auto 20px;
            max-width: 735px;
        }
        .bottom-block p a {
            color: #ffffff;
        }
        .bottom-block a {
            color: #000000;
            font-size: 11px;
        }
        /* RWD */
        @media only screen and (max-width: 480px) {
            .first-block h2 {
                max-width: 210px;
            }
            .first-block p {
                padding-left: 30px;
                padding-right: 30px;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div class="header">
            <div>
                <td width="200" align="center">
                    <a target="_blank" href="https://catch.app">
                        <?= $this->Html->image('CatchTheme.catch-logo.svg', ['fullBase' => true, 'style' => 'width: 104px; height: 100%; display:block; border:none; outline:none; text-decoration:none;']) ?>
                    </a>
                </td>
            </div>
        </div>
    </div>
</header>
<div class="container page-content">
    <div class="top-nav">
        <a href="https://catch.app/girls-fashion">Fashion</a>
        <a href="https://catch.app/tech-gadgets">Tech Gadgets</a>
        <a href=" https://catch.app/home-sweet-home">Home Sweet Home</a>
    </div>
    <div class="first-block">
        <h2>Willkommen im Catch-Universum!</h2>
        <p>Catch dir deine Welt und lass dich von unseren  coolsten Trends und besten Deals inspirieren.</p>
        <a class="button" href="https://catch.app/world-of-trends">Mehr entdecken</a>
    </div>
    <div class="middle-block">
        <div class="social-media">
            <a href="https://www.facebook.com/catchbyebay/" class="facebook"></a>
            <a href="https://www.instagram.com/catch_by_ebay" class="instagram"></a>
            <a href="https://www.pinterest.de/catch_by_ebay/" class="pinterest"></a>
        </div>
    </div>
    <div class="bottom-block">
        <p>Diese Nachricht wurde Ihnen von der eBay GmbH übermittelt. Diese kann sich zur Erfüllung ihrer Dienstleistungen anderer eBay-Unternehmen
            bedienen. Falls Sie Ihren Wohn- oder Geschäftssitz außerhalb der EU haben, finden Sie die Kontaktdaten Ihres Vertragspartners in den Allgemeinen Geschäftsbedingungen.</p>
        <p>Wir werten Ihre Reaktion auf diesen Newsletter pseudonymisiert auf der Basis Ihres Mitgliedsnamens aus. So können wir Ihnen in Zukunft stärker auf Ihre Interessen
            zugeschnittene Newsletter zusenden. Wenn Sie dies nicht wünschen, bestellen Sie den Newsletter bitte wie oben beschrieben ab.</p>
        <a href=" https://pages.ebay.de/help/policies/legal-imprint.html">Impressum</a>
    </div>
</div>
</body>
</html>
