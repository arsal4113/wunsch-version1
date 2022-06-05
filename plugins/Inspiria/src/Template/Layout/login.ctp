<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msapplication-config" content="none"/>
    <title><?= __('i-ways digital values') ?></title>

    <?php
    echo $this->Html->css('bootstrap.min');
    // echo $this->Html->css('animate');
    // echo $this->Html->css('style');
    echo $this->Html->css('main');
    // echo $this->Html->css('login');
        // echo $this->Html->css('responsive');
   # echo $this->Html->script('google-tag-manager');
   # echo $this->Html->script('yandex-metrica');
   # echo $this->Html->script('zendesk');
    ?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>

<?= $this->element('google-tag-manager') ?>
<?= $this->element('yandex-metrica') ?>

<?= $this->element('login-header') ?>
    <div>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>

<?php
echo $this->Html->script('jquery-2.1.1');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.blockUI');
?>
<?php echo $this->fetch('script'); ?>

</body>
</html>
