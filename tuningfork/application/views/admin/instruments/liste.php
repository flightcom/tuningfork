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

<table class="table table-bordered table-hover tablesorter col-xs-12">

	<thead>

		<tr class="">
			<th class="filter-select filter-onlyAvail" data-placeholder="Sélectionner">Catégorie</th>
			<th class="filter-select filter-onlyAvail" data-placeholder="Sélectionner">Type</th>
			<th class="filter-select filter-onlyAvail" data-placeholder="Sélectionner">Marque</th>
			<th class="hidden-xs hidden-sm">Modèle</th>
			<th class="hidden" data-col="serial">Numéro de série</th>
			<th>Code barre</th>
			<th class="col-xs-1 hidden" data-col="date">Date entrée</th>
			<th class="filter-select filter-onlyAvail" data-placeholder="Sélectionner">Etat</th>
			<th class="filter-select" data-placeholder="Sélectionner">Disponible</th>
			<th class="filter-select hidden" data-col="check" data-placeholder="Sélectionner">A vérifier</th>
		</tr>

	</thead>

	<tbody>
		<?php foreach ($instruments as $i){ ?>
		<tr onclick="location.href='/admin/instruments/<?php echo $i->instru_id; ?>'" style="cursor:pointer;">
		    <td><?php echo $i->categ_nom; ?></td>
		    <td><?php echo $i->type_nom; ?></td>
		    <td><?php echo $i->marque_nom; ?></td>
		    <td class="hidden-xs hidden-sm"><?php echo $i->instru_modele; ?></td>
		    <td class="hidden" data-col="serial"><?php echo $i->instru_numero_serie; ?></td>
		    <td><?php echo $i->instru_code; ?></td>
		    <td class="hidden" data-col="date"><?php echo $i->instru_date_entree; ?></td>
		    <td class="td-etat"><span class="hidden"><?php echo $i->instru_etat; ?></span><input style="font-size:20px;"  class="rating" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " data-instruid="<?php echo $i->instru_id; ?>" value="<?php echo $i->instru_etat; ?>"></td>
		    <td class="td-dispo bg-<?php echo ($i->instru_dispo) ? 'green-soft' : 'red-soft'; ?>"><span><?php echo ($i->instru_dispo ? 'Oui' : 'Non'); ?></span><input type="hidden" value="<?php echo $i->instru_id; ?>"></td>
		    <td class="td-check hidden bg-<?php echo ($i->instru_a_verifier) ? 'red-soft' : 'green-soft'; ?>" data-col="check" ><span><?php echo ($i->instru_a_verifier ? 'Oui' : 'Non'); ?></span><input type="hidden" value="<?php echo $i->instru_id; ?>"></td>
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

	$('.td-dispo').click( function(event){

		var id = $(this).find('input[type=hidden]').val();
		toggle('changeDispo', id, this);
		event.stopPropagation();

	});
	
	$('.td-check').click( function(event){

		var id = $(this).find('input[type=hidden]').val();
		toggle('changeCheck', id, this);
		event.stopPropagation();

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