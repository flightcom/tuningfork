<?php echo validation_errors(); ?>
      
<form method="post" action="/admin/membres/create" name='newaccount' class='form-horizontal col-xs-12' autocomplete='off' novalidate>

    <div class="form-group">
        <label for="genre">Civilité</label>
        <div class="col-xs-12 col-md-10 has-feedback" ng-class="{'has-success' : newaccount.genre.$valid, 'has-error': newaccount.genre.$invalid && newaccount.genre.$dirty}">
            <?php $i = 0; foreach ( $genres = Membre_model::get_genders() as $g) { ?>
            <div>
                <label for="genre-<?php echo $i; ?>" class="radio control-label col-xs-1">
                    <input type="radio" class="" id="genre-<?php echo $i; ?>" name="genre" value="<?php echo $g; ?>" required ng-model="membre.genre"><?php echo $g; ?>
                </label>                
            </div>
            <?php $i++; } ?>
            <span ng-show="newaccount.genre.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.genre.$invalid && newaccount.genre.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="helper-block text-danger col-md-block-2" ng-show="newaccount.genre.$invalid"><?php echo form_error('genre'); ?></span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 has-feedback" ng-class="{'has-success' : newaccount.nom.$valid, 'has-error': newaccount.nom.$invalid && newaccount.nom.$dirty}">
            <input type="text" class="form-control" name="nom" placeholder="Nom" ng-pattern="/^[^0-9]{2,}$/" required ng-model="membre.nom" ng-init="membre.nom='<?php echo set_value('nom'); ?>'">
            <span class="helper-block text-danger" ng-show="newaccount.nom.$invalid"><?php echo form_error('nom'); ?></span>
            <span ng-show="newaccount.nom.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.nom.$invalid && newaccount.nom.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>                
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 has-feedback" ng-class="{'has-success' : newaccount.prenom.$valid, 'has-error': newaccount.prenom.$invalid && newaccount.prenom.$dirty}">
            <input type="text" class="form-control" name="prenom" placeholder="Prénom" ng-pattern="/^[^0-9]{2,}$/" required ng-model="membre.prenom" ng-minlength="3" ng-init="membre.prenom='<?php echo set_value('prenom'); ?>'">
            <span class="helper-block text-danger" ng-show="newaccount.prenom.$invalid"><?php echo form_error('prenom'); ?></span>
            <span ng-show="newaccount.prenom.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.prenom.$invalid && newaccount.prenom.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
        </div>
    </div>



    <div class="form-group">
        <!-- <label for="email" class="control-label col-md-2">Adresse Mail</label> -->
        <div class="col-xs-12 has-feedback" ng-class="{'has-success' : newaccount.email.$valid, 'has-error': newaccount.email.$invalid && newaccount.email.$dirty && !newaccount.email.$pristine}">
            <input type="email" class="form-control" name="email" placeholder="Email" required ng-model="membre.email" ng-init="membre.email='<?php echo set_value('email'); ?>'">
            <span class="helper-block text-danger" ng-show="newaccount.email.$invalid"><?php echo form_error('email'); ?></span>
            <span ng-show="newaccount.email.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.email.$invalid && newaccount.email.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="tel" class="control-label col-md-2">Téléphone</label> -->
        <div class="col-xs-12 has-feedback" ng-class="{'has-success' : newaccount.tel.$valid, 'has-error': newaccount.tel.$invalid && newaccount.tel.$dirty}">
            <input type="tel" class="form-control" name="tel" placeholder="Téléphone" ng-pattern="/^0\d{9}$/" required ng-model="membre.tel" ng-init="membre.tel='<?php echo set_value('tel'); ?>'">
            <span class="helper-block text-danger" ng-show="newaccount.tel.$invalid"><?php echo form_error('tel'); ?></span>
            <span ng-show="newaccount.tel.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.tel.$invalid && newaccount.tel.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="dob" class="control-label col-md-2">Date de naissance</label> -->
        <div class="col-xs-12 has-feedback" ng-class="{'has-success' : newaccount.dob.$valid, 'has-error': newaccount.dob.$invalid && newaccount.dob.$dirty}">
            <input type="date" class="form-control" id="dob" name="dob" placeholder="Date de naissance " required ng-model="membre.dob" ng-init="membre.dob='<?php echo set_value('dob'); ?>'">
            <span class="helper-block text-danger" ng-show="newaccount.dob.$invalid"><?php echo form_error('dob'); ?></span>
            <span ng-show="newaccount.dob.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.dob.$invalid && newaccount.dob.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="tel" class="control-label col-md-2 col-xs-12 pull-left">Adresse</label> -->
        <div class="col-xs-6 has-feedback" ng-class="{'has-success' : newaccount.adresse.$valid, 'has-error': newaccount.adresse.$invalid && newaccount.adresse.$dirty}">
            <input type="text" class="form-control" name="adr_voie" placeholder="Adresse" required ng-model="membre.adresse" ng-init="membre.adresse='<?php echo set_value('adresse'); ?>'">
            <span class="helper-block text-danger" ng-show="newaccount.adresse.$invalid"><?php echo form_error('adresse'); ?></span>
            <span ng-show="newaccount.adresse.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.adresse.$invalid && newaccount.adresse.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
        </div>
        <div class="col-xs-2">
            <input type="text" class="form-control" name="cp" autocomplete="off" placeholder="Code Postal" pattern="^\d{5}$" ng-model="membre.ville_code_postal" ng-init="membre.ville_code_postal='<?php echo set_value('cp'); ?>'">
        </div>
        <div class="col-xs-4 has-feedback" ng-class="{'has-success' : newaccount.selectville.$valid, 'has-error': newaccount.selectville.$invalid}">
            <select class="form-control" name="selectville" placeholder="Ville" ng-options="ville.ville_id as ville.ville_nom for ville in villes" ng-init="membre.ville_id='<?php echo set_value('ville'); ?>'" required ng-model="membre.ville_id"></select>
            <input type="hidden" name="ville" value="{{membre.ville_id}}" required>
            <span class="helper-block text-danger" ng-show="newaccount.ville.$invalid"><?php echo form_error('ville'); ?></span>
            <span ng-show="newaccount.selectville.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.selectville.$invalid" class="glyphicon glyphicon-remove form-control-feedback"></span>
        </div>

        <input type="hidden" id="pays" name="pays" value="1">

    </div>

    <div class="form-group">
        <!-- <label for="passwd" class="control-label col-md-2">Mot de passe</label> -->
        <div class="col-xs-12 has-feedback" ng-class="{'has-success' : newaccount.passwd.$valid, 'has-error': newaccount.passwd.$invalid && newaccount.passwd.$dirty && !newaccount.passwd.$pristine}">
            <input type="password" class="form-control" name="passwd" autocomplete="off" placeholder="Entrez un mot de passe" ng-pattern="/^(.){6,}$/" required ng-model="membre.passwd" ng-init="membre.passwd='<?php echo set_value('passwd'); ?>'">
            <span class="helper-block text-danger" ng-show="newaccount.passwd.$invalid"><?php echo form_error('passwd'); ?></span>
            <span ng-show="newaccount.passwd.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.passwd.$invalid && newaccount.passwd.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="passwd-conf" class="control-label col-md-2">Confirmation</label> -->
        <div class="col-xs-12 has-feedback" ng-class="{'has-success' : newaccount.passwdconf.$valid, 'has-error': newaccount.passwdconf.$invalid && newaccount.passwdconf.$dirty && !newaccount.passwdconf.$pristine}">
            <input type="password" class="form-control" name="passwdconf" autocomplete="off" placeholder="Confirmez le mot de passe" ng-pattern="/^(.){6,}$/" required ng-model="membre.passwdconf" ng-init="membre.passwdconf='<?php echo set_value('passwdconf'); ?>'">
            <span class="helper-block text-danger" ng-show="newaccount.passwdconf.$invalid"><?php echo form_error('passwdconf'); ?></span>
            <span ng-show="newaccount.passwdconf.$valid" class="glyphicon glyphicon-ok form-control-feedback"></span>
            <span ng-show="newaccount.passwdconf.$invalid && newaccount.passwdconf.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <button type="submit" ng-submit="newaccount.setSubmitted();" class="col-xs-12 btn btn-success">Valider</button>
        </div>
    </div>

</form>
