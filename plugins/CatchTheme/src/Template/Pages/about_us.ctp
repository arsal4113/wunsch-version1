<?php $this->start('content-fluid') ?>
    <?= $this->cell('Feeder.MegaNavi') ?>
<?php $this->end() ?>
<?php
$this->assign('title', 'Über uns | Catch - Trends in Fashion, Lifestyle & Tech');
$this->assign('description', 'Mit CATCH findest du das coolste. aus Fashion & Sport und Tech Gadgets ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler ► Jetzt entdecken');
?>

<div class="col-12 about-us-wrapper">
    <div class="row">
        <div class="col-12 welcome-wrapper">
            <p>Willkommen in der Welt von Catch</p>
            <p class="headline">See it. Love it.<br>Catch it. Now!</p>
            <a class="redesign-button" href="#about-us-scroller">Mehr erfahren</a>
        </div>
        <div class="col-12" id="about-us">
            <div id="about-us-scroller"></div>
            <div class="row">
                <div class="col-md-6 col-12 info-col">
                    <h1>Über uns</h1>
                    <p class="subtitle">Lass dich inspirieren –<br class="desktop-break"> catch dir deine Welt! </p>
                    <p>Kennst du auch das magische Gefühl, einen richtig guten Fang gemacht zu haben?
                        <br class="mobile-break"><br class="mobile-break"> Dafür gibt es
                        jetzt Catch – die neue Art Trends zu shoppen: visuell, schnell, instinktiv, inspirierend und
                        bezahlbar. Mit topaktuellen, spaßigen und praktischen Trendprodukten liefert Catch dir jeden Tag
                        neue Überraschungen – für dich oder zum Verschenken.</p>
                    <button class="sign-up redesign-button">Jetzt Catch-Mitglied werden</button>
                </div>
                <div class="col-md-6 col-12 img-col">
                    <?= $this->Html->image('CatchTheme.about-us-catch-new.png',
                        [
                            'class' => 'about-us-image',
                            'alt' => 'About us Image'
                        ])
                    ?>
                </div>
            </div>
        </div>
        <div class="col-12 about-worlds">
            <div class="no-overflow-background">
                <?php
                $imagesInfo = [
                    ['hiking', 120, 311, 0],
                    ['mom', 598, 0, 0],
                    ['shoe', 214, 93, 0],
                    ['couple', 410, 634, 421],
                    ['c3po', 55, 190, 53],
                    ['coffee', 154, 311, 0],
                    ['pink', 616, 682, 571],
                    ['football', 551, 598, 0],
                    ['food', 23, 130, 0],
                    ['group', -33, 29, 25],
                    ['baking', 709, 767, 0],
                    ['football', 0, -19, 0]
                ];
                foreach($imagesInfo as $key => $imageInfo) {
                    echo $this->Html->image('CatchTheme.about-us-background/' . $imageInfo[0] . '-circle.png',
                        [
                            'class' => 'worlds-background-image bubble-' . ($key + 1) . '-circle',
                            'alt' => 'Background Mood Image',
                            'data-desktop-top' => $imageInfo[1],
                            'data-tablet-top' => $imageInfo[2],
                            'data-mobile-top' => $imageInfo[3]
                        ]);
                }
                ?>
            </div>
            <div class="text-wrapper">
                <p class="title">Unsere Welten – Entdecke das Catch Universum</p>
                <p>Catch ist ein Lifestyle, dein tägliches Trend-Update und ultimatives visuelles Shopping-Erlebnis. Ein
                    Scroll, hunderte Catchs. Innerhalb der themenbezogenen Produktwelten findest du Artikel nach deinem
                    Geschmack und für alle Lebensbereiche. Alles direkt auf deinem Smartphone und mit nur wenigen Klicks
                    bei dir zu Hause.</p>
                <?= $this->Html->link('Jetzt Trends entdecken', [
                        'plugin' => 'Feeder',
                        'controller' => 'Worlds',
                        'action' => 'view'
                    ], ['class' => 'redesign-button']) ?>
            </div>
        </div>
        <div class="col-12 about-order">
            <div class="row">
                <div class="col-12 payment-bubble-wrapper mobile">
                    <div class="bubble ebay-bubble"></div>
                    <div class="bubble safety-bubble"></div>
                    <div class="bubble paypal-bubble"></div>
                </div>
                <div class="col-lg-6 col-md-7 col-12 order-description">
                    <h2>Bestellung</h2>
                    <p class="subtitle">Sicher und einfach bestellen dank unserer Partner eBay und PayPal!</p>
                    <p>Unsere beiden erfahrenen Partner eBay und PayPal unterstützen unseren schnellen, einfachen und
                        zuverlässigen Einkaufsprozess – für ein optimiertes Shopping-Erlebnis für dich. Als Partner von
                        eBay kann Catch dir höchste Sicherheit rund um deine Bestellung versprechen, durch den eBay
                        Käuferschutz. Während PayPal eine blitzschnelle, unkomplizierte Zahlungsmethode ist, die viele
                        Händler auf Catch zur Wahl stellen.</p>
                </div>
                <div class="col-lg-6 col-5 payment-bubble-wrapper desktop">
                    <div class="bubble ebay-bubble"></div>
                    <div class="bubble safety-bubble"></div>
                    <div class="bubble paypal-bubble"></div>
                </div>
            </div>
        </div>
        <div class="col-12 about-account">
            <div class="no-overflow-wrapper">
                <?php
                $imagesInfo = [
                    ['handy', 50, 0, 7],
                    ['bag', 175, 191, 0],
                    ['skulls', 564, 0, 174],
                    ['brille', 629, 838, 600],
                    ['beard', 82, 94, 79],
                    ['usb', 242, 288, 0],
                    ['tasche', 444, 672, 0],
                    ['bottle', 170, 135, 0],
                    ['nap', 0, 600, 0],
                    ['konfetti', 729, 0, 579],
                    ['tshirt', -28, -46, 0],
                    ['unicorn', 637, 0, 0]
                ];
                foreach($imagesInfo as $key => $imageInfo) {
                    echo $this->Html->image('CatchTheme.about-us-background/' . $imageInfo[0] . '-heart.png',
                        [
                            'class' => 'account-background-image heart-' . ($key + 1),
                            'alt' => 'Background Mood Image',
                            'data-desktop-top' => $imageInfo[1],
                            'data-tablet-top' => $imageInfo[2],
                            'data-mobile-top' => $imageInfo[3]
                        ]);
                }
                ?>
            </div>
            <div class="text-wrapper">
                <p class="title">Speichere deine Lieblingsartikel in deiner persönlichen Wunschliste</p>
                <p>Dir gefallen so viele Artikel, dass du dich nicht entscheiden kannst?  Speichere dir alle deine
                    Lieblingsprodukte für die Zukunft in einer Wunschliste, auf die du später in deinem Konto zugreifen
                    kannst. Registriere dich dafür jetzt auf Catch oder melde dich in deinem bestehenden Account an. </p>
                <button id="sign-in" class="redesign-button">Zur Anmeldung</button>
            </div>
        </div>
        <div class="col-12 about-support">
            <div class="row">
                <div class="col-12 support-header">
                    <h2>Support</h2>
                    <p>Du hast Fragen zu einer getätigten Bestellung, der Kaufabwicklung oder anderen Themen rund um das Catch
                        Universum? Dann wende dich an unseren Kundensupport, der von unserem Partner eBay betreut wird. Wir
                        helfen dir jederzeit gerne weiter.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12 support-topic-wrapper">
                    <?= $this->Html->image('CatchTheme.support_icon_1.svg',
                        [
                            'class' => 'support-icon icon-1',
                            'alt' => 'moving on'
                        ])
                    ?>
                    <h3>Wie geht es weiter?</h3>
                    <p>Der Kauf wird über unseren Partner eBay abgewickelt. Wundere dich also bitte nicht, dass nach einer
                        Bestellung bei Catch die Kaufbestätigungs-E-Mail eines eBay-Händlers in deinem Postfach landet.</p>
                </div>
                <div class="col-lg-4 col-12 support-topic-wrapper">
                    <?= $this->Html->image('CatchTheme.support_icon_2.svg',
                        [
                            'class' => 'support-icon icon-2',
                            'alt' => 'contact form icon'
                        ])
                    ?>
                    <h3>Wen kann ich bei Fragen kontaktieren?</h3>
                    <p>Der professionelle Kundenservice von eBay steht dir gerne und jederzeit bei Fragen zur Verfügung. Nehme
                        hier Kontakt auf. Zudem hilft dir gerne der Händler, bei dem du ein Produkt bestellt hast, direkt weiter.
                        Seine Kontaktinformationen findest du in deiner Kaufbestätigungs-E-Mail in deinem Postfach, die du
                        direkt nach Abschluss der Bestellung erhalten hast. </p>
                    <?= $this->Html->link(
                            "Mehr Informationen",
                            ['plugin' => 'HelpDesk', 'controller' => 'Helps', 'action' => 'view'],
                            ['class' => 'redesign-button']
                    ) ?>
                </div>
                <div class="col-lg-4 col-12 support-topic-wrapper">
                    <?= $this->Html->image('CatchTheme.support_icon_3.svg',
                        [
                            'class' => 'support-icon icon-3',
                            'alt' => 'shopping bag icon'
                        ])
                    ?>
                    <h3>Wie kann ich Händler bei Catch werden?</h3>
                    <p>Du stellst coole Produkte her, die du gerne über Catch verkaufen würdest? Dann lass den
                        eBay-Händlerservice davon wissen und zeig, was du auf Lager hast. Du erreichst die Zuständigen hier.</p>
                </div>
            </div>
        </div>
        <div class="col-12 about-follow">
            <div class="follow-wrapper">
                <p class="big-title">Follow us</p>
                <p>Inspiration und Trendprodukte kann man nie genug kriegen! Drum folge uns auf Instagram und Facebook, um keine
                    Angebote von Catch mehr zu verpassen. Wir bieten dir dein tägliches Trendupdate und ultimativen Shopping-Spaß.
                    Wiederkommen lohnt sich! </p>
                <div class="icon-wrapper">
                    <a href="https://www.facebook.com/catchbyebay/" target="_blank">
                        <?= $this->Html->image('CatchTheme.facebook_icon.svg',
                            [
                                'class' => 'social-icon',
                                'alt' => 'facebook icon'
                            ])
                        ?>
                    </a>
                    <a href="https://www.instagram.com/catch_by_ebay/?hl=de" target="_blank">
                        <?= $this->Html->image('CatchTheme.instagram_icon.svg',
                            [
                                'class' => 'social-icon',
                                'alt' => 'instagram icon'
                            ])
                        ?>
                    </a>
                </div>
            </div>
            <div class="insta-container">
                <div id="insta-wrapper"></div>
            </div>
        </div>
        <div class="col-12 about-sign-up">
            <p>Tauch ein in das Catch Universum und kreiere deine eigene Welt. Catch Produkte sind überraschend, witzig, clever
                und schön, und zaubern jedem ein Lächeln ins Gesicht. 08/15 war gestern, Catch ist heute. Registriere dich mit
                wenigen Klicks, um deine Lieblingscatchs zu shoppen!</p>
            <button class="sign-up redesign-button">Jetzt Catch-Mitglied werden</button>
        </div>
    </div>
