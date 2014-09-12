<?php echo form_open('admin/prets/new', array('id' => $formid, 'class' => 'form-horizontal')); ?>

	<input type="hidden" name="instru_id" value="<?php echo $instrument->instru_id; ?>">

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-1">Catégorie</label>
        <div class="col-xs-11">
            <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo $instrument->categ_nom; ?>" readonly>
        </div>
    </div>

	<div class="form-group">
        <label for="marque" class="control-label col-xs-1">Marque</label>
        <div class="col-xs-11">
            <input type="text" class="form-control" id="marque" name="marque" value="<?php echo $instrument->marque_nom; ?>" readonly>
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1">Numéro de série</label>
        <div class="col-xs-11">
            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $instrument->instru_numero_serie; ?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <label for="accessoires" class="control-label col-xs-1">Accessoires</label>
        <div class="col-xs-11">
            <textarea type="text" class="form-control" id="accessoires" name="accessoires" readonly><?php echo $instrument->instru_accessoires; ?></textarea>
        </div>
    </div>

	<div class="form-group">
        <label for="etat-initial" class="control-label col-xs-1">Etat initial</label>
        <div class="col-xs-11">
            <textarea type="text" class="form-control" id="etat-initial" name="etat-initial"><?php echo $instrument->instru_etat_commentaire; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="emprunteur" class="control-label col-xs-1">Emprunteur</label>
        <div class="col-xs-4">
            <input type="text" class="form-control col-xs-5" id="membre-id" name="membre-id" value="" placeholder="Numéro du membre">
        </div>

        <button id="search-membre" class="btn btn-primary col-xs-1">Rechercher</button>

        <div class="col-xs-6">
            <input type="text" class="form-control col-xs-6" id="membre-nom" name="membre-nom" readonly>
        </div>
    </div>

    <button type="submit" id="pret-validate" class="btn btn-success hidden col-xs-offset-1">Valider le prêt</button>

<?php echo form_close(); ?>

<script type="text/javascript" charset="utf-8" async defer>
    
$(function(){

    $('#search-membre').on('click', function(){

        $.ajax({
            url: '/admin/ajax/searchMemberById/' + $('#membre-id').val(),
            async: false,
            dataType: 'json',
            success: function(data) {
                if ( !$.isEmptyObject(data) ) {
                    $('#membre-nom').val(data.membre_prenom + ' ' + data.membre_nom);
                    $('[type=submit]').removeClass('hidden');
                }
            } 
        });

        return false;

    });

});

</script>