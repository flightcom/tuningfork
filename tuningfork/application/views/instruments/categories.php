<ol class="breadcrumb">
	<li><a href="/instruments">Tous</a></li>
</ol>


<?php foreach ($categories as $c){ ?>

<div class="categorie col-xs-1 col-sd-2 col-md-3 col-lg-4 hovered">
	
	<a href="/instruments/<?php echo $c->categ_public_id; ?>">
		<img />
		<p><?php echo $c->categ_nom; ?></p>
	</a>

</div>


<?php } ?>
