<div class="pdl20 pdr20" ng-controller="AdminListArticlesCtrl">
	
	<h3><?php echo $title; ?></h3>

	<br>

	<table ng-table="tbParams" show-filter="true" class="table table-hover col-xs-12 table-list-articles">

	    <thead>
	        <tr>
	            <th ng-repeat="column in columns" ng-show="column.visible"
	                class="text-center sortable {{column.classes}}" 
	                ng-class="{
	                    'sort-asc': tbParams.isSortBy(column.field, 'asc'),
	                    'sort-desc': tbParams.isSortBy(column.field, 'desc')
	                  }"
	                ng-click="tbParams.sorting(column.field, tbParams.isSortBy(column.field, 'asc') ? 'desc' : 'asc')">
					<div ng-if="!template" ng-show="!template" class="ng-scope ng-binding">{{column.title}}</div>
	            </th>
	        </tr>

	        <tr class="ng-table-filters" ng-init="tbParams">
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

			<tr ng-repeat="article in filteredArticles" ng-click="go('/admin/blog/' + article.article_id)" style="cursor:pointer;" ng-class="article.article_published == '0' ? 'border-left-ko' : 'border-left-ok'">
	 		    <td ng-repeat="column in columns" data-title="column.title" ng-show="column.visible" sortable="column.field" ng-class="column.classes">{{article[column.field]}}</td>
			</tr>

		</tbody>

	</table>

</div>
