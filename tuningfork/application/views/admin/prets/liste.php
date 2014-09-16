<h3><?php echo $title; ?></h3>

<br>

<table class="table table-bordered table-striped tablesorter">

    <thead>

        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Catégorie</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Date emprunt</th>
            <th>Date de remise prévue</th>
        </tr>

    </thead>

    <tbody>

        <?php foreach ($emprunts as $e){ ?>
        <tr onclick="location.href='/admin/prets/<?php echo $e->emp_id; ?>'" style="cursor:pointer;">
            <td><?php echo $e->membre_nom; ?></td>
            <td><?php echo $e->membre_prenom; ?></td>
            <td><?php echo $e->membre_tel; ?></td>
            <td><?php echo $e->membre_email; ?></td>
            <td><?php echo $e->categ_nom; ?></td>
            <td><?php echo $e->marque_nom; ?></td>
            <td><?php echo $e->instru_modele; ?></td>
            <td><?php echo $e->emp_date_debut; ?></td>
            <td><?php echo $e->emp_date_fin_prevue; ?></td>
        </tr>
        <?php } ?>

    </tbody>

    <tfoot>

        <tr>
            <th colspan="11" class="ts-pager form-horizontal">
                <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i>
                </button>
                <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i>
                </button>   <span class="pagedisplay"></span> 
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