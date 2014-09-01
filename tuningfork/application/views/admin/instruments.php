<h3><?php echo $title; ?></h3>

<style scoped>

.glyphicon-star::before { color: #ffdb00; }

</style>

<div id="add" class="pull-right">
	
	<button onclick="document.location.href='/admin/instruments/add'" type="button" class="btn btn-primary">Ajouter un instrument</button>

</div>

<button type="button" class="reset btn btn-default">RàZ filtres</button>
<br />
<br />

<table class="table table-bordered table-hover tablesorter">

	<thead>

		<tr class="">
			<th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Catégorie</th>
			<th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Type</th>
			<th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Marque</th>
			<th class="hidden-xs hidden-sm">Modèle</th>
			<th class="hidden-xs">Numéro de série</th>
			<th>Code barre</th>
			<th class="col-xs-1 visible-lg">Date entrée</th>
			<th class="hidden-xs col-xs-1 visible-lg">Etat</th>
			<th class="filter-select filter-exact col-1" data-placeholder="Sélectionner">Disponibilité</th>
			<th class="filter-select filter-exact col-1" data-placeholder="Sélectionner">A vérifier</th>
		</tr>

	</thead>

	<tbody>
		<?php foreach ($instruments as $i){ ?>
		<tr onclick="location.href='/admin/instruments/<?php echo $i->instru_id; ?>'" style="cursor:pointer;">
		    <td><?php echo $i->categ_nom; ?></td>
		    <td><?php echo $i->type_nom; ?></td>
		    <td><?php echo $i->marque_nom; ?></td>
		    <td class="hidden-xs hidden-sm"><?php echo $i->instru_modele; ?></td>
		    <td class="hidden-xs"><?php echo $i->instru_numero_serie; ?></td>
		    <td><?php echo $i->instru_code; ?></td>
		    <td class="visible-lg"><?php echo $i->instru_date_entree; ?></td>
		    <!-- <td class="visible-lg"><input class="rating" data-max="5" data-min="1" id="some_id" name="your_awesome_parameter" type="number" data-empty-value="0" data-clearable=" " value="4" readonly /></td> -->
		    <!-- <td class="visible-lg"><i class='glyphicon glyphicon-star'></i><i class='glyphicon glyphicon-star'></i><i class='glyphicon glyphicon-star'></i><i class='glyphicon glyphicon-star-empty'></i><i class='glyphicon glyphicon-star-empty'></i></td> -->
		    <td class="visible-lg"><?php $n = 0; while ( $n++ < 5 ) : ?><i class='glyphicon glyphicon-star<?php echo ($i->instru_etat-- > 0) ? '' : '-empty'; ?>'></i><?php endwhile; ?></td>
		    <td class="bg-<?php echo ($i->instru_dispo) ? 'green-soft' : 'red-soft'; ?>"><?php echo ($i->instru_dispo ? 'Oui' : 'Non'); ?></td>
		    <td class="bg-<?php echo ($i->instru_a_verifier) ? 'red-soft' : 'green-soft'; ?>"><?php echo ($i->instru_a_verifier ? 'Oui' : 'Non'); ?></td>
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