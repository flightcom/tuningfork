<div ng-controller="AdminListInstruCtrl" ng-cloak ng-init="instruments=<?php echo htmlspecialchars(json_encode($instruments)); ?>">

	<table ng-table="tiParams" show-filter="true" class="table table-hover col-xs-12 table-list-bordered nopadding">

        <thead>
	        <tr>
	            <th ng-repeat="column in columns" ng-show="column.visible"
	                class="text-center sortable {{column.classes}}" 
	                ng-class="{
	                    'sort-asc': tiParams.isSortBy(column.field, 'asc'),
	                    'sort-desc': tiParams.isSortBy(column.field, 'desc')
	                  }"
	                ng-click="tiParams.sorting(column.field, tiParams.isSortBy(column.field, 'asc') ? 'desc' : 'asc')">
					<div ng-if="!template" ng-show="!template" class="ng-scope ng-binding">{{column.title}}</div>
	            </th>
	        </tr>

	        <tr class="ng-table-filters" ng-init="tiParams">
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

			<tr ng-repeat="instrument in filteredInstruments" ng-click="go('/admin/instruments/' + instrument.instru_id)" style="cursor:pointer;" class="border-state border-state-{{instrument.instru_etat}}" ng-class="instrument.instru_dispo =='1' ? 'border-left-ok' : 'border-left-ko'">
	 		    <td ng-repeat="column in columns" data-title="column.title" ng-show="column.visible" sortable="column.field" ng-class="column.classes">{{instrument[column.field]}}</td>
			</tr>

		</tbody>

	</table>

</div>



<script>

$(function(){

	$('.dropdown-menu li').click(function(e) {
	    e.stopPropagation();
	});

	$(document).on('usercall', function(event, element){

		var id = $(element).siblings('.rating').data('instruid');
		var etat = $(element).hasClass('rating-clear') ? 0 : $(element).parent().find('.glyphicon-star').size();
		changeEtat(id, etat);

	});
	
});

function changeEtat(id, etat) {

	$.ajax({
		url: '/admin/ajax/changeEtat/'+id + '/' + etat,
		async: false,
		success: function(data){
		}
	});

}

function toggle(fonction, id, elem) {

	$.ajax({
		url: '/admin/ajax/'+fonction+'/'+id,
		async: false,
		success: function(data){
			var text = data == 1 ? 'Oui' : 'Non';
			var newclass = $(elem).hasClass('bg-green-soft') ? 'bg-red-soft' : 'bg-green-soft';
			$(elem).find('span').html(text).parent().removeClass('bg-green-soft bg-red-soft').addClass(newclass);
		}
	});

}
</script>