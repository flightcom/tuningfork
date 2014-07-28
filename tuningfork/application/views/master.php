<!doctype html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />

		<title><?php echo $title; ?></title>

		<link href="<?php echo (CSS.'bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'style.css'); ?>" rel="stylesheet" type="text/css"></script>
		<!-- <link href="<?php echo (CSS.'simple-sidebar.css'); ?>" rel="stylesheet" type="text/css"></script> -->

	</head>

	<body role="document">

		<div id="wrapper">

			<div class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Tuning Fork</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="/">Home</a></li>
						<li><a onclick="$(this).closest('li').addClass('bold');" href="/instruments/">Instruments</a></li>
						<li><a href="/news/liste">News</a></li>
						<li><a href="/contact/form">Contact</a></li>
					</ul>

					<?php echo $this->session->userdata('account'); ?>

				</div><!--/.nav-collapse -->
			</div>

			<div class="col-md-2">
			</div>

	   		<div id="wrap" role="main" class="col-xs-8 col-centered">
				<?php echo $content; ?>
			</div>

			<div class="col-md-2">
			</div>

	        <footer></footer>

		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php echo (JS.'jquery-1.11.0.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'bootstrap.min.js'); ?>"></script>

	</body>

</html>