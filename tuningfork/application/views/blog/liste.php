<div class="pd20">

	<?php foreach($articles as $a) : ?>

	<article class="article">
		<h3 class="titre"><?php echo $a->article_titre; ?></h3>
		<!-- <p class="infos">le <?php echo date_format(date_create($a->article_date_creation), 'd/m/Y à H:i'); ?> par <?php echo $a->membre_prenom . ' ' . $a->membre_nom; ?></p> -->
		<p class="infos">le <?php echo strftime("%d %B %Y à %H:%M", strtotime($a->article_date_creation)); ?> par <?php echo $a->membre_prenom . ' ' . $a->membre_nom; ?></p>
		<div class="content"><?php echo $a->article_contenu; ?></div>
	</article>

	<?php endforeach; ?>

</div>
