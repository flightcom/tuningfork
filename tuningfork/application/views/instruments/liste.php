<ol class="breadcrumb">
	<li><a href="/instruments">Tous</a></li>
	<li><a href="/instruments/<?php echo $categ->categ_public_id . '/';?>"><?php echo $categ->categ_nom; ?></a></li>
	<li class="active"><a href="/instruments/<?php echo $categ->categ_public_id . '/' . $type->type_public_id . '/';?>"><?php echo $type->type_nom; ?></a></li>
</ol>


<?php foreach ($instruments as $i){ ?>

<div class="categorie col-xs-3 hovered">

	<a href="/instruments/<?php echo $categ->categ_public_id . '/' . $type->type_public_id . '/' . $i->instru_modele;?>">
		<img />
		<p><?php echo $i->marque_nom; ?> <?php echo $i->instru_modele; ?></p>
	</a>

</div>


<?php } ?>
