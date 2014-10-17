<div ng-controller="AdminListCategCtrl">

<!-- <p>Categories Path : {{categoriesPath|json}}</p> -->
<!-- <p>Categories : {{categories|json}}</p> -->

<ul ng-repeat="level in categories" class="col-xs-12 list-inline list-categories">
	<li><span>[ Niveau {{$index+1}} ]</span></li>
	<li class="form-inline">
		<input ng-show="showNewCategField" class="form-control form-inline" type="text" placeholder="Nouvelle catégorie..." ng-model="newcateg">
		<button ng-hide="showNewCategField" ng-click="showNewCategField = !showNewCategField" class="btn btn-primary glyphicon glyphicon-plus"></button>
		<button ng-show="showNewCategField" ng-click="addCateg($index);" class="btn btn-success glyphicon glyphicon-ok"></button>
		<button ng-show="showNewCategField" ng-click="showNewCategField = !showNewCategField" class="btn btn-danger glyphicon glyphicon-remove"></button>
	</li>
	<li ng-hide="" ng-show></li>
	<li ng-repeat="categorie in level">
		<button class="btn" 
			ng-class="{'btn-default': categoriesPath.indexOf(categorie) == -1,
				'btn-primary': categoriesPath.indexOf(categorie) > -1}"
			ng-click="clickOnCategorie(categorie)">{{categorie.categ_nom}}</button>
	</li>
</ul>

</div>