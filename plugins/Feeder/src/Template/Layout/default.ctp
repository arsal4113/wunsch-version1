<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= __($this->fetch('title')) ?></title>
        <?= $this->Html->meta('favicon.jpg', '/favicon.jpg', ['type' => 'icon']) ?>
        <?= $this->Html->meta('meta_description', $feederCategory->meta_description) ?>
        <!-- CSS -->
        <?= $this->Html->css('bootstrap.min') ?>
        <?= $this->Html->css('https://fonts.googleapis.com/css?family=Open+Sans') ?>
        <?= $this->Html->css('styles') ?>
        <?= $this->fetch('css') ?>
        <!-- SCRIPTS -->
        <?= $this->Html->script('jquery-3.2.1.min') ?>
        <?= $this->Html->script('popper.min') ?>
        <?= $this->Html->script('bootstrap.min') ?>
        <?php echo $this->fetch('script') ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T94T7Z2');</script>
        <!-- End Google Tag Manager -->
    </head>
    <body>
        <div class="container" id="header">
            <header class="row">
                <?= $this->element('header') ?>
            </header>
        </div>
        <?= $this->cell('Feeder.CustomerSegmentation') ?>
        <?= $this->cell('Feeder.Navigation') ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <?= $this->Flash->render('auth') ?>
                    <?= $this->Flash->render() ?>
                </div>
            </div>
            <div class="row content-area">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <div class="container-fluid footer" id="footer">
            <div class="row">
                <div class="container">
                    <?= $this->element('footer') ?>
                </div>
            </div>
        </div>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=T94T7Z2" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    </body>
</html>
