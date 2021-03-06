<div class="col-xs-12 pdt-20">

	<span class="glyphicon glyphicon-trash fs24 pull-right" ondrop="deletecateg(event)" ondragover="allowDrop(event)"></span>

	<ul ng-repeat="level in categories" class="list-inline" ondrop="dropcateg(event)" ondragover="allowDrop(event)">
		<li><span>[ Niveau {{$index}} ]</span></li>
		<li ng-hide="" ng-show></li>
		<li id="categ_{{categorie.categ_id}}" ng-repeat="categorie in level" draggable="true" ondragstart="drag(event)">
			<button class="btn" 
				ng-class="{'btn-default': categoriesPath.indexOf(categorie) == -1,
					'btn-success': categoriesPath.indexOf(categorie) > -1}"
				ng-click="clickOnCategorie(categorie)"
				ng-dblclick="dblClickOnCategorie(categorie)">{{categorie.categ_nom}}</button>
		</li>
		<li class="form-inline">
			<input ng-show="showNewCategField[$index]" class="form-control form-inline" type="text" placeholder="Nouvelle catégorie..." ng-model="newcateg_$index">
			<button ng-hide="showNewCategField[$index]" ng-click="showNewCategField[$index] = !showNewCategField[$index]" class="btn btn-primary glyphicon glyphicon-plus"></button>
			<button ng-show="showNewCategField[$index]" ng-click="addCateg(newcateg_$index, $index);" class="btn btn-success glyphicon glyphicon-ok"></button>
			<button ng-show="showNewCategField[$index]" ng-click="showNewCategField[$index] = !showNewCategField[$index]" class="btn btn-danger glyphicon glyphicon-remove"></button>
		</li>
	</ul>

</div>