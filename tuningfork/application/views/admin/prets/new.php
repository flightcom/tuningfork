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
        <label for="etat-initial" class="control-label col-xs-1">Etat initial</label>
        <div class="col-xs-11">
            <textarea type="text" class="form-control" id="etat-initial" name="etat-initial" readonly><?php echo $instrument->instru_etat_commentaire; ?></textarea>
        </div>
    </div>

	<div class="form-group">
        <label for="etat-final" class="control-label col-xs-1">Etat initial</label>
        <div class="col-xs-11">
            <textarea type="text" class="form-control" id="etat-final" name="etat-final" readonly><?php echo $instrument->instru_etat_commentaire; ?></textarea>
        </div>
    </div>

<?php echo form_close(); ?>