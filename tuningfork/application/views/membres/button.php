<?php if($this->session->userdata('logged_in')) { ?>
<ul class="nav navbar-nav navbar-right">
	<li>
		<a href=""><span><?php echo $this->session->userdata('user_prenom'); ?> <?php echo $this->session->userdata('user_nom'); ?></span></a>
	</li>
	<li class="dropdown">
		<div class="btn-group">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-home"></span></a>
		    <ul class="dropdown-menu" role="menu">
		    	<li><a href="#"><span class="glyphicon glyphicon-user"></span></a></li>
		    	<li><a onclick="console.log('ok');" href="/connexion/deconnexion"><span class="glyphicon glyphicon-off"></span></a></li>
	            <?php if($this->session->userdata('user_isAdmin')) { ?>
	            	<?php if(in_array('admin', $this->uri->segments)) { ?>
		    	<li><a href="/"><span class="glyphicon glyphicon-globe"></span></a></li>
	            <?php } else { ?>
		    	<li><a href="/admin"><span class="glyphicon glyphicon-wrench"></span></a></li>
					<?php } ?>
				<?php } ?>
		    </ul>
		</div>
	</li>
</ul>
<?php } else { ?>
<ul class="nav navbar-nav navbar-right">
	<li><a href="/connexion">Se connecter</a></li>
</ul>
<?php } ?>
