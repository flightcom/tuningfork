<!doctype html>
<html lang="fr">

	<head>
		<meta charset="utf-8">
		<base href="/">

		<title><?php echo $title; ?></title>

		<link href="<?php echo (CSS.'font-awesome.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo (CSS.'bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'bootstrap-typeahead.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'ng-table.min.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'calendar.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'style.css'); ?>" rel="stylesheet" type="text/css"></script>

		<script src="<?php echo (JS.'utils.js'); ?>"></script> 
		<script src="<?php echo (JS.'jquery/jquery-1.11.0.min.js'); ?>"></script>
		<script src="<?php echo (JS.'angularjs/angular.min.js'); ?>"></script>

	</head>

	<body role="document" data-app="admin" ng-app="tuningfork" ng-cloak>

		<div id="container-global" class="col-xs-12 nopadding">

			<div id="topbar" class="navbar navbar-fixed-top" role="navigation">

				<div class="navbar-header col-sm-2 nopadding">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand pull-left" href="/">tuningfork</a>
				</div>

				<form action="/admin/recherche/" method="post" class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" id="search" name="search" class="form-control" placeholder="Rechercher...">
					</div>
				</form>

				<div class="collapse navbar-header navbar-collapse pull-right">

					<?php echo $this->session->userdata('account'); ?>

				</div>
			</div>

			<div id="middlebar" class="navbar col-xs-12 nomargin nopadding" role="navigation" ng-controller="MenuCtrl">
				<div class="navbar-header">
					<a class="navbar-brand" href="" ng-click="menu.set(!menu.visible())"><span class="glyphicon glyphicon-menu-hamburger"></span> Accueil</a>
				</div>
				<div class="navbar-header col-sm-10 pull-right nomargin nopadding">
					<?php echo $this->menu; ?>
				</div>

			</div>


			<div id="wrap" class="col-xs-12 col-centered pull-right" role="main" ng-controller="MenuCtrl" ng-class="{'col-sm-10': menu.visible(), 'col-sm-12': !menu.visible()}">

				<div class="sidebar col-xs-12 col-sm-2" ng-controller="MenuCtrl" ng-show="menu.visible()" id="sidebar-left">
					<?php echo $this->dashboard; ?>
				</div>

				<div id="content" class="admin">
					<?php echo $content; ?>
				</div>

			</div>
			
		</div>

		<script src="<?php echo (JS.'jquery/jquery.extend.js'); ?>"></script> 
		<script src="<?php echo (JS.'bootstrap/bootstrap.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'bootstrap/bootstrap-rating-input.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'bootstrap/bootstrap-typeahead.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'angularjs/ng-table.min.js'); ?>"></script>
		<script src="<?php echo (JS.'angularjs/ng-sanitize.min.js'); ?>"></script>
		<script src="<?php echo (JS.'angularjs/ng-route.min.js'); ?>"></script>
		<script src="<?php echo (JS.'angularjs/ng-animate.min.js'); ?>"></script>
		<script src="<?php echo (JS.'angularjs/ng-storage.min.js'); ?>"></script>
		<script src="<?php echo (JS.'handlebars.js'); ?>"></script> 
		<script src="<?php echo (JS.'calendar.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'admin.js'); ?>"></script> 
		<script src="<?php echo (JS.'app.js'); ?>"></script> 
		<script src="<?php echo (JS.'app-admin.js'); ?>"></script> 
	</body>

</html>