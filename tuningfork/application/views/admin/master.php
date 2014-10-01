<!doctype html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />

		<title><?php echo $title; ?></title>

		<link href="<?php echo (CSS.'bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'theme.bootstrap.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'bootstrap-typeahead.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<!-- <link href="<?php echo (CSS.'theme.jui.css'); ?>" rel="stylesheet" type="text/css"></script> -->
		<link href="<?php echo (CSS.'calendar.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'style.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'jquery.tablesorter.pager.css'); ?>" rel="stylesheet" type="text/css"></script>

		<script src="<?php echo (JS.'jquery/jquery-1.11.0.min.js'); ?>"></script>

	</head>

	<body role="document" data-app="admin" ng-app="tuningfork">
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
				</ul>

				<?php echo $this->session->userdata('account'); ?>

				<form action="/admin/recherche/" method="post" class="navbar-form navbar-right" role="search">
					<div class="form-group">
						<input type="text" id="search" name="search" class="form-control" placeholder="Rechercher...">
					</div>
					<!-- <button type="submit" class="btn btn-default">Valider</button> -->
				</form>

			</div><!--/.nav-collapse -->
		</div>

		<div style="height:48px;" id="spacer"></div>

		<div class="col-xs-2 col-lg-1 sidebar" id="left-sidebar"><?php echo $this->dashboard; ?></div>

		<div id="wrap" class="col-xs-10 col-lg-11 col-centered pull-right" role="main">

			<?php echo $this->menu; ?>

			<div id="content" class="admin">
				<?php echo $content; ?>
			</div>

		</div>

		<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.24/angular.min.js"></script> -->
		<script src="<?php echo (JS.'angularjs/angular.min.js'); ?>"></script>
		<script src="<?php echo (JS.'jquery/jquery.extend.js'); ?>"></script> 
		<script src="<?php echo (JS.'jquery/jquery.tablesorter.js'); ?>"></script> 
		<script src="<?php echo (JS.'jquery/jquery.tablesorter.widgets.js'); ?>"></script> 
		<script src="<?php echo (JS.'jquery/jquery.tablesorter.pager.js'); ?>"></script> 
		<script src="<?php echo (JS.'bootstrap/bootstrap.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'bootstrap/bootstrap-rating-input.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'bootstrap/bootstrap-typeahead.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'handlebars.js'); ?>"></script> 
		<script src="<?php echo (JS.'calendar.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'admin.js'); ?>"></script> 
		<script src="<?php echo (JS.'app.js'); ?>"></script> 
	</body>

</html>