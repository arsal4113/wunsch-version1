<?php

$this->Html->css('Feeder.gift-guide' . STATIC_MIN, ['block' => true, 'media' => 'all']);

$this->assign('title', 'Finde perfekte Geschenkideen | CATCH by eBay');
$this->assign('description', 'Entdecke den Geschenkefinder für tolle Geschenkideen - Jetzt auf CATCH by eBay ✓ Riesenauswahl ✓ Top-Deals ✓ Blitzversand ✓ Geprüfte Händler ► Jetzt kaufen!');
?>

<?php $this->start('content-fluid') ?>
    <?= $this->cell('Feeder.MegaNavi') ?>
<?php $this->end() ?>

<div class="col-12 content-wrapper">
    <div class="row cards-container">
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 text-card order-1">
            <div class="headline">
                <h1>Der große <span class="mobile-content"><br/></span>CATCH Geschenke Guide</h1>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 text-card order-3 order-lg-4 order-xl-5">
            <div class="content">
                <p>Weihnachten – die Zeit des Schenkens. Mit unserem großen Gift Guide liefern wir die coolsten Geschenkinspirationen für die unterschiedlichsten Anlässe.<br/>Jetzt durchklicken!</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-2">
            <a href="/geschenke-fuer-frauen">
                <div class="img-card rotate-left">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-frauen.jpg'); ?></div>
                    <div class="text-wrapper">Für Frauen</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-4 order-sm-5 order-lg-3">
            <a href="/geschenke-fuer-maenner">
                <div class="img-card rotate-right">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-maenner.jpg'); ?></div>
                    <div class="text-wrapper">Für Männer</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-5 order-sm-4 order-lg-7 order-xl-4">
            <a href="/geschenke-unter-10">
                <div class="img-card rotate-left">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-unter10.jpg'); ?></div>
                    <div class="text-wrapper">Unter 10€</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-6 order-sm-7 order-lg-5 order-xl-9">
            <a href="/geschenke-schwiegereltern">
                <div class="img-card rotate-right">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-schwiegereltern.jpg'); ?></div>
                    <div class="text-wrapper">Für die Schwiegereltern</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-7 order-sm-6 order-lg-6">
            <a href="/geschenke-fuer-musikliebhaber">
                <div class="img-card">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-musikfans.jpg'); ?></div>
                    <div class="text-wrapper">Für Musikfans</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-8 order-sm-9 order-lg-10 order-xl-7">
            <a href="/geschenke-fuer-leute-die-alles-haben">
                <div class="img-card rotate-right">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-leutedieschonalleshaben.jpg'); ?></div>
                    <div class="text-wrapper">Für Leute, die schon<br/>alles haben</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-9 order-sm-8 order-lg-8 order-xl-8">
            <a href="/geschenke-fuer-reisende">
                <div class="img-card rotate-left">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-weltenbummler.jpg'); ?></div>
                    <div class="text-wrapper">Für Weltenbummler</div>

                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-10 order-sm-11 order-lg-9">
            <a href="/geschenke-fuer-nerds">
                <div class="img-card rotate-right">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-nerds.jpg'); ?></div>
                    <div class="text-wrapper">Für Nerds</div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 card order-11 order-sm-10 order-lg-11">
            <a href="/geschenke-fuer-tierfreunde">
                <div class="img-card">
                    <div class="particles" id="particles"></div>
                    <div class="img-wrapper"><?= $this->Html->image('Feeder.gift-guide/catch-christmas-tierliebhaber.jpg'); ?></div>
                    <div class="text-wrapper">Für Tierliebhaber</div>
                </div>
            </a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('body').addClass('gift-guide');

        $('#header').header({catchLogo: '<?= $this->Url->image('CatchTheme.logo-catch-colour.svg'); ?>', type: 'white'});

        // snow effect on hover
        var particles = null;
        $('.card .img-card').on('mouseover', function () {
            if ($(window).width() > 1024) {
                particles = $(this).find('#particles');
                start();
            }
        });
        $('.card .img-card').on('mouseout', function () {
            if ($(window).width() > 1024) {
                particles = $(this).find('#particles');
                particles.find('.particle').remove();
            }
        });
        function start() {
            var np = document.documentElement.clientWidth / 5;
            particles.innerHTML = "";
            for (var i = 0; i < np; i++) {
                var w = document.documentElement.clientWidth;
                var h = document.documentElement.clientHeight;
                var rndw = Math.floor(Math.random() * w) + 1;
                var rndh = Math.floor(Math.random() * h) + 1;
                var widthpt = Math.floor(Math.random() * 8) + 3;
                var opty = Math.floor(Math.random() * 5) + 2;
                var anima = Math.floor(Math.random() * 12) + 8;

                var div = document.createElement("div");
                div.classList.add("particle");
                div.style.marginLeft = rndw + "px";
                div.style.marginTop = rndh + "px";
                div.style.width = widthpt + "px";
                div.style.height = widthpt + "px";
                div.style.background = "white";
                div.style.opacity = opty;
                div.style.animation = "move " + anima + "s ease-in infinite ";
                particles.append(div);
            }
        }

        // gift guide tiles click tracking
        $('.cards-container .card a').on('click', function (e) {
            push2dataLayer({
                'event': 'tileClick',
                'clickedItem': $(this).find('.text-wrapper').text(),
                'clickedUrl': $(this).attr('href')
            });
        });
    });
</script>

