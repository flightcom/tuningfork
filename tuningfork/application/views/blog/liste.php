<div class="pd20">

	<?php foreach($articles as $a) : ?>

	<article class="news">
		<h3 class="titre"><?php echo $a->news_titre; ?></h3>
		<p class="infos">le <?php echo $a->news_date_creation; ?> par <?php echo $a->membre_prenom . ' ' . $a->membre_nom; ?></p>
		<div class="content"><?php echo $a->news_contenu; ?></div>
	</article>

	<?php endforeach; ?>

</div>