</div>
<script>
    document.body.classList.remove('orange-message-shown');
    $(function() {
        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});

        $('body').addClass('about-us');

        $('#sign-in').click(function () {
            if(!$('.burger-wrapper .container.user-not-logged .additional-message').length){
                $('.burger-wrapper .container.user-not-logged').prepend(catcher.loginSidebarNotLoggedInText);
            }else{
                $('.burger-wrapper .container.user-not-logged .additional-message').show();
            }
            $('.login-burger').show();
            $('.register-burger').hide();
            catcher.showMenu();
        });

        $('.sign-up').click(function () {
            catcher.showMenu();
            loadRecaptcha();
            $('.login-burger, .register-burger').toggle();
        });

        const instagramSection = $('#insta-wrapper');
        function createInstagramSection(data) {
            let count = 0;
            for (const post of data) {
                if ((post.media_type !== 'IMAGE' && post.media_type !== 'CAROUSEL_ALBUM')
                    || !post.permalink || !post.media_url) continue;
                if (count === 12) break;
                const image = document.createElement('div');
                image.setAttribute('style', 'background: url(' + post.media_url + ') 50% 50%/cover no-repeat');
                image.title = post.caption || '';
                const link = document.createElement('a');
                link.className = 'insta-image';
                link.href = post.permalink;
                link.target = '_blank';
                link.append(image);
                const instaPost = document.createElement('div');
                instaPost.className = 'insta-post';
                instaPost.append(link);
                instagramSection.append(instaPost);
                count++;
            }
        }

        const instaAccessToken = '<?= $instaAccessToken ?? 0 ?>';
        if (instaAccessToken !== '0') {
            const request = new XMLHttpRequest();
            request.open('GET', 'https://graph.instagram.com/me/media?fields=caption,media_url,media_type,permalink&access_token=' + instaAccessToken);
            request.addEventListener('load', (event) => {
                if (request.status >= 200 && request.status < 300) {
                    const response = JSON.parse(request.responseText);
                    createInstagramSection(response.data);
                } else {
                    // access token probably invalid, maybe trigger alert or email
                }
            });
            request.send();
        } else {
            // no access token provided, also trigger alert/mail?
        }

        var device = undefined;
        var windowHeight = $(window).height();
        var windowWidth = 0;
        function assessDeviceType(width){
            if(width > 1023){
                device = "desktop";
            }else if(width <= 1023 && width >= 768){
                device = "tablet";
            }else{
                device = "mobile";
            }
        }
        assessDeviceType($(window).width());
        $(window).resize(function () {
            assessDeviceType($(window).width());
            checkParalaxPosition(true);
            windowHeight = $(window).height();
            windowWidth = $(window).width();
        });

        var worlds = $('.about-worlds');
        var account = $('.about-account');
        var welcomeWrapper = $('.welcome-wrapper');

        $(window).on('DOMContentLoaded load scroll', function () {
            checkParalaxPosition();
        });

        function checkParalaxPosition(checkOutsideView = false){
            if(elementInViewport(worlds) || checkOutsideView){
                worldsParalax();
            }
            if(elementInViewport(account) || checkOutsideView){
                accountParalax();
            }
            if(elementInViewport(welcomeWrapper) || checkOutsideView){
                welcomeParalax();
            }
        }

        function worldsParalax(){
            var rect = worlds[0].getBoundingClientRect();
            var distance = rect.top;
            var top = 0;
            var elementHeight = 0;
            $('.worlds-background-image').each(function () {
                top = $(this).data(device + '-top');
                elementHeight = $(this).height();
                if(top === 0){
                    return true;
                }else if(device === "desktop"){
                    if(windowWidth >= 1400){
                        top -= (distance / (windowHeight / 300));
                    }else{
                        top -= (distance / (windowHeight / 200));
                    }
                    if(top < -90){
                        top = -90;
                    }else if(top + elementHeight > 980){
                        top = 980 - elementHeight;
                    }
                }else if(device === "tablet"){
                    top -= (distance / (windowHeight / 100));
                    if(top < -50){
                        top = -50;
                    }else if(top + elementHeight > 1000){
                        top = 1000 - elementHeight;
                    }
                }else if(device === "mobile"){
                    top -= (distance / (windowHeight / 100));
                    if(top < -50){
                        top = -50;
                    }else if(top + elementHeight > 745){
                        top = 745 - elementHeight;
                    }
                }
                $(this).css({'top': top});
            });
        }
        function accountParalax(){
            var rect = account[0].getBoundingClientRect();
            var distance = rect.top;
            var top = 0;
            var elementHeight = 0;
            $('.account-background-image').each(function () {
                top = $(this).data(device + '-top');
                elementHeight = $(this).height();
                if(top === 0){
                    return true;
                }else if(device === "desktop"){
                    if(windowWidth >= 1400){
                        top -= (distance / (windowHeight / 300));
                    }else{
                        top -= (distance / (windowHeight / 200));
                    }
                    if(top < -115){
                        top = -115;
                    }else if(top + elementHeight > 916){
                        top = 916 - elementHeight;
                    }
                }else if(device === "tablet"){
                    top -= (distance / (windowHeight / 100));
                    if(top + elementHeight > 1063){
                        top = 1063 - elementHeight;
                    }else if(top < -82){
                        top = -82;
                    }
                }else if(device === "mobile"){
                    top -= (distance / (windowHeight / 100));
                    if(top + elementHeight > 770){
                        top = 770 - elementHeight;
                    }else if(top < -40){
                        top = -40;
                    }
                }
                $(this).css({'top': top});
            });
        }
        function welcomeParalax(){
            if(device === "mobile"){
                //welcomeWrapper.css({'background-position-y': $(window).scrollTop()});
            }else{
                welcomeWrapper.css('background-position-y', "");
            }
        }

        function elementInViewport (el) {
            var rect = el[0].getBoundingClientRect();
            return (rect.top > -rect.height && (rect.top - 150) < $(window).height());
        }
    });
</script>
