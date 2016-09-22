<h3><?php echo $title; ?></h3>

<?php if ( !empty($membres) ) : ?>

<h4>Membres</h4>

<table class="table table-bordered table-striped tablesorter">

	<thead>

		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Téléphone</th>
			<th>Email</th>
			<th>Adresse</th>
			<th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Ville</th>
		</tr>

	</thead>

	<tbody>

		<?php foreach ($membres as $m){ ?>
		<tr onclick="location.href='/admin/membres/<?php echo $m->membre_id; ?>'" style="cursor:pointer;">
		    <td><?php echo $m->membre_nom; ?></td>
		    <td><?php echo $m->membre_prenom; ?></td>
		    <td><?php echo $m->membre_tel; ?></td>
		    <td><?php echo $m->membre_email; ?></td>
		    <td><?php echo Membre_model::format_address($m); ?></td>
		    <td><?php echo $m->ville_nom; ?></td>
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

<?php endif; ?>

<?php if ( !empty($instruments) ) : ?>

<h4>Instruments</h4>
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
		    <td class="td-etat visible-lg"><input style="font-size:20px;"  class="rating" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " data-instruid="<?php echo $i->instru_id; ?>" value="<?php echo $i->instru_etat; ?>"></td>
		    <td class="td-dispo bg-<?php echo ($i->instru_dispo) ? 'green-soft' : 'red-soft'; ?>"><?php echo ($i->instru_dispo ? 'Oui' : 'Non'); ?><input type="hidden" value="<?php echo $i->instru_id; ?>"></td>
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

<?php endif; ?>
