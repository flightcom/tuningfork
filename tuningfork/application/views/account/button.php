<?php if($this->session->userdata('logged_in')) { ?>
<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-home"></a>
	    <ul class="dropdown-menu">
	    	<li><a href="#"><span class="glyphicon glyphicon-user"></a></li>
	    	<li><a href="/connexion/deconnexion"><span class="glyphicon glyphicon-off"></a></li>
            <?php if($this->session->userdata('user_isAdmin')) { ?>
            	<?php if(in_array('admin', $this->uri->segments)) { ?>
	    	<li><a href="/"><span class="glyphicon glyphicon-globe"></a></li>
            <?php } else { ?>
	    	<li><a href="/admin"><span class="glyphicon glyphicon-wrench"></a></li>
				<?php } ?>
			<?php } ?>


<!-- 	        <li>
	            <div class="navbar-content">
	                <div class="row">
	                    <div class="col-md-5">
	                        <img src="<?php echo $this->session->userdata('user_picture'); ?>"
	                            alt="Alternate Text" class="img-responsive" />
	                        <p class="text-center small">
	                            <a href="#">Changer ma photo</a></p>
	                    </div>
	                    <div class="col-md-7">
	                        <span><?php echo $this->session->userdata('user_prenom') . ' ' . $this->session->userdata('user_nom'); ?></span>
	                        <p class="text-muted small">
	                            <?php echo $this->session->userdata('user_email'); ?></p>
	                        <div class="divider">
	                        </div>
	                        <a href="#" class="btn btn-primary btn-sm">Mes infos</a>
	                        <?php if($this->session->userdata('user_isAdmin')) { ?>
	                        	<?php if(strstr($this->router->class, 'admin') !== FALSE) { ?>
	                        <a href="/" class="btn btn-primary btn-sm">Site</a>
	                        <?php } else { ?>
	                        <a href="/admin" class="btn btn-primary btn-sm">Admin</a>
								<?php } ?>
							<?php } ?>
	                    </div>
	                </div>
	            </div>
	            <div class="navbar-footer">
	                <div class="navbar-footer-content">
	                    <div class="row">
	                        <div class="col-md-6">
	                            <a href="#" class="btn btn-default btn-sm">Changer mon mot de passe</a>
	                        </div>
	                        <div class="col-md-6">
	                            <a href="/connexion/deconnexion" class="btn btn-default btn-sm pull-right">Déconnexion</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </li>
 -->	    </ul>
	</li>
</ul>
<?php } else { ?>
<ul class="nav navbar-nav navbar-right">
	<li><a href="/connexion">Se connecter</a></li>
</ul>
<?php } ?>
