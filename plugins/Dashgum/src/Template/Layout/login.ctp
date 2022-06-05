<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="i-Tool 3 | i-Ways sales and solutions GmbH">
        <meta name="author" content="i-Ways sales and solutions GmbH">
        <meta name="keyword" content="i-Tool">

        <title>i-Tool 3 | i-Ways sales and solutions Gmbh</title>
    
        <?php 
            echo $this->Html->meta('icon');
            echo $this->Html->css('/assets/css/bootstrap');
            echo $this->Html->css('/assets/css/style');
            echo $this->Html->css('/assets/css/style-responsive');
            echo $this->Html->css('/assets/css/custom');
        ?>
        
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="/assets/js/html5shiv.js"></script>
              <script src="/assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="logo"><?= $this->Html->image('/Dashgum/assets/img/header-logo.png', ['class' => 'login-image', 'alt' => 'logo']) ?></div>
        <div id="login-page">
            <div class="container">
                <h2 class="form-login-heading"><?= __('<b>Welcome</b>. Please sign in.') ?></h2>
                <?= $this->Flash->render('auth') ?>
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <div class="copyright"><?= '&copy; ' . date('Y') . ' ' . __('i-Ways sales and solutions GmbH') . '<br/>' .  __('<small>i-Tool 3 is crafted with &hearts; in Berlin, Germany</small>') ?></div>
        <?php
            echo $this->Html->script('/assets/js/jquery');
            echo $this->Html->script('/assets/js/jquery.blockUI');
            echo $this->Html->script('/assets/js/bootstrap.min');
        ?>
        <?php echo $this->fetch('script'); ?>
    </body>
</html>
