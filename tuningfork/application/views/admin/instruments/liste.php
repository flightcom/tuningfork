<button type="button" class="reset btn btn-default pull-right">RàZ filtres</button>
<h3><?php echo $title; ?></h3>

<br>

<table class="table table-bordered table-hover tablesorter">

	<thead>

		<tr class="">
			<th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Catégorie</th>
			<th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Type</th>
			<th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Marque</th>
			<th class="hidden-xs hidden-sm">Modèle</th>
			<th class="visible-lg">Numéro de série</th>
			<th>Code barre</th>
			<th class="col-xs-1 visible-lg">Date entrée</th>
			<th class="col-xs-1 visible-lg">Etat</th>
			<th class="filter-select filter-exact col-1" data-placeholder="Sélectionner">Disponibilité</th>
			<th class="filter-select filter-exact col-1 visible-lg" data-placeholder="Sélectionner">A vérifier</th>
		</tr>

	</thead>

	<tbody>
		<?php foreach ($instruments as $i){ ?>
		<tr onclick="location.href='/admin/instruments/<?php echo $i->instru_id; ?>'" style="cursor:pointer;">
		    <td><?php echo $i->categ_nom; ?></td>
		    <td><?php echo $i->type_nom; ?></td>
		    <td><?php echo $i->marque_nom; ?></td>
		    <td class="hidden-xs hidden-sm"><?php echo $i->instru_modele; ?></td>
		    <td class="visible-lg"><?php echo $i->instru_numero_serie; ?></td>
		    <td><?php echo $i->instru_code; ?></td>
		    <td class="visible-lg"><?php echo $i->instru_date_entree; ?></td>
		    <td class="td-etat visible-lg"><input style="font-size:20px;"  class="rating" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " value="<?php echo $i->instru_etat; ?>"></td>
		    <td class="td-dispo bg-<?php echo ($i->instru_dispo) ? 'green-soft' : 'red-soft'; ?>"><?php echo ($i->instru_dispo ? 'Oui' : 'Non'); ?><input type="hidden" value="<?php echo $i->instru_id; ?>"></td>
		    <td class="td-check visible-lg bg-<?php echo ($i->instru_a_verifier) ? 'red-soft' : 'green-soft'; ?>"><?php echo ($i->instru_a_verifier ? 'Oui' : 'Non'); ?><input type="hidden" value="<?php echo $i->instru_id; ?>"></td>
		</tr>
		<?php } ?>

	</tbody>

    <tfoot>

        <tr>
            <th colspan="10" class="ts-pager form-horizontal">
                <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i>
                </button>
                <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i>
                </button>	<span class="pagedisplay"></span> 
                <!-- this can be any element, including an input -->
                <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i>
                </button>
                <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i>
                </button>
                <select class="pagesize input-mini" title="Select page size">
                    <option selected="selected" value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                </select>
                <select class="pagenum input-mini" title="Select page number"></select>
            </th>
        </tr>

    </tfoot>

</table>


<script>

$(function(){

	// $('a.rating-clear, span.glyphicon.glyphicon-star').data('events').click.reverse();
	// $(document).delegate('a.rating-clear, span.glyphicon.glyphicon-star', 'click', function(event){

	// 	console.log('etat clicked');
	// 	var id = $(this).find('input[type=hidden]').val();
	// 	var etat = $(this).closest('td').find('.rating').val();
	// 	// changeEtat(id, etat);

	// });

	// $('.td-etat .rating-input').queue('click', queue);

	// Replace the queue
	// var queue = $('.td-etat .rating-input').queue('click');
	// $('.td-etat .rating-input').clearQueue('click');
	$('.td-etat .rating-input').bind('click', function(event){

		console.log('etat clicked');
		var id = $(this).find('input[type=hidden]').val();
		var etat = $(this).closest('td').find('.rating').val();
		changeEtat(id, etat);
		// event.stopPropagation();

	});

	// $('.td-etat .rating-input').queue('click', queue);


	$('.td-dispo').click( function(event){

		var id = $(this).find('input[type=hidden]').val();
		toggleDispo(id);
		event.stopPropagation();

	});
	
	$('.td-check').click( function(event){

		var id = $(this).find('input[type=hidden]').val();
		toggleCheck(id);
		event.stopPropagation();

	});
	
});

function toggleDispo(id) {

	$.ajax({
		url: '/admin/ajax/changeDispo/'+id,
		async: false,
		success: function(data){
			document.location.reload();
		}
	});

}

function changeEtat(id, etat) {

	$.ajax({
		url: '/admin/ajax/changeEtat/'+id + '/' + etat,
		async: false,
		success: function(data){
			document.location.reload();
		}
	});

}

function toggleCheck(id) {

	$.ajax({
		url: '/admin/ajax/changeCheck/'+id,
		async: false,
		success: function(data){
			document.location.reload();
		}
	});

}
</script>