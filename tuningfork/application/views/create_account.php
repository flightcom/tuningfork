<?php echo validation_errors(); ?>
<?php echo form_open('account/create', array('id' =>'create-account', 'class' => 'form-horizontal')); ?>
	<h3>Création de mon compte</h3>

	<br />

	<div class="form-group">
        <label for="nom" class="control-label col-xs-1">Nom</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
        </div>
    </div>

	<div class="form-group">
        <label for="prenom" class="control-label col-xs-1">Prénom</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
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