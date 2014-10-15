<div ng-controller="AdminListInstruCtrl">
	
	<div class="btn-group pull-right">
		<div class="btn-group">
			<button type="button" class="btn dropdown-toggle" 
				ng-class="{'btn-primary': tiParams.filter().instru_etat !== undefined, 'btn-default': tiParams.filter().instru_etat === undefined}" 
				data-toggle="dropdown">État <span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li ng-click="toggleEtat(0)" ng-class="{active : tiParams.filter().instru_etat.indexOf(0) > -1}"><a href="#">Très mauvais</a></li>
				<li ng-click="toggleEtat(1)" ng-class="{active : tiParams.filter().instru_etat.indexOf(1) > -1}"><a href="#">Mauvais</a></li>
				<li ng-click="toggleEtat(2)" ng-class="{active : tiParams.filter().instru_etat.indexOf(2) > -1}"><a href="#">Moyen</a></li>
				<li ng-click="toggleEtat(3)" ng-class="{active : tiParams.filter().instru_etat.indexOf(3) > -1}"><a href="#">Bon</a></li>
				<li ng-click="toggleEtat(4)" ng-class="{active : tiParams.filter().instru_etat.indexOf(4) > -1}"><a href="#">Très bon</a></li>
				<li ng-click="toggleEtat(5)" ng-class="{active : tiParams.filter().instru_etat.indexOf(5) > -1}"><a href="#">Comme neuf</a></li>
			</ul>
		</div>
		<div class="btn-group">
			<button type="button" class="btn dropdown-toggle"
				ng-class="{'btn-primary': tiParams.filter().instru_dispo !== undefined, 'btn-default': tiParams.filter().instru_dispo === undefined}" 
				data-toggle="dropdown">Disponibilité <span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
				<li ng-click="toggleDispo(1)" ng-class="{active : tiParams.filter().instru_dispo.indexOf(1) > -1}"><a href="#">Oui</a></li>
				<li ng-click="toggleDispo(0)" ng-class="{active : tiParams.filter().instru_dispo.indexOf(0) > -1}"><a href="#">Non</a></li>
			</ul>
		</div>
		<button ng-click="tiParams.filter({}).sorting({})" class="btn btn-danger">RàZ</button>
	</div>

	<h3><b><?php echo $title; ?></b></h3>

	<br>

	<table ng-table="tiParams" show-filter="true" class="table table-hover col-xs-12 table-list-instru">

        <thead>
	        <tr>
	            <th ng-repeat="column in columns" ng-show="column.visible"
	                class="text-center sortable {{column.classes}}" 
	                ng-class="{
	                    'sort-asc': tiParams.isSortBy(column.field, 'asc'),
	                    'sort-desc': tiParams.isSortBy(column.field, 'desc')
	                  }"
	                ng-click="tiParams.sorting(column.field, tiParams.isSortBy(column.field, 'asc') ? 'desc' : 'asc')">
	                {{column.title}}
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