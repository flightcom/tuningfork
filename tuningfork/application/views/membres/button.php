<?php if($this->session->userdata('logged_in')) { ?>
<div class="col-sm-2 nopadding">
	<ul class="nav navbar-nav pull-right">
		<li>
			<a href="" class="dropdown-toggle" data-toggle="dropdown">
				<span><?php echo $this->session->userdata('user_prenom'); ?> <?php echo $this->session->userdata('user_nom'); ?></span>
			    <ul class="dropdown-menu" role="menu">
			    	<li><a href="#"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
			    	<li><a href="/connexion/deconnexion"><span class="glyphicon glyphicon-off"></span> Déconnexion</a></li>
		            <?php if($this->session->userdata('user_isAdmin')) { ?>
		            	<?php if(in_array('admin', $this->uri->segments)) { ?>
			    	<li><a href="/"><span class="glyphicon glyphicon-globe"></span> Site client</a></li>
		            <?php } else { ?>
			    	<li><a href="/admin"><span class="glyphicon glyphicon-wrench"></span> Espace membre</a></li>
						<?php } ?>
					<?php } ?>
			    </ul>
			</a>
		</li>
	</ul>
	<?php } else { ?>
	<ul class="nav navbar-nav navbar-right">
		<li><a href="/connexion">Se connecter</a></li>
	</ul>
</div>
<?php } ?>
