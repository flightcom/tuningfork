<ol class="breadcrumb">
	<li><a href="/instruments">Tous</a></li>
	<li class="active"><a href="/instruments/<?php echo $categ->categ_public_id . '/';?>"><?php echo $categ->categ_nom; ?></a></li>
</ol>

<?php foreach ($types as $t){ ?>

<div class="categorie col-xs-1 col-sd-2 col-md-3 col-lg-4 hovered">
	
	<a href="/instruments/<?php echo $categ->categ_public_id . '/' . $t->type_public_id; ?>">
		<img />
		<p><?php echo $t->type_nom; ?></p>
	</a>

</div>


<?php } ?>
