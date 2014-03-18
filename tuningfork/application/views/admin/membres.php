<h3><?php echo $title; ?></h3>

<button type="button" class="reset btn btn-default">RàZ filtres</button>
<br />
<br />
	
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