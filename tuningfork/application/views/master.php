<!doctype html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />

		<title><?php echo $title; ?></title>

		<link href="<?php echo (CSS.'bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'bootstrap-typeahead.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'bootstrap-social-buttons.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo (CSS.'style.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'calendar.public.css'); ?>" rel="stylesheet" type="text/css"></script>
		<script src="<?php echo (JS.'jquery/jquery-1.11.0.min.js'); ?>"></script> 

	</head>

	<body role="document" ng-app="tuningfork" data-app="public">

		<div class=" center" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">tuningfork</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
<!-- 						<li><a href="/">Home</a></li>
					<li><a onclick="$(this).closest('li').addClass('bold');" href="/instruments/">Instruments</a></li>
					<li><a href="/news/liste">News</a></li>
					<li><a href="/contact/form">Contact</a></li>
-->
						<li><button type="button" class="btn btn-default navbar-btn" onclick="location.href='/'">Home</button></li>
					<li><button type="button" class="btn btn-default navbar-btn" onclick="location.href='/instruments'">Instruments</button></li>
					<li><button type="button" class="btn btn-default navbar-btn" onclick="location.href='/news'">News</button></li>
					<li><button type="button" class="btn btn-default navbar-btn" onclick="location.href='/contact'">Contact</button></li>
				</ul>

				<?php echo $this->session->userdata('account'); ?>

				<form name="search" id="search-form" class="navbar-form navbar-right" autocomplete="off" role="search">
					<div class="form-group">
						<input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un instrument..." >
					</div>
				</form>

			</div><!--/.nav-collapse -->
		</div>

		<!-- <div style="height:50px;" id="spacer"></div> -->


		<!-- <div class="col-lg-2 psidebar visible-lg-inline"></div> -->

   		<div id="wrap" role="main" class="col-sd-12 col-lg-12 col-centered">
   			<div id="content">
				<?php echo $content; ?>
			</div>
		</div>

		<!-- <div class="col-lg-2 psidebar visible-lg"><?php echo $this->session->userdata('sidebar2'); ?></div> -->

        <footer></footer>

		<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.24/angular.min.js"></script> -->
		<script src="<?php echo (JS.'angularjs/angular.min.js'); ?>"></script>
		<script src="<?php echo (JS.'bootstrap/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo (JS.'bootstrap/bootstrap-typeahead.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'handlebars.js'); ?>"></script> 
		<script src="<?php echo (JS.'calendar.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'public.js'); ?>"></script> 
		<script src="<?php echo (JS.'app.js'); ?>"></script> 

	</body>

</html>