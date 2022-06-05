<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msapplication-config" content="none"/>
    <title><?= __('i-ways digital values') ?></title>

    <?php
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('animate');
    echo $this->Html->css('style');
    echo $this->Html->css('login');
   #echo $this->Html->script('google-tag-manager');
    #echo $this->Html->script('yandex-metrica');
   # echo $this->Html->script('zendesk');
    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body class="gray-bg">

<?= $this->element('google-tag-manager') ?>
<?= $this->element('yandex-metrica') ?>

<div class="header">
    <div class="header-wrapper">
        <div class="left">
            <a href="/">
                <?= $this->Html->image('/Inspiria/img/logo_white.png', ['class' => 'logo', 'alt' => 'i-ways digital values']) ?>
            </a>
        </div>
        <div class="header-middle">
            <div class="header-middle-1">
                <?= $this->Html->image('/Inspiria/img/check_icon.png', ['class' => 'check-icon', 'alt' => 'icon']) ?>
                <?= __('100% free of charge') ?>
            </div>
            <div class="header-middle-2">
                <?= $this->Html->image('/Inspiria/img/check_icon.png', ['class' => 'check-icon', 'alt' => 'icon']) ?>
                <?= __('Fully mobile responsive') ?>
            </div>
            <div class="header-middle-3">
                <?= $this->Html->image('/Inspiria/img/check_icon.png', ['class' => 'check-icon', 'alt' => 'icon']) ?>
                <?= __('100% eBay conform') ?>
            </div>
        </div>

        <div class="right">
            <div class="language-selector">
                <div class="dropdown">
                    <button onclick="showDropdown(this)"
                            class="dropbtn flag flag-selector flag-<?= $currentLanguageCode ?>"></button>
                    <div id="myDropdown" class="dropdown-content">
                        <?php foreach ($coreLanguageCodes as $language) {
                            if ($language != $currentLanguageCode) { ?>
                                <a class="flag flag-<?= $language ?>" href="#"
                                   data-language-code="<?= $language ?>"></a>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="middle-box loginscreen animated fadeInDown">
    <div>
        <h3 class="margin-top-100 white text-center"><?= __('This activation link is not valid.') ?></h3>

        <?= $this->Flash->render('auth') ?>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>

        <p class="m-t text-center white margin-top-20">
            <?= '&copy; ' . date('Y') . ' ' . __('i-ways digital values') . '<br/>' . __('eBay Template Creator in cooperation with eBay is crafted with <i class="fa fa-heart red"></i> in Berlin, Germany') ?>
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
