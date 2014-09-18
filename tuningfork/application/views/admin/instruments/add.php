<form action='/admin/instruments/add' method='post' id='newinstrument' name='newinstrument' class='form-horizontal' ng-controller='AddInstrumentCtrl' novalidate>

	<h3>Ajout d'un nouvel instrument</h3>

	<br>

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-1">Catégorie</label>
        <div class="col-xs-2">
            <select class="form-control" name="categorie" ng-model="instru.categ_id" ng-change="changeCateg()">
                <option value="">Sélectionnez</li>
                <?php foreach($categories as $c){ ?>
                <option value="<?php echo $c->categ_id; ?>" <?php echo set_value('categorie') == $c->categ_id ? 'selected' : ''; ?>><?php echo $c->categ_nom; ?></li>
                <?php } ?>
            </select>
            <span class="helper-block text-danger" ng-show="!instru.categ_id"><?php echo form_error('categorie'); ?></span>
        </div>
        <div id="add-categorie" style="display:inline-block;">
            <button onclick="addCategorie();return false;"class="btn btn-primary">Ajouter une Catégorie</button>
        </div>
    </div>

    <div class="form-group hidden" ng-class="{hidden : !instru.categ_id}">
        <label for="type" class="control-label col-xs-1">Type</label>
        <div class="col-xs-2">
            <select class="form-control" name="type" value="<?php echo set_value('type'); ?>" ng-model="instru.type_id">
                <option value="">Sélectionnez</li>
                <option ng-repeat="type in types" value="{{type.type_id}}">{{type.type_nom}}</option>
            </select>
            <span class="helper-block text-danger" ng-show="!instru.type_id"><?php echo form_error('type'); ?></span>
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
            <span class="helper-block text-danger" ><?php echo form_error('marque'); ?></span>
        </div>
        <div id="add-marque" style="display:inline-block;">
            <button onclick="addMarque();return false;"class="btn btn-primary">Ajouter une marque</button>
        </div>
    </div>

	<div class="form-group">
        <label for="modele" class="control-label col-xs-1">Modèle</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="modele" name="modele" placeholder="Modèle" ng-model="instru.instru_modele" >
            <span class="helper-block text-danger" ng-show="newinstrument.type.$invalid"><?php echo form_error('modele'); ?></span>
        </div>
    </div>

	<div class="form-group">
        <label for="code" class="control-label col-xs-1">Code</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="code" name="code" pattern="^[0-9]{5,}$" placeholder="Code" ng-model="instru.instru_code" required>
            <!-- <span class="helper-block text-danger" ng-show="code.$invalid"><?php echo form_error('code'); ?></span> -->
            <span class="helper-block text-danger" ng-show="newinstrument.code.$invalid"><?php echo form_error('code'); ?></span>
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1">Numéro de série</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Numéro de série" ng-model="instru.instru_numero">
        </div>
    </div>

    <div class="form-group">
        <label for="etat" class="control-label col-xs-1">État</label>
        <div class="col-xs-11">
            <input style="font-size:20px;" ng-model="instru.instru_etat" class="rating" data-max="5" data-min="1" id="etat" name="etat" type="number" data-empty-value="0" data-clearable=" " value="">
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
            <span class="helper-block text-danger" ng-show="result.errors.dispo && !instru.instru_dispo"><?php echo form_error('dispo'); ?></span>
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1"></label>
        <div class="col-xs-10">
		    <button onclick="document.location.href='/admin/instruments/';return false;" class="btn btn-danger">Retour</button>
			<button role="submit" class="btn btn-success">Valider</button>
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

</script>