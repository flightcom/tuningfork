<h3><?php echo $title; ?></h3>

<table class="table table-bordered table-striped">

	<?php foreach ($types as $t){ ?>
	<tr onclick="location.href='/instruments/<?php echo $categorie . '/' . $t->type_public_id; ?>'">
	    <td><?php echo $t->type_nom; ?></td>
	</tr>
	<?php } ?>

</table>