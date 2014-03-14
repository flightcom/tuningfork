<h3><?php echo $title; ?></h3>

<table class="table table-bordered table-striped">

	<tr>
		<th>Marque</th>
		<th>Modèle</th>
		<th>Numéro</th>
	</tr>

	<?php foreach ($instruments as $i){ ?>
	<tr>
	    <td><?php echo $i->marque_nom; ?></td>
	    <td><?php echo $i->instru_modele; ?></td>
	    <td><?php echo $i->instru_code; ?></td>
	</tr>
	<?php } ?>

</table>