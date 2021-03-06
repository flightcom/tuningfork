<?php echo validation_errors(); ?>

<form ng-action='/admin/instruments/add' id='newinstrument' name='newinstrument' class='form-horizontal col-xs-12' novalidate>

    <br>

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-1">Catégorie</label>
        <div class="col-xs-2 has-feedback" ng-class="{'has-success' : newinstrument.selectcategorie.$valid, 'has-error': newinstrument.selectcategorie.$invalid && newinstrument.selectcategorie.$dirty}">
            <select class="form-control" name="selectcategorie" required ng-options="categ as categ.categ_nom for categ in categories" ng-init="instru.categ_id='<?php echo set_value('categorie');?>'" ng-model="categorie">
                <option value="">Sélectionnez ...</option>
            </select>
            <input type="hidden" name="categorie" value="{{instru.categpath[0].categ_id}}" required>
            <span ng-show="newinstrument.selectcategorie.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newinstrument.selectcategorie.$invalid && newinstrument.selectcategorie.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="helper-block text-danger" ng-show="!instru.categ_id"><?php echo form_error('categorie'); ?></span>
        </div>
        <div style="display:inline-block;">
            <button ng-click="addcateg = !addcateg" ng-show="!addcateg" class="btn btn-primary" onclick="return false;"><span class="glyphicon glyphicon-plus"></span></button>
            <div class='navbar-form hidden' ng-class="{hidden : !addcateg}" style='width:400px;margin-top:0;margin-bottom:0;'>

                <div class="form-group">
                    <input name="nomcategorie" type="text" class="form-control" placeholder="Nouvelle catégorie" ng-model="newcateg" ng-focus-on="addcateg">
                </div>

                <button type="button" class="btn btn-primary" ng-click="addCateg()" style="margin-left:15px;">Valider</button>
                <button type="button" class="btn btn-danger" ng-click="addcateg = !addcateg">Annuler</button>
            </div>
            <span class="helper-block text-danger hidden" ng-class="{ hidden : !results.errors.newcateg}">{{results.errors.newcateg}}</span>
        </div>
        <button onclick="return false;" class="btn btn-default path" ng-repeat="categ in instru.categpath | reverse" ng-click="removeCateg(categ);">{{categ.categ_nom}}</button>
    </div>

	<div class="form-group">
        <label for="marque" class="control-label col-xs-1">Marque</label>
        <div class="col-xs-2 has-feedback" ng-class="{'has-success' : newinstrument.selectmarque.$valid, 'has-error': newinstrument.selectmarque.$invalid && newinstrument.selectmarque.$dirty}">
            <select class="form-control" name="selectmarque" required ng-options="marque.marque_id as marque.marque_nom for marque in marques" ng-init="instru.marque_id='<?php echo set_value('marque'); ?>'" ng-model="instru.marque_id">
                <option value="">Sélectionnez ...</option>
            </select>
            <input type="hidden" name="marque" required value="{{instru.marque_id}}">
            <span ng-show="newinstrument.selectmarque.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newinstrument.selectmarque.$invalid && newinstrument.selectmarque.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="helper-block text-danger" ng-show="!instru.marque_id"><?php echo form_error('marque'); ?></span>
        </div>
        <div style="display:inline-block;">
            <button ng-click="addmarque = !addmarque" ng-show="!addmarque" class="btn btn-primary" onclick="return false;"><span class="glyphicon glyphicon-plus"></span></button>
            <div class='navbar-form hidden' ng-class="{hidden : !addmarque}" style='width:400px;margin-top:0;margin-bottom:0;'>

                <div class="form-group">
                    <input name="newmarque" type="text" class="form-control" placeholder="Nouvelle marque" ng-model="newmarque" ng-focus-on="addmarque">
                </div>

                <button type="button" class="btn btn-primary" ng-click="addMarque()" style="margin-left:15px;">Valider</button>
                <button type="button" class="btn btn-danger" ng-click="addmarque = !addmarque">Annuler</button>
            </div>
            <span class="helper-block text-danger hidden" ng-class="{ hidden : !results.errors.newmarque}">{{results.errors.newmarque}}</span>
        </div>
    </div>

	<div class="form-group">
        <label for="modele" class="control-label col-xs-1">Modèle</label>
        <div class="col-xs-10 has-feedback" ng-class="{'has-success' : newinstrument.modele.$valid, 'has-error': newinstrument.modele.$invalid && newinstrument.modele.$dirty}">
            <input type="text" class="form-control" id="modele" name="modele" placeholder="Modèle" ng-model="instru.instru_modele" ng-init="instru.instru_modele='<?php echo set_value('modele'); ?>'" required>
            <span ng-show="newinstrument.modele.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newinstrument.modele.$invalid && newinstrument.modele.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="helper-block text-danger" ng-show="newinstrument.modele.$invalid"><?php echo form_error('modele'); ?></span>
        </div>
    </div>

<!-- 	<div class="form-group">
        <label for="code" class="control-label col-xs-1">Code</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="code" name="code" pattern="^[0-9]+$" placeholder="Code" ng-model="instru.instru_code" ng-init="instru.instru_code='<?php echo set_value('code'); ?>'" required>
            <span class="helper-block text-danger" ng-show="newinstrument.code.$invalid"><?php echo form_error('code'); ?></span>
        </div>
        <button type="button" class="btn btn-primary" ng-click="generateCode();" ng-show="!instru.code">Génerer</button>
        <button type="button" class="btn btn-primary" ng-click="imprimerCode()" ng-show="instru.code">Imprimer</button>
    </div>
 -->
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
            <select class="form-control" name="dispo" ng-init="instru.instru_dispo='1'" ng-model="instru.instru_dispo">
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
