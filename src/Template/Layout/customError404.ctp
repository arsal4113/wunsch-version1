<?php
/**
 * User: Rich
 * Date: 26.07.16
 * Time: 10:23
 */
echo $this->Html->css('Inspiria.bootstrap.min.css');
echo $this->Html->css('Inspiria.animate.css');
echo $this->Html->css('Inspiria.style.css');
echo $this->Html->css('Inspiria.login.css');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('eBay Template Creator | i-ways digital values') ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body class="gray-bg">
<div class="middle-box text-center animated fadeInDown">
    <div>
        <div class="text-center">
            <?= $this->Html->image('/Inspiria/img/logo2x.png', ['class' => 'logo', 'alt' => 'i-Ways digital values']) ?>
        </div>

        <h2 class="font-bold"><?= __('404 - Page not found') ?></h2>
        <br>
        <p class="lead">We are sorry. </p>
        <p class="lead">You could go <a href="javascript:history.back()"><u>back</u></a> or start again from the <a
                href=""><u>dashboard</u></a>.</p>
        <p class="lead"><span style="font-size: 14px">If this error prevents you from working further, please contact our <u><a
                        href="mailto:itooladmin@i-ways.net?Subject=Page%20not%20found">customer service</a></u></span>
        </p>
        <br>
        <p class="m-t text-center margin-top-20">
            <?= '&copy; ' . date('Y') . ' ' . __('i-Ways digital values') . '<br/>' . __('i-Tool 3 is crafted with <i class="fa fa-heart red"></i> in Berlin, Germany') ?>
        </p>
    </div>
</div>

<?php
echo $this->Html->script('jquery-2.1.1');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.blockUI');
?>

<?php echo $this->fetch('script'); ?>
</body>
</html>
