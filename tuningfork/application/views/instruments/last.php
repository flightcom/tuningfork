<ul>
<?php foreach ($instrus as $i) : ?>
	<li><a href="/instruments/<?php echo $i->instru_id; ?>"><?php echo $i->marque_nom; ?> <?php echo $i->instru_modele; ?></a></li>
<?php endforeach; ?>
</ul>