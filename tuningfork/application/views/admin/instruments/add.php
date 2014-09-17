<?php echo form_open('admin/instruments/add', array('id' =>'add-instrument', 'name' => 'newinstrument', 'class' => 'form-horizontal', 'ng-controller' => 'AddInstrumentCtrl', 'ng-submit' => 'newinstrument.$valid && submit()')); ?>
	<h3>Ajout d'un nouvel instrument</h3>

	<br>

    <pre>{{instru}}</pre>

    <pre>{{result}}</pre>

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-1">Catégorie</label>
        <div class="col-xs-2">
            <select class="form-control" name="categorie" ng-model="instru.categ_id" ng-change="changeCateg()">
                <option value="">Sélectionnez</li>
                <?php foreach($categories as $c){ ?>
                <option value="<?php echo $c->categ_id; ?>"><?php echo $c->categ_nom; ?></li>
                <?php } ?>
            </select>
            <span class="helper-block">{{result.errors.categorie}}</span>
        </div>
        <div id="add-categorie" style="display:inline-block;">
            <button onclick="addCategorie();return false;"class="btn btn-primary">Ajouter une Catégorie</button>
        </div>
    </div>

    <div class="form-group hidden" ng-class="{hidden : !instru.categ_id}">
        <label for="type" class="control-label col-xs-1">Type</label>
        <div class="col-xs-2">
            <select class="form-control" name="type" ng-model="instru.type_id">
                <option value="">Sélectionnez</li>
                <option ng-repeat="type in types" value="{{type.type_id}}">{{type.type_nom}}</option>
            </select>
            <span class="helper-block"></span>
        </div>
        <div id="add-type" style="display:inline-block;">
            <button onclick="addType($(this).parent('form').find('[name=categorie]').val());return false;" class="btn btn-primary">Ajouter un type</button>
        </div>
    </div>

	<div class="form-group">
        <label for="marque" class="control-label col-xs-1">Marque</label>
        <div class="col-xs-2">
            <select class="form-control" name="type" ng-model="instru.marque_id">
                <option value="">Sélectionnez</li>
                <?php foreach($marques as $m){ ?>
                <option value="<?php echo $m->marque_id; ?>"><?php echo $m->marque_nom; ?></option>
                <?php } ?>
            </select>
            <span class="helper-block"></span>
        </div>
        <div id="add-marque" style="display:inline-block;">
            <button onclick="addMarque();return false;"class="btn btn-primary">Ajouter une marque</button>
        </div>
    </div>

	<div class="form-group">
        <label for="modele" class="control-label col-xs-1">Modèle</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="modele" name="modele" placeholder="Modèle" ng-model="instru.instru_modele" >
            <span class="helper-block"></span>
        </div>
    </div>

	<div class="form-group">
        <label for="code" class="control-label col-xs-1">Code</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="code" name="code" placeholder="Code" ng-model="instru.code" >
            <span class="helper-block"></span>
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1">Numéro de série</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Numéro de série" ng-model="instru.instru_numero">
            <span class="helper-block"></span>
        </div>
    </div>

    <div class="form-group">
        <label for="etat" class="control-label col-xs-1">État</label>
        <div class="col-xs-11">
            <input style="font-size:20px;" ng-model="instru.instru_etat" class="rating" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " value="">
            <span class="helper-block"></span>
        </div>
    </div>

    <div class="form-group">
        <label for="dispo" class="control-label col-xs-1">Disponibilité</label>
        <div class="col-xs-10">
            <select class="form-control" name="dispo" ng-model="instru.instru_dispo">
                <option value="">Sélectionnez...</li>
                <option value="0">Non</li>
                <option value="1">Oui</li>
            </select>
            <span class="helper-block"></span>
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1"></label>
        <div class="col-xs-10">
		    <button onclick="document.location.href='/admin/instruments/';return false;" class="btn btn-danger">Retour</button>
			<button type"submit" class="btn btn-success">Valider</button>
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

function cancelAddMarque(){

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

// function getInstruTypes(categ_id){

//     $.ajax({
//         type: 'GET', 
//         url: '/admin/instruments/selectionner_type/'+categ_id,
//         success: function(data){
//             $('#list-types').html(data);
//             $('#list-types').closest('.form-group').removeClass('hidden');
//         }
//     });

// }

</script>