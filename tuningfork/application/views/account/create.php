<?php echo validation_errors(); $i = 0; ?>

<?php echo form_open('account/create', array('id' =>'create-account', 'class' => 'form-horizontal')); ?>
	<h3 class="center">Création de mon compte</h3>

	<br>

    <div class="form-group center">
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

	<div class="form-group">
        <label for="nom" class="control-label col-md-2">Nom</label>
        <div class="col-xs-12 col-md-10">
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required />
        </div>
    </div>

	<div class="form-group">
        <label for="prenom" class="control-label col-md-2">Prénom</label>
        <div class="col-xs-12 col-md-10">
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required />
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="control-label col-md-2">Adresse Mail</label>
        <div class="col-xs-12 col-md-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
        </div>
    </div>

    <div class="form-group">
        <label for="tel" class="control-label col-md-2">Téléphone</label>
        <div class="col-xs-12 col-md-10">
            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Téléphone" pattern="^0\d{9}$" required />
        </div>
    </div>

    <div class="form-group">
        <label for="dob" class="control-label col-md-2">Date de naissance</label>
        <div class="col-xs-12 col-md-10">
            <input type="date" class="form-control" id="dob" name="dob" placeholder="Date de naissance" pattern="^\d{1,2}/\d{1,2}/\d{4}$" />
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
            <input type="text" class="form-control" id="adr-voie" name="adr-voie" placeholder="Adresse" required>
        </div>
        <div class="col-xs-2">
            <input type="text" class="form-control" id="adr-cp" name="adr-cp" placeholder="Code Postal" pattern="^\d{5}$" required>
        </div>
        <div class="col-xs-3">
            <select class="form-control" id="adr-ville" name="adr-ville" placeholder="Ville">
                <?php echo $cities; ?>
            </select>
        </div>

    </div>

    <div class="form-group">
        <label for="passwd" class="control-label col-md-2">Mot de passe</label>
        <div class="col-xs-12 col-md-10">
            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Entrez un mot de passe" required>
        </div>
    </div>

    <div class="form-group">
        <label for="passwd-conf" class="control-label col-md-2">Confirmation</label>
        <div class="col-xs-12 col-md-10">
            <input type="password" class="form-control" id="passwd-conf" name="passwd-conf" placeholder="Confirmez le mot de passe" required />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 col-md-10 col-md-offset-2">
            <button type="submit" class="col-xs-12 btn btn-success pull-middle">Valider</button>
        </div>
    </div>


</form>

<script>

$(function(){

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