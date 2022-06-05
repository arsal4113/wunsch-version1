<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="msapplication-config" content="none"/>

    <title><?= __('i-ways digital values') ?></title>

    <?php //Google analytics USER_ID variable ?>
    <input type="hidden" id="trackerId" value="<?= isset($authUser['id']) ? $authUser['id'] : '' ?>">

    <?php
        echo $this->Html->script('https://code.jquery.com/jquery-3.2.1.min.js');
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('plugins/iCheck/custom');
        echo $this->Html->css('animate');
        echo $this->Html->css('style');
        echo $this->Html->css('plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox');
        echo $this->Html->css('plugins/blueimp/css/blueimp-gallery.min');
        echo $this->Html->css('skin-lion/ui.easytree');
        echo $this->Html->css('plugins/summernote/summernote');
        echo $this->Html->css('plugins/summernote/summernote-bs3');
        echo $this->Html->css('custom');
        echo $this->Html->css('daterangepicker');
        echo $this->Html->css('plugins/colorpicker/bootstrap-colorpicker.min');
        echo $this->Html->css('plugins/jQueryUI/jquery-ui-1.10.4.custom.min');
        echo $this->Html->css('plugins/slick/slick');
        echo $this->Html->css('plugins/slick/slick-theme');

        echo $this->Html->script('EbayWidget.ebay_widgets');
        echo $this->Html->css('EbayWidget.ebay_widgets');
        echo $this->Html->css('EbayWidget.ebay_widgets_pages');
        echo $this->Html->css('EbayWidget.ebay_widgets_attributes');
        echo $this->Html->css('EbayWidget.ebay_widgets_image');

    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">
</head>

<body>


<div id="wrapper">

    <!-- SIDEBAR -->

    <?= $this->element('sidebar') ?>

    <div id="page-wrapper" class="gray-bg">
        <!-- HEADER -->
        <?= $this->element('header') ?>

        <!-- CONTENT -->
        <?= $this->Flash->render('auth') ?>
        <?= $this->Flash->render() ?>
        <?php echo $this->fetch('content'); ?>

        <!-- FOOTER -->
        <?= $this->element('footer') ?>
    </div>

</div>

<!-- Feature Info Modal -->
<?php
    if(isset($authUser['core_seller_type']) && isset($authUser['show_feature_info_box']) && $authUser['show_feature_info_box'] == 1) {
        if($this->elementExists('EbayFashion.' . $authUser['core_seller_type'] . '/feature_info')) {
            echo $this->element('EbayFashion.' . $authUser['core_seller_type'] . '/feature_info', ['user' => $authUser]);
            $_SESSION['Auth']['User']['show_feature_info_box'] = 0;
        }
    }
?>

<!-- Mainly scripts -->
<?php
echo $this->Html->script('jquery-2.1.1');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('plugins/metisMenu/jquery.metisMenu');
echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min');
?>

<!-- Custom and plugin javascript -->
<?php
echo $this->Html->script('inspinia');
echo $this->Html->script('plugins/pace/pace.min');
echo $this->Html->script('plugins/iCheck/icheck.min');
echo $this->Html->script('plugins/blueimp/jquery.blueimp-gallery.min');
echo $this->Html->script('jquery.blockUI');
echo $this->Html->script('jquery.cookie');
echo $this->Html->script('itool-config');
echo $this->Html->script('plugins/summernote/summernote.min');
echo $this->Html->script('plugins/slick/slick.min');
echo $this->Html->script('element-height-matching');
echo $this->Html->script('jquery.matchHeight');
echo $this->Html->script('moment');
echo $this->Html->script('daterangepicker');
echo $this->Html->script('plugins/colorpicker/bootstrap-colorpicker.min');
echo $this->Html->script('plugins/validate/jquery.validate.min');
?>

<?php echo $this->fetch('script'); ?>

</body>

</html>
