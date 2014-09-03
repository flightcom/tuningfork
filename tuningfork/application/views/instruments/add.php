<?php echo validation_errors(); ?>
<?php echo form_open('admin/instruments/add', array('id' =>'add-instrument', 'class' => 'form-horizontal')); ?>
	<h3>Ajout d'un nouvel instrument</h3>

	<br />

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-1">Catégorie</label>
        <div class="col-xs-6">
			<div class="btn-group dropdown" name="categorie">
				<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
					<span data-bind="label">Sélectionnez</span> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<?php foreach($categories as $c){ ?>
					<li data-value="<?php echo $c->categ_id; ?>"><a href="#"><?php echo $c->categ_nom; ?></a></li>
					<?php } ?>
				</ul>
				<input type="hidden" name="categorie" value="" onchange="getInstruTypes(this.value);" />
			</div>
			<div id="add-categorie" style="display:inline-block;">
				<button onclick="addCategorie();return false;"class="btn btn-default">Ajouter une Catégorie</button>
			</div>
        </div>
        <div class="col-xs-8" id="select-type"></div>
    </div>

	<div class="form-group">
        <label for="marque" class="control-label col-xs-1">Marque</label>
        <div class="col-xs-10">
			<div class="btn-group dropdown" name="marque">
				<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
					<span data-bind="label">Sélectionnez</span> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<?php foreach($marques as $m){ ?>
					<li data-value="<?php echo $m->marque_id; ?>"><a href="#"><?php echo $m->marque_nom; ?></a></li>
					<?php } ?>
				</ul>
				<input type="hidden" name="marque" value="0" />
			</div>
			<div id="add-marque" style="display:inline-block;">
				<button onclick="addMarque();return false;"class="btn btn-default">Ajouter une marque</button>
			</div>
        </div>
    </div>

	<div class="form-group">
        <label for="modele" class="control-label col-xs-1">Modèle</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="modele" name="modele" placeholder="Modèle">
        </div>
    </div>

	<div class="form-group">
        <label for="code" class="control-label col-xs-1">Code</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="code" name="code" placeholder="Code">
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1">Numéro de série</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Numéro de série">
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1"></label>
        <div class="col-xs-10">
		    <button onclick="document.location.href='/admin/instruments/';return false;" class="btn btn-danger">Retour</button>
			<button type="submit" class="btn btn-success">Valider</button>
        </div>
    </div>

</form>

<script>

function addMarque(){

    $('#add-marque button').hide();
    $.ajax({
        type: 'GET', 
        url: '/admin/instruments/ajouter_marque',
        success: function(data){
            $('#add-marque').append(data);
        }
    });
}

function cancelAddMArque(){

    $('#add-marque form').remove();
    $('#add-marque button').show();
    return false;

}

function addCategorie(){

    $('#add-categorie button').hide();
    $.ajax({
        type: 'GET', 
        url: '/admin/instruments/ajouter_categorie',
        success: function(data){
            $('#add-categorie').append(data);
        }
    });
}

function cancelAddCategorie(){

    $('#add-categorie form').remove();
    $('#add-categorie button').show();
    return false;

}

function addType(categorie){

    $('#add-type button').hide();
    $.ajax({
        type: 'GET', 
        url: '/admin/instruments/ajouter_type/'+categorie,
        success: function(data){
            $('#add-type').append(data);
        }
    });
}

function cancelAddType(){

    $('#add-type form').remove();
    $('#add-type button').show();
    return false;

}

</script>