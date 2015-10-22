<!doctype html>
<html lang="fr">

	<head>
		<meta charset="utf-8">
		<base href="/">

		<title><?php echo $title; ?></title>

		<link href="<?php echo (CSS.'font-awesome.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo (CSS.'bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'bootstrap-typeahead.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'bootstrap-social-buttons.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'style.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'calendar.public.css'); ?>" rel="stylesheet" type="text/css"></script>

		<script src="<?php echo (JS.'utils.js'); ?>"></script>
		<script src="<?php echo (JS.'jquery/jquery-1.11.0.min.js'); ?>"></script> 

	</head>

	<body role="document" ng-app="tuningfork" data-app="public">

		<nav class="topbar navbar navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
  					<a class="navbar-brand" href="/">tuningfork</a>
				</div>

				<div class="collapse navbar-collapse" id="main-navbar">
					<ul class="center nav navbar-nav">
						<li><a href="#home">Home</a></li>
						<li><a href="#infos">Infos</a></li>
						<li><a href="#instruments">Instruments</a></li>
						<li><a href="#contact">Contact</a></li>
						<li><a href="/blog">Blog</a></li>
					</ul>

	<!-- 				<form name="search" id="search-form" class="navbar-form navbar-right" autocomplete="off" role="search">
						<div class="form-group">
							<input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un instrument..." >
						</div>
					</form>
	 -->
					<?php echo $this->session->userdata('account'); ?>

				</div>

			</div>

		</nav>

   		<div id="wrap" role="main" class="col-sd-12 col-lg-12 col-centered">
   			<div id="content">
				<?php echo $content; ?>
			</div>
		</div>

        <footer></footer>

		<script src="<?php echo (JS.'angularjs/angular.min.js'); ?>"></script>
		<script src="<?php echo (JS.'angularjs/ng-table.min.js'); ?>"></script>
		<script src="<?php echo (JS.'angularjs/ng-sanitize.min.js'); ?>"></script>
		<script src="<?php echo (JS.'angularjs/ng-route.min.js'); ?>"></script>
		<script src="<?php echo (JS.'bootstrap/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo (JS.'bootstrap/bootstrap-typeahead.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'handlebars.js'); ?>"></script> 
		<script src="<?php echo (JS.'calendar.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'public.js'); ?>"></script> 
		<script src="<?php echo (JS.'app.js'); ?>"></script> 

	</body>

</html>