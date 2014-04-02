<h3><?php echo $title; ?></h3>

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
			<th>Modèle</th>
			<th>Numéro de série</th>
			<th>Code barre</th>
			<th class="col-xs-1">Date entrée</th>
			<th class="filter-select filter-exact col-xs-1" data-placeholder="Sélectionner">Disponibilité</th>
			<th class="filter-select filter-exact col-xs-1" data-placeholder="Sélectionner">A vérifier</th>
		</tr>

	</thead>

	<tbody>
		<?php foreach ($instruments as $i){ ?>
		<tr onclick="location.href='/admin/instruments/<?php echo $i->instru_id; ?>'" style="cursor:pointer;">
		    <td><?php echo $i->categ_nom; ?></td>
		    <td><?php echo $i->type_nom; ?></td>
		    <td><?php echo $i->marque_nom; ?></td>
		    <td><?php echo $i->instru_modele; ?></td>
		    <td><?php echo $i->instru_numero_serie; ?></td>
		    <td><?php echo $i->instru_code; ?></td>
		    <td><?php echo $i->instru_date_entree; ?></td>
		    <td class="bg-<?php echo ($i->instru_dispo ? 'green-soft' : 'red-soft'); ?>"><?php echo ($i->instru_dispo ? 'Oui' : 'Non'); ?></td>
		    <td class="bg-<?php echo ($i->instru_a_verifier ? 'red-soft' : 'green-soft'); ?>"><?php echo ($i->instru_a_verifier ? 'Oui' : 'Non'); ?></td>
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

