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
$cakeDescription = 'i-Tool 3';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="i-Tool 3 | i-Ways sales and solutions GmbH">
		<meta name="author" content="i-Ways sales and solutions GmbH">
		<meta name="keyword" content="i-Tool">

		<title>
			<?php echo $cakeDescription; ?> | 
			<?php echo $this->fetch('title'); ?>
		</title>
		
        <?php 
            echo $this->Html->meta('icon');
            echo $this->Html->css('/assets/css/bootstrap');
            echo $this->Html->css('/assets/css/bootstrap.vertical-tabs.min');
            echo $this->Html->css('/assets/css/style');
            echo $this->Html->css('/assets/css/style-responsive');
            echo $this->Html->css('/assets/css/custom');
            echo $this->Html->css('/assets/js/lightbox/css/lightbox');
            echo $this->Html->css('/assets/css/skin-lion/ui.easytree');
        ?>
        
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="/assets/js/html5shiv.js"></script>
              <script src="/assets/js/respond.min.js"></script>
        <![endif]-->
	</head>
	<body>
		<section id="container">
			<?= $this->element('navbar') ?>
			<?= $this->element('sidebar') ?>
			<section id="main-content">
				<section class="wrapper site-min-height">
					<div class="row mt">
						<div class="col-lg-12">
							<?= $this->Flash->render('auth') ?>
							<?= $this->Flash->render() ?>
							<?php echo $this->fetch('content'); ?>
						</div>
					</div>
				</section>
			</section>

			<?= $this->element('footer') ?>
		</section>

		<?php 
			echo $this->Html->script('/assets/js/jquery');
			echo $this->Html->script('/assets/js/bootstrap.min');
			echo $this->Html->script('/assets/js/jquery-ui-1.9.2.custom.min');
			echo $this->Html->script('/assets/js/jquery.ui.touch-punch.min');
			echo $this->Html->script('/assets/js/jquery.dcjqaccordion.2.7');
			echo $this->Html->script('/assets/js/jquery.scrollTo.min');
			echo $this->Html->script('/assets/js/jquery.blockUI');
			echo $this->Html->script('/assets/js/common-scripts');
			echo $this->Html->script('/assets/js/lightbox/js/lightbox');
			echo $this->Html->script('/assets/js/ckeditor/ckeditor');
		?>
		<?php echo $this->fetch('script'); ?>
	</body>
</html>
