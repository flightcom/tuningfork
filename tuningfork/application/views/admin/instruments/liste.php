<button type="button" class="reset btn btn-default pull-right">RàZ filtres</button>

<div class="btn-group pull-right" style="margin-right:10px;">
	<button type="button" class="btn btn-default">Afficher</button>
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		<span class="caret"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<ul class="dropdown-menu" role="show">
		<li><a href="#" data-col="date">Date entrée</a></li>
		<li><a href="#" data-col="check">A vérifier</a></li>
		<li><a href="#" data-col="serial">Numéro de série</a></li>
	</ul>
</div>

<h3><?php echo $title; ?></h3>

<br>

<table ng-table="tableInstruments" show-filter="true" class="table table-hover col-xs-12" ng-controller="AdminListInstruCtrl">

<!-- 	<?php foreach ($instruments as $i){ ?>
	<tr onclick="location.href='/admin/instruments/<?php echo $i->instru_id; ?>'" style="cursor:pointer;">
	    <td data-title="'Identifiant'" filter="{ 'categ_id': 'text' }"><?php echo $i->instru_code; ?></td>
	    <td data-title="'Catégorie'" filter="{ 'categ_nom': 'select' }"><?php echo $i->categ_nom; ?></td>
	    <td data-title="'Chemin'" filter="{ 'categ_pathpublic': 'text' }"><?php echo $i->categ_pathpublic; ?></td>
	    <td data-title="'Marque'" filter="{ 'marque_nom': 'select' }"><?php echo $i->marque_nom; ?></td>
	    <td data-title="'Modèle'" filter="{ 'instru_modele': 'text' }" class="hidden-xs hidden-sm"><?php echo $i->instru_modele; ?></td>
	    <td data-title="'Numéro de série'" filter="{ 'instru_numero': 'text' }" class="hidden" data-col="serial"><?php echo $i->instru_numero_serie; ?></td>
	    <td data-title="'Date d\'entrée'" filter="{ 'instru_date_entree': 'text' }" class="hidden" data-col="date"><?php echo $i->instru_date_entree; ?></td>
	    <td data-title="'État'" filter="{ 'instru_etat': 'select' }" class="td-etat"><span class="hidden"><?php echo $i->instru_etat; ?></span><input style="font-size:20px;"  class="rating" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " data-instruid="<?php echo $i->instru_id; ?>" value="<?php echo $i->instru_etat; ?>"></td>
	    <td data-title="'Disponibilité'" filter="{ 'instru_dispo': 'select' }" class="td-dispo bg-<?php echo ($i->instru_dispo) ? 'green-soft' : 'red-soft'; ?>"><span><?php echo ($i->instru_dispo ? 'Oui' : 'Non'); ?></span><input type="hidden" value="<?php echo $i->instru_id; ?>"></td>
	    <td data-title="'À vérifier'" filter="{ 'instru_a_verifier': 'select' }" class="td-check hidden bg-<?php echo ($i->instru_a_verifier) ? 'red-soft' : 'green-soft'; ?>" data-col="check" ><span><?php echo ($i->instru_a_verifier ? 'Oui' : 'Non'); ?></span><input type="hidden" value="<?php echo $i->instru_id; ?>"></td>
	</tr>
	<?php } ?>
 -->
	<tr ng-repeat="instrument in instruments" ng-click="location.href='/admin/instruments/{{instrument.instru_id}}'" style="cursor:pointer;">
	    <td data-title="'Identifiant'" filter="{ 'categ_id': 'text' }">{{instrument.instru_id}}</td>
	    <td data-title="'Catégorie'" filter="{ 'categ_nom': 'select' }">{{instrument.categ_nom}}</td>
	    <td data-title="'Chemin'" filter="{ 'categ_pathpublic': 'text' }">{{instrument.categ_pathpublic}}</td>
	    <td data-title="'Marque'" filter="{ 'marque_nom': 'select' }">{{instrument.marque_nom}}</td>
	    <td data-title="'Modèle'" filter="{ 'instru_modele': 'text' }" class="hidden-xs hidden-sm">{{instrument.instru_modele}}</td>
	    <td xng-col-hidden="true" data-title="'Numéro de série'" filter="{ 'instru_numero': 'text' }" class="hidden" data-col="serial">{{instrument.instru_numero_serie}}</td>
	    <td xng-col-hidden="true" data-title="'Date d\'entrée'" filter="{ 'instru_date_entree': 'text' }" class="hidden" data-col="date">{{instrument.instru_date_entree}}</td>
	    <td data-title="'État'" filter="{ 'instru_etat': 'select' }" class="td-etat"><span class="hidden">{{instrument.instru_etat}}</span><input style="font-size:20px;"  class="rating" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " data-instruid="{{instrument.instru_id}}" value="{{instrument.instru_etat}}"></td>
	    <td data-title="'Disponibilité'" filter="{ 'instru_dispo': 'select' }" class="td-dispo bg-{ instrument.instru_dispo ? 'green-soft' : 'red-soft' }"><span>{{ instrument.instru_dispo ? 'Oui' : 'Non' }}</span><input type="hidden" value="{{instrument.instru_id}}"></td>
	    <td xng-col-hidden="true" data-title="'À vérifier'" filter="{ 'instru_a_verifier': 'select' }" class="td-check hidden bg-{ instrument.instru_a_verifier ? 'green-soft' : 'red-soft' }" data-col="check" ><span>{ instrument.instru_a_verifier ? 'Oui' : 'Non' }</span><input type="hidden" value="{{instrument.instru_id}}"></td>
	</tr>

</table>


<script>

$(function(){

	$('ul[role="show"] li a').on('click', function(){
		var col = $(this).data('col');
		console.log(col);
		$('table').find('[data-col="'+col+'"]').toggleClass('hidden');
		$(this).closest('li').toggleClass('active');
		$('.tablesorter').trigger('filterInit');
	});

	$(document).on('usercall', function(event, element){

		var id = $(element).siblings('.rating').data('instruid');
		var etat = $(element).hasClass('rating-clear') ? 0 : $(element).parent().find('.glyphicon-star').size();
		changeEtat(id, etat);

	});

	// $('.td-dispo').click( function(event){

	// 	var id = $(this).find('input[type=hidden]').val();
	// 	toggle('changeDispo', id, this);
	// 	event.stopPropagation();

	// });
	
	// $('.td-check').click( function(event){

	// 	var id = $(this).find('input[type=hidden]').val();
	// 	toggle('changeCheck', id, this);
	// 	event.stopPropagation();

	// });
	
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