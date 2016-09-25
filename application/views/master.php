<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

		<base href="/">

		<title><?php echo $title; ?></title>

		<link href="<?php echo (CSS_FILE); ?>" rel="stylesheet" type="text/css"></script>

	</head>

	<body ng-app="tuningfork">

    <!-- <nav class="navbar navbar-inverse navbar-fixed-top"> -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<a class="navbar-brand nopadding" href="/"><img src="<?php echo IMG_PATH; ?>/tuningfork.png" height="30"></a>
			</div>

			<ul id="main-menu" class="nav nav-pills">
				<li class="nav-item"><a class="nav-link" href="#asso">L'Association</a></li>
				<li class="nav-item"><a class="nav-link" href="#actus">Actualités</a></li>
				<li class="nav-item"><a class="nav-link" href="#instrumentheque">L'Instrumenthèque</a></li>
				<li class="nav-item"><a class="nav-link" href="#stations">Stations musicales</a></li>
				<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
				<li class="nav-item"><a class="nav-link" href="#jeparticipe">Je participe !</a></li>
				<!-- <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li> -->
			</ul>

<!-- 				<form name="search" id="search-form" class="navbar-form navbar-right" autocomplete="off" role="search">
				<div class="form-group">
					<input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un instrument..." >
				</div>
			</form>
-->
			<?php echo $this->session->userdata('account'); ?>

		</nav>

    <div class="container">
			<?php echo $content; ?>
		</div>

        <footer></footer>

		<script src="<?php echo (JS_FILE); ?>"></script> 

	</body>

</html>