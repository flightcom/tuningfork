<!DOCTYPE html>
<html lang="fr">

    <?php $this->load->view('public/head'); ?>

	<body ng-app="app">

		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand nopadding" href="/"><img src="<?php echo IMG_PATH; ?>/logo_long_small.png" height="30"></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul id="main-menu" class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#asso">L'Association</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#actus">Actualités</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="#instrumentheque">L'Instrumenthèque</a></li>
                        <li class="nav-item"><a class="nav-link" href="#stations">Stations musicales</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#jeparticipe">Je participe !</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li> -->
                    </ul>
                    <?php // echo $this->session->userdata('account'); ?>
                </div>
            </div>

		</nav>

    	<div class="container-fluid">
			<?php echo $content; ?>
		</div>

		<?php $this->load->view('footer'); ?>

		<?php $this->load->view('alert'); ?>

		<script src="<?php echo (JS_FILE); ?>"></script>

	</body>

</html>
