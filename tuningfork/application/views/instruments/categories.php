<ol class="breadcrumb">
	<li><a href="/instruments">Tous</a></li>
	<li ng-repeat="categorie in path"><a href="/instruments">{{categorie.categ_nom}}</a></li>
</ol>

<form action="/instruments/<?php echo $parent ? $parent->categ_public_id : ''; ?>" method="get">
	<input type="hidden" name="parent" value="<?php echo $parent ? $parent->categ_id: null; ?>" ng-model="parent">
</form>

<div class="categorie col-xs-6 col-sd-4 col-md-3 col-lg-2 hovered" ng-repeat="categorie in children">
	
	<a href="/instruments/{{categorie.categ_public_id}}">
		<img>
		<p>{{categorie.categ_nom}}</p>
	</a>

</div>
