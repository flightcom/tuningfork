<?php echo form_open('admin/prets/close/' . $pret->emp_id, array('id' => 'form-close', 'class' => 'form-horizontal pdl20 pdr20')); ?>

	<input type="hidden" name="emp-id" value="<?php echo $pret->emp_id; ?>">

	<div class="form-group">
        <label for="categorie" class="control-label col-xs-2">Catégorie</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo $pret->categ_nom; ?>" readonly>
        </div>
    </div>

	<div class="form-group">
        <label for="marque" class="control-label col-xs-2">Marque</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="marque" name="marque" value="<?php echo $pret->marque_nom; ?>" readonly>
        </div>
    </div>

	<div class="form-group">
        <label for="numero" class="control-label col-xs-2">Numéro de série</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $pret->instru_numero_serie; ?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <label for="accessoires" class="control-label col-xs-2">Accessoires</label>
        <div class="col-xs-10">
            <textarea type="text" class="form-control" id="accessoires" name="accessoires" readonly><?php echo $pret->instru_accessoires; ?></textarea>
        </div>
    </div>

	<div class="form-group">
        <label for="etat-initial" class="control-label col-xs-2">Etat initial</label>
        <div class="col-xs-10">
            <textarea readonly type="text" class="form-control" id="etat-initial" name="etat-initial"><?php echo $pret->instru_etat_commentaire; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="etat-initial" class="control-label col-xs-2">Etat final</label>
        <div class="col-xs-10">
            <textarea type="text" class="form-control" id="etat-initial" name="etat-final"></textarea>
        </div>
    </div>

	<div class="form-group">
        <label for="date-fin-prevue" class="control-label col-xs-2">Date de retour prévue</label>
        <div class="col-xs-10">
            <input readonly type="date" class="form-control" id="date-fin-prevue" name="date-fin-prevue" value="<?php echo $pret->emp_date_fin_prevue; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="date-fin-effective" class="control-label col-xs-2">Date de retour effective<small>(laisser vide pour mettre la date actuelle)</small></label>
        <div class="col-xs-10">
            <input type="date" class="form-control" id="date-fin-effective" name="date-fin-effective" value="<?php echo $pret->emp_date_fin_effective; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="caution" class="control-label col-xs-2">Caution rendue</label>
        <div class="col-xs-10">
            <div class="radio radio-primary">
                <input type="radio" id="oui" name="caution-rendue" value="1" required>
                <label for="oui">OUI</label>
            </div>
            <div class="radio radio-primary">
                <input type="radio" id="non" name="caution-rendue" value="0" required>
                <label for="non">NON</label>
            </div>
        </div>
    </div>

    <button type="submit" id="pret-close" class="btn btn-success col-xs-offset-1">Clôturer</button>

<?php echo form_close(); ?>
