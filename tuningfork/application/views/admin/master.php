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

	<body role="document" data-app="admin" ng-app="tuningfork">

		<div class="sidebar col-xs-12 col-sm-1 " id="left-sidebar" 
			ng-class="{'hidden-xs': !showMenu}"
			ng-controller="MenuCtrl" 
			ng-show="$root.showMenu" 
			ng-init="$root.showMenu=true">
			<a class="navbar-brand" href="/">tuningfork</a>
			<?php echo $this->dashboard; ?>
		</div>

		<div id="container-global" class="nopadding" ng-class="{'col-xs-12': !showMenu, 'col-xs-11': showMenu}">

			<div id="topbar" class="navbar navbar-inverse" role="navigation">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href=""><span class="glyphicon glyphicon-menu-hamburger" onclick="return false;" ng-click="$root.showMenu=!$root.showMenu;"></span></a>
				</div>
				<div class="collapse navbar-collapse pull-right">

					<?php echo $this->session->userdata('account'); ?>

					<form action="/admin/recherche/" method="post" class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input type="text" id="search" name="search" class="form-control" placeholder="Rechercher...">
						</div>
					</form>

				</div>
			</div>

			<div id="wrap" class="col-xs-12 col-centered " role="main">

				<?php echo $this->menu; ?>

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
		<script src="<?php echo (JS.'handlebars.js'); ?>"></script> 
		<script src="<?php echo (JS.'calendar.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'admin.js'); ?>"></script> 
		<script src="<?php echo (JS.'app.js'); ?>"></script> 
		<script src="<?php echo (JS.'app-admin.js'); ?>"></script> 
	</body>

</html>