<div ng-controller="AdminListCategCtrl">

<!-- <p>Categories Path : {{categoriesPath|json}}</p> -->
<!-- <p>Categories : {{categories|json}}</p> -->

<h3><?php echo $title; ?></h3>

<ul ng-repeat="level in categories" class="col-xs-12 list-inline list-categories" ondrop="$scope.dropcateg(event)" ondragover="allowDrop(event)">
	<li><span>[ Niveau {{$index+1}} ]</span></li>
	<li class="form-inline">
		<input ng-show="showNewCategField[$index]" class="form-control form-inline" type="text" placeholder="Nouvelle catégorie..." ng-model="newcateg_$index">
		<button ng-hide="showNewCategField[$index]" ng-click="showNewCategField[$index] = !showNewCategField[$index]" class="btn btn-primary glyphicon glyphicon-plus"></button>
		<button ng-show="showNewCategField[$index]" ng-click="addCateg(newcateg_$index, $index);" class="btn btn-success glyphicon glyphicon-ok"></button>
		<button ng-show="showNewCategField[$index]" ng-click="showNewCategField[$index] = !showNewCategField[$index]" class="btn btn-danger glyphicon glyphicon-remove"></button>
	</li>
	<li ng-hide="" ng-show></li>
	<li id="categ_{{categorie.categ_id}}" ng-repeat="categorie in level" draggable="true" ondragstart="drag(event)">
		<button class="btn" 
			ng-class="{'btn-default': categoriesPath.indexOf(categorie) == -1,
				'btn-primary': categoriesPath.indexOf(categorie) > -1}"
			ng-click="clickOnCategorie(categorie)"
			ng-dblclick="dblClickOnCategorie(categorie)">{{categorie.categ_nom}}</button>
	</li>
</ul>

</div>