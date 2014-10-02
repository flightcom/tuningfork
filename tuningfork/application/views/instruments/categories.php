<ol class="breadcrumb">
	<li><a href="/instruments">Tous</a></li>
	<li ng-repeat="categorie in path"><a href="/instruments">categorie.categ_nom</a></li>
</ol>

<form action="/instruments/<?php echo $categorie->categ_public_id; ?>" method="get">
	<input type="hidden" name="categorie" value="<?php echo $categorie->categ_id; ?>">
</form>

<div class="categorie col-xs-1 col-sd-2 col-md-3 col-lg-4 hovered" ng-repeat="categorie in categories">
	
	<a href="/instruments/{{categorie.categ_public_id}}">
		<img>
		<p>{{categorie.categ_nom}}</p>
	</a>

</div>
