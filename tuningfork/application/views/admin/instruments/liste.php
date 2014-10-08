<button ng-click="tableInstrumentsParams.filter({})" class="btn btn-default pull-right">RàZ filtres</button>
<button ng-click="tableInstrumentsParams.sorting({})" class="btn btn-default pull-right" style="margin-right:10px;">RàZ tri</button>

<div class="btn-group pull-right" style="margin-right:10px;">
	<button type="button" class="btn btn-default">Afficher</button>
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		<span class="caret"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<ul class="dropdown-menu" role="show">
		<li ng-class="{active: showcol.dateEntree}"><a href="#" ng-click="showcol.dateEntree = !showcol.dateEntree">Date entrée</a></li>
		<li ng-class="{active: showcol.aVerifier}"><a href="#" ng-click="showcol.aVerifier = !showcol.aVerifier">A vérifier</a></li>
		<li ng-class="{active: showcol.numeroSerie}"><a href="#" ng-click="showcol.numeroSerie = !showcol.numeroSerie">Numéro de série</a></li>
	</ul>
</div>

<h3><b><?php echo $title; ?></b></h3>

<br>

<table ng-show="showTable" ng-table="tableInstrumentsParams" show-filter="true" class="table table-hover col-xs-12 table-list-instru" ng-controller="AdminListInstruCtrl">

	<tr ng-repeat="instrument in filteredInstruments" ng-click="go('/admin/instruments/{{instrument.instru_id}}')" style="cursor:pointer;" ng-class="instrument.instru_dispo ? 'border-left-ok' : 'border-left-ko'">
	    <td class="col-xs-1" data-title="'Identifiant'" filter="{ 'categ_id': 'text' }" sortable="'instru_id'">{{instrument.instru_id}}</td>
	    <td class="col-xs-2" data-title="'Catégorie'" filter="{ 'categ_nom': 'select' }" sortable="'categ_nom'" filter-data="getMarques()">{{instrument.categ_nom}}</td>
	    <!-- <td class="col-xs-1" data-title="'Chemin'">{{instrument.categ_pathpublic}}</td> -->
	    <td class="col-xs-2" data-title="'Marque'" filter="{ 'marque_nom': 'select' }">{{instrument.marque_nom}}</td>
	    <td data-title="'Modèle'" filter="{ 'instru_modele': 'text' }" class="col-xs-2 hidden-xs hidden-sm">{{instrument.instru_modele}}</td>
	    <!-- <td ng-show="showcol.numeroSerie" data-title="'Numéro de série'" filter="{ 'instru_numero_serie': 'text' }" class="col-xs-1">{{instrument.instru_numero_serie}}</td> -->
	    <!-- <td ng-show="showcol.dateEntree" data-title="'Date d\'entrée'" filter="{ 'instru_date_entree': 'text' }" class="col-xs-2" sortable="'instru_date_entree'">{{instrument.instru_date_entree}}</td> -->
	    <td data-title="'Numéro de série'" filter="{ 'instru_numero_serie': 'text' }" class="col-xs-1">{{instrument.instru_numero_serie}}</td>
	    <td data-title="'Date d\'entrée'" filter="{ 'instru_date_entree': 'text' }" class="col-xs-2" sortable="'instru_date_entree'">{{instrument.instru_date_entree}}</td>
	    <td data-title="'État'" filter="{ 'instru_etat': 'select' }" class="col-xs-1 td-etat"><span class="hidden">{{instrument.instru_etat}}</span><input style="font-size:20px;"  class="rating" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " data-instruid="{{instrument.instru_id}}" value="{{instrument.instru_etat}}"></td>
	    <!-- <td data-title="'Disponibilité'" filter="{ 'instru_dispo': 'select' }" class="col-xs-1 td-dispo" ng-class="{ 'bg-green-soft': instrument.instru_dispo, 'bg-red-soft': !instrument.instru_dispo }"><input type="hidden" value="{{instrument.instru_id}}"></td> -->
	    <!-- <td ng-show="showcol.aVerifier" data-title="'À vérifier'" filter="{ 'instru_a_verifier': 'select' }" class="col-xs-1 td-check" ng-class="{ 'bg-green-soft': instrument.instru_a_verifier, 'bg-red-soft': !instrument.instru_a_verifier }"><input type="hidden" value="{{instrument.instru_id}}"></td> -->
	    <!-- <td data-title="'À vérifier'" filter="{ 'instru_a_verifier': 'select' }" class="col-xs-1 td-check" ng-class="{ 'bg-green-soft': instrument.instru_a_verifier, 'bg-red-soft': !instrument.instru_a_verifier }"><input type="hidden" value="{{instrument.instru_id}}"></td> -->
	</tr>

</table>

<script>

$(function(){

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