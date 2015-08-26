<?php echo form_open('admin/prets/close', array('id' => $formid, 'class' => 'form-horizontal pdl20 pdr20')); ?>

	<input type="hidden" name="emp-id" value="<?php echo $pret->emp_id; ?>">

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-1">Catégorie</label>
        <div class="col-xs-11">
            <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo $pret->categ_nom; ?>" readonly>
        </div>
    </div>

	<div class="form-group">
        <label for="marque" class="control-label col-xs-1">Marque</label>
        <div class="col-xs-11">
            <input type="text" class="form-control" id="marque" name="marque" value="<?php echo $pret->marque_nom; ?>" readonly>
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-1">Numéro de série</label>
        <div class="col-xs-11">
            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $pret->instru_numero_serie; ?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <label for="accessoires" class="control-label col-xs-1">Accessoires</label>
        <div class="col-xs-11">
            <textarea type="text" class="form-control" id="accessoires" name="accessoires" readonly><?php echo $pret->instru_accessoires; ?></textarea>
        </div>
    </div>

	<div class="form-group">
        <label for="etat-initial" class="control-label col-xs-1">Etat initial</label>
        <div class="col-xs-11">
            <textarea readonly type="text" class="form-control" id="etat-initial" name="etat-initial"><?php echo $pret->instru_etat_commentaire; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="etat-initial" class="control-label col-xs-1">Etat final</label>
        <div class="col-xs-11">
            <textarea type="text" class="form-control" id="etat-initial" name="etat-final"><?php echo $instrument->instru_etat_commentaire; ?></textarea>
        </div>
    </div>

	<div class="form-group">
        <label for="date-fin-prevue" class="control-label col-xs-1">Date de retour <small>(laisser vide pour mettre la date actuelle)</small></label>
        <div class="col-xs-11">
            <input readonly type="date" class="form-control" id="date-fin-prevue" name="date-fin-prevue" value="<?php echo $date_fin_prevue; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="date-fin-prevue" class="control-label col-xs-1">Caution rendue</label>
        <div class="col-xs-11">
            <label for="oui" class="control-label col-xs-1">OUI</label>
            <input type="radio" class="form-control" id="oui" name="caution-rendue" value="1>">
            <label for="non" class="control-label col-xs-1">NON</label>
            <input type="radio" class="form-control" id="non" name="caution-rendue" value="0">
        </div>
    </div>

    <button type="submit" id="pret-close" class="btn btn-success hidden col-xs-offset-1">Clôturer</button>

<?php echo form_close(); ?>
