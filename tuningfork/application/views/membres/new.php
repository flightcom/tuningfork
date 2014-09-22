<h3 class="center">Création de mon compte</h3>

<br>

<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        
    <form method="post" action="/membres/create" id='create-account' class='form-horizontal' autocomplete='off' novalidate ng-controller='AddMembreCtrl'>

        <div class="form-group ">
            <label for="genre" class="control-label col-md-2">Genre</label>
            <div class="col-md-5">
                <?php $i = 0; foreach ( $genres = Membre_model::get_genders() as $g) { ?>
                <div>
                    <label for="genre-<?php echo $i; ?>" class="radio control-label col-xs-1">
                        <input type="radio" class="" id="genre-<?php echo $i; ?>" name="genre" value="<?php echo $g; ?>" required ng-model="membre.genre"><?php echo $g; ?>
                    </label>                
                </div>
                <?php $i++; } ?>
            </div>
        </div>

        <div class="form-group has-feedback">
            <label for="nom" class="control-label col-md-2">Nom</label>
            <div class="col-xs-12 col-md-10">
                <input type="text" class="form-control" name="nom" placeholder="Nom" pattern="^[^0-9]{2,}$" required ng-model="membre.nom">
                <span class="helper-block text-danger" ng-show="membre.nom.$invalid"><?php echo form_error('nom'); ?></span>
            </div>
        </div>

        <div class="form-group">
            <label for="prenom" class="control-label col-md-2">Prénom</label>
            <div class="col-xs-12 col-md-10">
                <input type="text" class="form-control" name="prenom" placeholder="Prénom" pattern="^[^0-9]{2,}$" required ng-model="membre.prenom">
                <span class="helper-block text-danger"><?php echo form_error('prenom'); ?></span>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="control-label col-md-2">Adresse Mail</label>
            <div class="col-xs-12 col-md-10">
                <input type="text" class="form-control" name="email" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required ng-model="membre.email">
                <span class="helper-block text-danger"><?php echo form_error('email'); ?></span>
            </div>
        </div>

        <div class="form-group">
            <label for="tel" class="control-label col-md-2">Téléphone</label>
            <div class="col-xs-12 col-md-10">
                <input type="tel" class="form-control" name="tel" placeholder="Téléphone" pattern="^0\d{9}$" required ng-model="membre.tel">
            </div>
        </div>

        <div class="form-group">
            <label for="dob" class="control-label col-md-2">Date de naissance</label>
            <div class="col-xs-12 col-md-10">
                <input type="date" class="form-control" id="dob" name="dob" placeholder="Date de naissance" pattern="^\d{1,2}/\d{1,2}/\d{4}$" required ng-model="membre.dob">
            </div>
        </div>

        <div class="form-group">
            <label for="tel" class="control-label col-xs-2">Adresse</label>
    <!--          <div class="col-xs-2">
                <select class="form-control" id="adr-type-voie" name="adr-type-voie" placeholder="Voie">
                    <option value>Sélectionnez...</option>
                    <?php foreach ( $types_voie = Adresse_model::get_voies() as $v) { ?>
                    <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                    <?php } ?>
                </select>
            </div>
     -->        <div class="col-xs-5">
                <input type="text" class="form-control" name="adresse" placeholder="Adresse" required ng-model="membre.adr.voie">
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="cp" autocomplete="off" placeholder="Code Postal" pattern="^\d{5}$" required ng-model="membre.ville_code_postal">
            </div>
            <div class="col-xs-3">
                <select class="form-control" name="ville-select" placeholder="Ville" ng-options="ville.ville_id as ville.ville_nom for ville in villes" ng-init="membre.ville_id='<?php echo set_value('ville'); ?>'" ng-model="membre.ville_id"></select>
                <input type="hidden" name="ville" value="{{membre.ville_id}}">
            </div>

            <input type="hidden" id="pays" name="pays" value="1">

        </div>

        <div class="form-group">
            <label for="passwd" class="control-label col-md-2">Mot de passe</label>
            <div class="col-xs-12 col-md-10">
                <input type="password" class="form-control" name="passwd" autocomplete="off" placeholder="Entrez un mot de passe" pattern="^(.*){8,}$" required ng-model="membre.passwd">
            </div>
        </div>

        <div class="form-group">
            <label for="passwd-conf" class="control-label col-md-2">Confirmation</label>
            <div class="col-xs-12 col-md-10">
                <input type="password" class="form-control" name="passwd-conf" autocomplete="off" placeholder="Confirmez le mot de passe" pattern="^(.*){6,}$" required ng-model="membre.passwdconf">
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-10 col-md-offset-2">
                <button type="submit" class="col-xs-12 btn btn-success">Valider</button>
            </div>
        </div>

    </form>

</div>

<script>

$(function(){

    $('form input:valid').on('input', function(){
        console.log($(this).val());
    });

    $('#adr-cp').on('keyup', function(e){

        var $this = $(this);

        if ( $this.val().length < 5 ) { return; }

        $.ajax({
            url: '/ajax/getcities/'+ $this.val(),
            async: false,
            success: function(data){
                console.log(data);
                $('#adr-ville').html(data);
            }
        });

        return false;

    });

});

</script>