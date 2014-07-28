<?php echo validation_errors(); $i = 0; ?>

<?php echo form_open('account/create', array('id' =>'create-account', 'class' => 'form-horizontal')); ?>
	<h3 class="center">Création de mon compte</h3>

	<br>

    <div class="form-group center">
        <!-- <label for="genre" class="control-label col-xs-2">Genre</label> -->
        <div class="col-xs-5">
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
        <!-- <label for="nom" class="control-label col-xs-2">Nom</label> -->
        <div class="col-xs-7">
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required />
        </div>
    </div>

	<div class="form-group">
        <!-- <label for="prenom" class="control-label col-xs-2">Prénom</label> -->
        <div class="col-xs-7">
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required />
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="email" class="control-label col-xs-2">Adresse Mail</label> -->
        <div class="col-xs-7">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="tel" class="control-label col-xs-2">Téléphone</label> -->
        <div class="col-xs-7">
            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Téléphone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required />
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="dob" class="control-label col-xs-2">Date de naissance</label> -->
        <div class="col-xs-7">
            <input type="date" class="form-control" id="dob" name="dob" placeholder="Date de naissance" pattern="^\d{1,2}/\d{1,2}/\d{4}$" />
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="tel" class="control-label col-xs-2">Adresse</label> -->
<!--         <div class="col-xs-2">
            <select class="form-control" id="adr-type-voie" name="adr-type-voie" placeholder="Voie">
                <option value>Sélectionnez...</option>
                <?php foreach ( $types_voie = Adresse_model::get_voies() as $v) { ?>
                <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select>
        </div> -->
        <div class="col-xs-3">
            <input type="text" class="form-control" id="adr-voie" name="adr-voie" placeholder="Adresse" />
        </div>
        <div class="col-xs-1">
            <input type="text" class="form-control" id="adr-cp" name="adr-cp" placeholder="CP" pattern="^\d{5}$" oninput="updateCities(this);" required />
        </div>
        <div class="col-xs-3 cities">
            <?php echo $cities; ?>
        </div>

    </div>

    <div class="form-group">
        <!-- <label for="passwd" class="control-label col-xs-2">Mot de passe</label> -->
        <div class="col-xs-7">
            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Entrez un mot de passe" required />
        </div>
    </div>

    <div class="form-group">
        <!-- <label for="passwd-conf" class="control-label col-xs-2">Confirmation</label> -->
        <div class="col-xs-7">
            <input type="password" class="form-control" id="passwd-conf" name="passwd-conf" placeholder="Confirmez le mot de passe" required />
        </div>
    </div>

    <div class="form-group">
        <span class="col-xs-2"></span>
        <div class="col-xs-7">
            <button type="submit" class="col-xs-12 btn btn-success pull-middle">Valider</button>
        </div>
    </div>


</form>

<script>

function updateCities(input)
{
    if(input.value.length == 5 && !isNaN(input.value)){
        $('.cities').load('/account/select_city/'+input.value);
    }
}

</script>