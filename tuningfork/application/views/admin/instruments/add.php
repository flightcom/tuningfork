<form action='/admin/instruments/add' method='post' id='newinstrument' name='newinstrument' class='form-horizontal' ng-controller='AddInstrumentCtrl' novalidate>

	<h3>Ajout d'un nouvel instrument</h3>

	<br>

    <pre>
        {{instru}}
    </pre>

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-1">Catégorie</label>
        <div class="col-xs-2">
            <select class="form-control" name="categorie" ng-init="instru.categ_id='<?php echo set_value('categorie');?>'" ng-model="instru.categ_id">
            <!-- <select class="form-control" name="categorie" ng-model="instru.categ_id"> -->
            <!-- <select class="form-control" name="categorie"> -->
                <option value="">Sélectionnez</option>
                <?php foreach($categories as $c){ ?>
                <!-- <option value="<?php echo $c->categ_id; ?>" ng-selected="'<?php echo $c->categ_id; ?>' == '<?php echo set_value('categorie'); ?>'"><?php echo $c->categ_nom; ?></option> -->
                <option value="<?php echo $c->categ_id; ?>"><?php echo $c->categ_nom; ?></option>
                <?php } ?>
            </select>
            <span class="helper-block text-danger" ng-show="!instru.categ_id"><?php echo form_error('categorie'); ?></span>
        </div>
        <div style="display:inline-block;">
            <button ng-click="addcateg = !addcateg" ng-show="!addcateg" class="btn btn-primary" onclick="return false;">Ajouter une Catégorie</button>
            <div class='navbar-form hidden' ng-class="{hidden : !addcateg}" style='width:400px;margin-top:0;margin-bottom:0;'>

                <div class="form-group">
                    <input name="nom-categorie" type="text" class="form-control" placeholder="Catégorie" ng-model="newcateg">
                </div>

                <button type="button" class="btn btn-danger" ng-click="addcateg = !addcateg" style="margin-left:15px;">Annuler</button>
                <button type="button" class="btn btn-primary" ng-click="addCateg()" >Valider</button>

            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="type" class="control-label col-xs-1">Type</label>
        <div class="col-xs-2">
            <select class="form-control" name="type-select" ng-options="type.type_id as type.type_nom for type in types" ng-init="instru.type_id='<?php echo set_value('type'); ?>'" ng-model="instru.type_id"></select>
            <input type="hidden" name="type" value="{{instru.type_id}}">
            <span class="helper-block text-danger" ng-show="!instru.type_id"><?php echo form_error('type'); ?></span>
        </div>
        <div id="add-type" style="display:inline-block;">
            <button  class="btn btn-primary" ng-click="addtype = !addtype" ng-show="!addtype" onclick="return false;">Ajouter un type</button>
            <div class='navbar-form hidden' ng-class="{hidden : !addtype}" style='width:400px;margin-top:0;margin-bottom:0;'>

                <div class="form-group">
                    <input name="nom-type" type="text" class="form-control" placeholder="Type">
                </div>

                <button type="button" class="btn btn-danger" ng-click="addtype = !addtype" style="margin-left:15px;">Annuler</button>
                <button type="submit" class="btn btn-primary">Valider</button>

            </div>
        </div>
    </div>

	<div class="form-group">
        <label for="marque" class="control-label col-xs-1">Marque</label>
        <div class="col-xs-2">
            <select class="form-control" name="marque" ng-init="instru.marque_id='<?php echo set_value('marque'); ?>'" ng-model="instru.marque_id">
                <option value="">Sélectionnez</option>
                <?php foreach($marques as $m){ ?>
                <option value="<?php echo $m->marque_id; ?>"><?php echo $m->marque_nom; ?></option>
                <?php } ?>
            </select>
            <span class="helper-block text-danger" ><?php echo form_error('marque'); ?></span>
        </div>
        <div style="display:inline-block;">
            <button ng-click="addmarque = !addmarque" ng-show="!addmarque" class="btn btn-primary" onclick="return false;">Ajouter une marque</button>
            <div class='navbar-form hidden' ng-class="{hidden : !addmarque}" style='width:400px;margin-top:0;margin-bottom:0;'>

                <div class="form-group">
                    <input name="nom-marque" type="text" class="form-control" placeholder="Marque">
                </div>

                <button type="button" class="btn btn-danger" ng-click="addmarque = !addmarque" style="margin-left:15px;">Annuler</button>
                <button type="submit" class="btn btn-primary">Valider</button>

            </div>
        </div>
    </div>

	<div class="form-group">
        <label for="modele" class="control-label col-xs-1">Modèle</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="modele" name="modele" placeholder="Modèle" ng-model="instru.instru_modele" ng-init="instru.instru_modele='<?php echo set_value('modele'); ?>'" required>
            <span class="helper-block text-danger" ng-show="newinstrument.modele.$invalid"><?php echo form_error('modele'); ?></span>
        </div>
    </div>

	<div class="form-group">
        <label for="code" class="control-label col-xs-1">Code</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="code" name="code" pattern="^[0-9]+$" placeholder="Code" ng-model="instru.instru_code" ng-init="instru.instru_code='<?php echo set_value('code'); ?>'" required>
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
