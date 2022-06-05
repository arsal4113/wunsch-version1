<?php
	$this->layout = false;
	$cakeDescription = 'i-Tool 3'; 
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<?= $this->Html->charset() ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title><?= $cakeDescription ?></title>
		<meta name="description" content="i-Tool 3 by i-Ways sales and solutions GmbH" />
		<meta name="keywords" content="i-Tool 3 by i-Ways sales and solutions GmbH" />
		<meta name="author" content="i-Ways sales and solutions GmbH" />
		<?= $this->Html->meta('icon') ?>
		<?php
			echo $this->Html->css('/assets/css/intro');
			echo $this->Html->script('/assets/js/modernizr.custom');
		?>
	</head>
	<body>
		<div class="container">	
			<div class="os-phrases" id="os-phrases">
				<h2>There is nothing</h2>
				<h2>to see here</h2>
				<h2>Move along!</h2>
			</div>
		</div>
		<?php 
			echo $this->Html->script('/assets/js/jquery');
			echo $this->Html->script('/assets/js/jquery.lettering');
		?>
		<script>
			$(document).ready(function() {
				$("#os-phrases > h2").lettering('words').children("span").lettering().children("span").lettering(); 
			})
		</script>
	</body>
</html>