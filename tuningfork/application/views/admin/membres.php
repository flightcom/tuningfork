<h3><?php echo $title; ?></h3>
	
<table class="table table-bordered table-striped">

	<tr>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Tel</th>
		<th>Email</th>
	</tr>

	<?php foreach ($membres as $m){ ?>
	<tr>
	    <td><?php echo $m->membre_nom; ?></td>
	    <td><?php echo $m->membre_prenom; ?></td>
	    <td><?php echo $m->membre_tel; ?></td>
	    <td><?php echo $m->membre_email; ?></td>
	</tr>
	<?php } ?>

</table>