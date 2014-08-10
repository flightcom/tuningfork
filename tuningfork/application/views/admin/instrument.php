<?php echo form_open('admin/instruments/edit/' . $instrument->instru_id, array('id' =>'edit-instrument', 'class' => 'form-horizontal')); ?>
	<h4><?php echo $title; ?></h4>

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
			<button type="submit" class="btn btn-success edition hidden">Valider</button>
			<button onclick="uneditInstrument();return false;" class="btn btn-default edition hidden">Annuler</button>
			<button onclick="deleteInstrument(<?php echo $instrument->instru_id; ?>);return false;" class="btn btn-danger pull-right">Supprimer</button>
        </div>
    </div>

</form>

<script>

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
    if (r) { location.href='/admin/instruments/delete/' + id }
}

</script>