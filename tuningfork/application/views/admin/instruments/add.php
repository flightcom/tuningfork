<?php echo validation_errors(); ?>
<?php echo form_open('admin/instruments/add', array('id' =>'add-instrument', 'class' => 'form-horizontal', 'ng-controller' => 'AddInstrumentCtrl')); ?>
	<h3>Ajout d'un nouvel instrument</h3>

	<br />

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-1">Catégorie</label>
        <div class="col-xs-11">
			<div class="btn-group dropdown" name="categorie">
				<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
					<span data-bind="label">Sélectionnez</span> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<?php foreach($categories as $c){ ?>
					<li ng-model="categ" ng-click="changeCateg(<?php echo $c->categ_id; ?>)"><a href="#"><?php echo $c->categ_nom; ?></a></li>
					<?php } ?>
				</ul>
                <input type="hidden" name="categorie" value="{{instru.categ}}" ng-model="instru.categ_id" required />
			</div>
			<div id="add-categorie" style="display:inline-block;">
				<button onclick="addCategorie();return false;"class="btn btn-primary">Ajouter une Catégorie</button>
			</div>
        </div>
    </div>

    <div class="form-group " ng-class="{hidden : !instru.categ}">
        <label for="type" class="control-label col-xs-1">Type</label>
        <div>
            <div class="col-xs-6">
                <div class="btn-group dropdown" name="type">
                    <button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
                        <span data-bind="label">{{instru.type.type_nom}}</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" id="list-types">
                        <li ng-repeat="type in types" ng-click="changeType($index)">
                            <a href="#">{{type.type_nom}}</a>
                        </li>
                    </ul>
                    <input type="hidden" name="type" value="0" ng-model="instru.type_id">
                </div>
                <div id="add-type" style="display:inline-block;">
                    <button onclick="addType($(this).parent('form').find('[name=categorie]').val());return false;" class="btn btn-primary">Ajouter un type</button>
                </div>
            </div>
        </div>
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
				<input type="hidden" name="marque" value="0" required ng-model="instru.marque">
			</div>
			<div id="add-marque" style="display:inline-block;">
				<button onclick="addMarque();return false;"class="btn btn-primary">Ajouter une marque</button>
			</div>
        </div>
    </div>

	<div class="form-group">
        <label for="modele" class="control-label col-xs-1">Modèle</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="modele" name="modele" placeholder="Modèle" ng-model="instru.modele" required>
        </div>
    </div>

	<div class="form-group">
        <label for="code" class="control-label col-xs-1">Code</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="code" name="code" placeholder="Code" ng-model="instru.code" required>
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1">Numéro de série</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="numero" name="numero" ng-model="instru.numero" placeholder="Numéro de série" >
        </div>
    </div>

    <div class="form-group">
        <label for="etat" class="control-label col-xs-1">État</label>
        <div class="col-xs-11">
            <input style="font-size:20px;"  class="rating editable" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " value="" ng-model="instru.etat">
        </div>
    </div>

    <div class="form-group">
        <label for="dispo" class="control-label col-xs-1">Disponibilité</label>
        <div class="col-xs-10">
            <div class="btn-group dropdown" name="dispo">
                <button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
                    <span data-bind="label">Oui</span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li data-value="1"><a href="#">Oui</a></li>
                    <li data-value="0"><a href="#">Non</a></li>
                </ul>
                <input type="hidden" name="dispo" value="1" ng-model="instru.dispo">
            </div>
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

function getInstruTypes(categ_id){

    $.ajax({
        type: 'GET', 
        url: '/admin/instruments/selectionner_type/'+categ_id,
        success: function(data){
            $('#list-types').html(data);
            $('#list-types').closest('.form-group').removeClass('hidden');
        }
    });

}

</script>