<?php echo validation_errors(); $i = 0; ?>

<h3 class="center">Création de mon compte</h3>

<br>

<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        
    <?php echo form_open('compte/creation', array('id' =>'create-account', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>

        <div class="form-group ">
            <label for="genre" class="control-label col-md-2">Genre</label>
            <div class="col-md-5">
                <?php foreach ( $genres = Membre_model::get_genders() as $g) { ?>
                <div class="col-xs-1">
                    <label for="genre-<?php echo $i; ?>" class="radio control-label col-xs-1">
                        <input type="radio" class="" id="genre-<?php echo $i; ?>" name="genre" value="<?php echo $g; ?>" required /><?php echo $g; ?>
                    </label>                
                </div>
                <?php $i++; } ?>
            </div>
        </div>

        <div class="form-group has-feedback">
            <label for="nom" class="control-label col-md-2">Nom</label>
            <div class="col-xs-12 col-md-10">
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" pattern="^[^0-9]{2,}$" required>
                <span class="glyphicon glyphicon-ok form-control-feedback"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="prenom" class="control-label col-md-2">Prénom</label>
            <div class="col-xs-12 col-md-10">
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" pattern="^[^0-9]{2,}$" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="control-label col-md-2">Adresse Mail</label>
            <div class="col-xs-12 col-md-10">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required>
            </div>
        </div>

        <div class="form-group">
            <label for="tel" class="control-label col-md-2">Téléphone</label>
            <div class="col-xs-12 col-md-10">
                <input type="tel" class="form-control" id="tel" name="tel" placeholder="Téléphone" pattern="^0\d{9}$" required>
            </div>
        </div>

        <div class="form-group">
            <label for="dob" class="control-label col-md-2">Date de naissance</label>
            <div class="col-xs-12 col-md-10">
                <input type="date" class="form-control" id="dob" name="dob" placeholder="Date de naissance" pattern="^\d{1,2}/\d{1,2}/\d{4}$">
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
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" required>
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" id="cp" name="cp" autocomplete="off" placeholder="Code Postal" pattern="^\d{5}$" required>
            </div>
            <div class="col-xs-3">
                <select class="form-control" id="ville" name="ville" placeholder="Ville">
                    <?php echo $cities; ?>
                </select>
            </div>

            <input type="hidden" id="pays" name="pays" value="1">

        </div>

        <div class="form-group">
            <label for="passwd" class="control-label col-md-2">Mot de passe</label>
            <div class="col-xs-12 col-md-10">
                <input type="password" class="form-control" id="passwd" name="passwd" autocomplete="off" placeholder="Entrez un mot de passe" pattern="^(.*){8,}$" required>
            </div>
        </div>

        <div class="form-group">
            <label for="passwd-conf" class="control-label col-md-2">Confirmation</label>
            <div class="col-xs-12 col-md-10">
                <input type="password" class="form-control" id="passwd-conf" name="passwd-conf" autocomplete="off" placeholder="Confirmez le mot de passe" pattern="^(.*){6,}$" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-10 col-md-offset-2">
                <button type="submit" class="col-xs-12 btn btn-success">Valider</button>
            </div>
        </div>

    <?php echo form_close(); ?>

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

    document.getElementById("passwd").onchange = validatePassword;
    document.getElementById("passwd-conf").onchange = validatePassword;

});

function validatePassword(){ 

    if (document.getElementById('passwd-conf').value != document.getElementById('passwd').value) {
        document.getElementById('passwd-conf').setCustomValidity('Les mots de passe doivent correspondre');
    } else {
        document.getElementById('passwd-conf').setCustomValidity('');
    }

}

</script>