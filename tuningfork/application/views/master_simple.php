<!doctype html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />

		<title><?php echo $title; ?></title>

		<link href="<?php echo (CSS.'bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'bootstrap-social-buttons.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo (CSS.'style.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'calendar.public.css'); ?>" rel="stylesheet" type="text/css"></script>
		<script src="<?php echo (JS.'jquery-1.11.0.min.js'); ?>"></script> 

	</head>

	<body role="print">

		<div id="wrapper">

	   		<div id="wrap" role="main" class="col-sd-12 col-lg-12 col-centered">
	   			<div id="content">
					<?php echo $content; ?>
				</div>
			</div>

		</div>

		<script src="<?php echo (JS.'bootstrap.min.js'); ?>"></script>
		<script src="<?php echo (JS.'bootstrap-typeahead.min.js'); ?>"></script> 
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.24/angular.min.js"></script>
		<script src="<?php echo (JS.'handlebars.js'); ?>"></script> 
		<script src="<?php echo (JS.'calendar.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'public.js'); ?>"></script> 

	</body>

</html>