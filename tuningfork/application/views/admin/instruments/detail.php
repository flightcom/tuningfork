<h3><?php echo $instrument->categ_nom . " " . $instrument->marque_nom. " " . $instrument->instru_modele. " " . $instrument->instru_numero_serie; ?></h3>

<br>

<ul id="instru-actions-list" class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#infos" data-toggle="tab">Infos</a></li>
    <li><a href="#emprunts" data-toggle="tab">Emprunts</a></li>
</ul>

<div class="tab-content">

    <section id="infos" class="tab-pane fade in active">

        <?php echo form_open('admin/instruments/' . $instrument->instru_id . '/edit', array('id' =>'edit-instrument', 'class' => 'form-horizontal')); ?>

            <br>

        	<div class="form-group">
                <label for="categorie" class="control-label col-xs-1">Catégorie</label>
                <div class="col-xs-11">
                    <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo $instrument->categ_nom; ?>" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="type" class="control-label col-xs-1">Type</label>
                <div class="col-xs-11">
                    <input type="text" class="form-control" id="type" name="type" value="<?php echo $instrument->type_nom; ?>" readonly />
                </div>
            </div>

        	<div class="form-group">
                <label for="marque" class="control-label col-xs-1">Marque</label>
                <div class="col-xs-11">
                    <input type="text" class="form-control" id="marque" name="marque" value="<?php echo $instrument->marque_nom; ?>" readonly />
                </div>
            </div>

        	<div class="form-group">
                <label for="modele" class="control-label col-xs-1">Modèle</label>
                <div class="col-xs-11">
                    <input type="text" class="form-control" id="modele" name="modele" value="<?php echo $instrument->instru_modele; ?>" readonly />
                </div>
            </div>

        	<div class="form-group">
                <label for="code" class="control-label col-xs-1">Code</label>
                <div class="col-xs-11">
                    <input type="text" class="form-control editable" id="code" name="code" value="<?php echo $instrument->instru_code; ?>" readonly />
                </div>
            </div>

        	<div class="form-group">
                <label for="numero" class="control-label col-xs-1">Numéro de série</label>
                <div class="col-xs-11">
                    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $instrument->instru_numero_serie; ?>" readonly />
                </div>
            </div>

            <div class="form-group">
                <label for="etat" class="control-label col-xs-1">État</label>
                <div class="col-xs-11">
                    <input style="font-size:20px;"  class="rating editable" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " value="<?php echo $instrument->instru_etat; ?>" readonly />
                </div>
            </div>

        	<div class="form-group">
                <label for="date-entree" class="control-label col-xs-1">Date d'entrée</label>
                <div class="col-xs-11">
                    <input type="text" class="form-control" id="date-entree" name="date-entree" value="<?php echo $instrument->instru_date_entree; ?>" readonly />
                </div>
            </div>

        	<div class="form-group">
                <label for="dispo" class="control-label col-xs-1">Disponibilité</label>
                <div class="col-xs-10">
        			<div class="btn-group dropdown" name="dispo">
        				<button type="button" class="btn btn-default dropdown-toggle form-control editable" data-toggle="" readonly>
        					<span data-bind="label"><?php echo $instrument->instru_dispo ? 'Oui' : 'Non'; ?></span> <span class=""></span>
        				</button>
        				<ul class="dropdown-menu" role="menu">
        					<li data-value="1"><a href="#">Oui</a></li>
        					<li data-value="0"><a href="#">Non</a></li>
        				</ul>
        				<input type="hidden" name="dispo" value="0" />
        			</div>
                </div>
            </div>

            <br />

        	<div class="form-group">
                <label for="date-entree" class="control-label col-xs-1"></label>
                <div class="col-xs-11">
        			<button onclick="document.location.href='/admin/instruments/';return false;" class="btn btn-default no-edition">Retour</button>
        			<button onclick="editInstrument();return false;" class="btn btn-warning no-edition">Modifier</button>
                    <?php if ($instrument->instru_dispo && ! $instrument->instru_a_verifier) : ?><button onclick="preter();return false" class="btn btn-success no-edition">Prêter</button><?php endif; ?>
        			<button type="submit" class="btn btn-success edition hidden">Valider</button>
        			<button onclick="uneditInstrument();return false;" class="btn btn-default edition hidden">Annuler</button>
        			<button onclick="deleteInstrument(<?php echo $instrument->instru_id; ?>);return false;" class="btn btn-danger pull-right">Supprimer</button>
                </div>
            </div>

        </form>

    </section>

    <section id="emprunts" class="tab-pane fade in">

    <br>

    <?php if ( count($emprunts) > 0 ) : ?>

        <table class="table table-bordered table-hover tablesorter">

            <thead>

                <tr class="">
                    <th class="filter-exact" data-placeholder="Sélectionner">Nom</th>
                    <th class="filter-exact" data-placeholder="Sélectionner">Prénom</th>
                    <th class="filter-exact" data-placeholder="Sélectionner">Téléphone</th>
                    <th class="filter-exact" data-placeholder="Sélectionner">eMail</th>
                    <th class="">Date de prêt</th>
                    <th class="">Date de remise effective</th>
                </tr>

            </thead>
            <tbody>
            <?php foreach ($emprunts as $e){ ?>
                <tr onclick="location.href='/admin/instruments/<?php echo $i->instru_id; ?>'" style="cursor:pointer;">
                    <td><?php echo $e->membre_nom; ?></td>
                    <td><?php echo $e->membre_prenom; ?></td>
                    <td><?php echo $e->membre_tel; ?></td>
                    <td><?php echo $e->membre_email; ?></td>
                    <td class="visible-lg"><?php echo $e->emp_date_debut; ?></td>
                    <td class="visible-lg"><?php echo $e->emp_date_fin_effective; ?></td>
                </tr>
            <?php } ?>
            </tbody>

            <tfoot>

                <tr>
                    <th colspan="10" class="ts-pager form-horizontal">
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

    <?php else : ?>

        <p>Aucun emprunt</p>

    <?php endif; ?>

    </section>


</div>

<script>

$(function(){

    $('#instru-actions-list a').click(function (e) {
        if($(this).parent('li').hasClass('active')){
            $( $(this).attr('href') ).hide();
        }
        else {
            e.preventDefault();
            $(this).tab('show');
        }
    });

});

function editInstrument(){

	$('#edit-instrument .editable').removeAttr('readonly');
	$('button.editable').attr('data-toggle', 'dropdown').find('span:last-child').addClass('caret');
	$('.no-edition').addClass('hidden');
	$('.edition').removeClass('hidden');
}

function uneditInstrument(){

	$('#edit-instrument .editable').attr('readonly', '');
	$('button.editable').attr('data-toggle', '').find('span:last-child').removeClass('caret');
	$('.no-edition').removeClass('hidden');
	$('.edition').addClass('hidden');
}

function deleteInstrument(id)
{
    var r = confirm("Êtes-vous sûr de vouloir supprimer cet instrument ?");
    if (r) { location.href='/admin/instruments/' + id + '/delete' }
}

</script>