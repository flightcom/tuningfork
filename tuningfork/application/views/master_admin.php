<!doctype html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />

		<title><?php echo $title; ?></title>

		<link href="<?php echo (CSS.'bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'theme.bootstrap.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'theme.jui.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'style.css'); ?>" rel="stylesheet" type="text/css"></script>
		<link href="<?php echo (CSS.'jquery.tablesorter.pager.css'); ?>" rel="stylesheet" type="text/css"></script>

	</head>

	<body role="document">
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
					<li><a href="/admin/"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<li><a href="/admin/instruments"><span class="glyphicon glyphicon-music"></span> Instruments</a></li>
					<li><a href="/admin/membres"><span class="glyphicon glyphicon-user"></span> Membres</a></li>
				</ul>

				<?php echo $this->session->userdata('account'); ?>

			</div><!--/.nav-collapse -->
		</div>

		<div style="height:48px;" id="spacer"></div>

		<div id="wrap" class="ui-layout-container" role="main">
			<?php echo $content; ?>
		</div>

		<script src="<?php echo (JS.'jquery-1.11.0.min.js'); ?>"></script>
		<script src="<?php echo (JS.'jquery.tablesorter.js'); ?>"></script> 
		<script src="<?php echo (JS.'jquery.tablesorter.widgets.js'); ?>"></script> 
		<script src="<?php echo (JS.'jquery.tablesorter.pager.js'); ?>"></script> 
		<script src="<?php echo (JS.'bootstrap.min.js'); ?>"></script> 
		<script src="<?php echo (JS.'script.js'); ?>"></script> 
	</body>

</html>