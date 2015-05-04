<div class="pdl20 pdr20" ng-controller="AdminListMembresCtrl" ng-init="membres=<?php echo htmlspecialchars(json_encode($membres)); ?>" ng-cloak>

	<div class="btn-group pull-right">
		<button ng-click="tmParams.filter({}).sorting({})" class="btn btn-danger">RàZ</button>
	</div>

	<h3><?php echo $title; ?><br><small>{{membres.length}} résultats</small></h3>

	<br>

	<table ng-table="tmParams" show-filter="true" class="table table-hover col-xs-12 table-list-bordered">

	    <thead>
	        <tr>
	            <th ng-repeat="column in columns" ng-show="column.visible"
	                class="text-center sortable {{column.classes}}" 
	                ng-class="{
	                    'sort-asc': tmParams.isSortBy(column.field, 'asc'),
	                    'sort-desc': tmParams.isSortBy(column.field, 'desc')
	                  }"
	                ng-click="tmParams.sorting(column.field, tmParams.isSortBy(column.field, 'asc') ? 'desc' : 'asc')">
					<div ng-if="!template" ng-show="!template" class="ng-scope ng-binding">{{column.title}}</div>
	            </th>
	        </tr>

	        <tr class="ng-table-filters" ng-init="tmParams">
	            <th ng-repeat="column in columns" ng-show="column.visible" class="filter">
	                <div ng-repeat="(name, filter) in column.filter">
	                    <div ng-if="!column.filterTemplateURL" ng-show="!column.filterTemplateURL">
	                        <div ng-include="'ng-table/filters/' + filter + '.html'"></div>
	                    </div>
	                </div>
	            </th>
	        </tr>

	    </thead>

	    <tbody>

			<tr ng-repeat="membre in filteredMembres" ng-click="go('/admin/membres/' + membre.membre_id)" style="cursor:pointer;" ng-class="membre.membre_is_adherent == '0' ? 'border-left-ko' : 'border-left-ok'">
	 		    <td ng-repeat="column in columns" data-title="column.title" ng-show="column.visible" sortable="column.field" ng-class="column.classes">{{membre[column.field]}}</td>
			</tr>

		</tbody>

	</table>

</div>