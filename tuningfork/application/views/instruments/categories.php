<h3><?php echo $title; ?></h3>

<table class="table table-bordered table-striped">

	<?php foreach ($categories as $c){ ?>
	<tr onclick="location.href='/instruments/<?php echo $c->categ_public_id; ?>'">
	    <td><?php echo $c->categ_nom; ?></td>
	</tr>
	<?php } ?>

</table>