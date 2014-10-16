<div ng-controller="AdminListCategCtrl">

<ul ng-repeat="level in categories" class="col-xs-12 list-inline">
	<li ng-repeat="categorie in level">
		<button class="btn" 
			ng-class="{'btn-default': categoriesPath.indexOf(categorie.categ_id) == -1,
				'btn-primary': categoriesPath.indexOf(categorie.categ_id) > -1}"
			ng-click="loadCategories(categorie.categ_id)">{{categorie.categ_nom}}</button>
	</li>
</ul>

</div>