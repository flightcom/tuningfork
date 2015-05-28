<?php if($this->session->userdata('logged_in')) { ?>
<a href=""><span><?php echo $this->session->userdata('user_prenom'); ?> <?php echo $this->session->userdata('user_nom'); ?></span></a>
<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-home"></a>
	    <ul class="dropdown-menu">
	    	<li><a href="#"><span class="glyphicon glyphicon-user"></a></li>
	    	<li><a onclick="console.log('ok');" href="/connexion/deconnexion"><span class="glyphicon glyphicon-off"></a></li>
            <?php if($this->session->userdata('user_isAdmin')) { ?>
            	<?php if(in_array('admin', $this->uri->segments)) { ?>
	    	<li><a href="/"><span class="glyphicon glyphicon-globe"></a></li>
            <?php } else { ?>
	    	<li><a href="/admin"><span class="glyphicon glyphicon-wrench"></a></li>
				<?php } ?>
			<?php } ?>
	    </ul>
	</li>
</ul>
<?php } else { ?>
<ul class="nav navbar-nav navbar-right">
	<li><a href="/connexion">Se connecter</a></li>
</ul>
<?php } ?>
