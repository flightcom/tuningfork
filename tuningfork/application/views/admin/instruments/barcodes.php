<span><?php echo $auto_increment; ?></span>
<ul>
<?php foreach ($barcodes as $bc) : ?>
	<li>
		<span></span>
		<img src="<?php echo $bc->ib_path; ?>">
	</li>
<?php endforeach; ?>
</ul>