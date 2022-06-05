<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title><?= $this->fetch('title') ?></title>
    <?php
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('plugins/iCheck/custom');
    echo $this->Html->css('animate');
    echo $this->Html->css('style');
    echo $this->Html->css('plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox');
    echo $this->Html->css('plugins/blueimp/css/blueimp-gallery.min');
    echo $this->Html->css('skin-lion/ui.easytree');
    echo $this->Html->css('custom');
    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<?= $this->fetch('content') ?>
</body>
</html>
