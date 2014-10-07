<ol class="breadcrumb">
	<li><a href="/instruments/">Tous</a></li>
	<?php if ( $parents) : foreach ( $parents as $p ) : ?>
	<li><a href="/instruments/<?php echo $p->categ_pathpublic; ?>"><?php echo $p->categ_nom; ?></a></li>
<?php endforeach; endif;?>
</ol>

<input type="hidden" name="path" value ng-init="path='<?php echo $parent ? $parent->categ_pathpublic : ''; ?>'" ng-model="path">

<?php foreach ( $children as $child ) : ?>
<div class="categorie col-xs-6 col-sm-4 col-md-3 col-lg-2 hovered">
	
	<a href="/instruments/<?php echo $child->categ_pathpublic; ?>">
		<img class="squarebox">
		<p><?php echo $child->categ_nom; ?></p>
	</a>

</div>
<?php endforeach; ?>
