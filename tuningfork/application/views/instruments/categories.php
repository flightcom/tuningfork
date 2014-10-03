<ol class="breadcrumb">
	<li><a href="/instruments/">Tous</a></li>
	<!-- <li ng-hide="!path.length" ng-repeat="cpath in path"><a href="/instruments">{{cpath}}</a></li> -->
</ol>

<form action="/instruments/<?php echo $parent ? $parent->categ_public_id : ''; ?>" method="get">
	<input type="hidden" name="parent" value="<?php echo $parent ? $parent->pathpublic : ''; ?>" >
</form>

<?php foreach ( $children as $child ) : ?>
<div class="categorie col-xs-6 col-sd-4 col-md-3 col-lg-2 hovered">
	
	<a href="/instruments/<?php echo $child->categ_public_id; ?>">
		<img>
		<p><?php echo $child->categ_nom; ?></p>
	</a>

</div>
<?php endforeach; ?>