<select class="form-control" id="adr-voie" name="adr-voie" placeholder="Voie">
    <?php foreach ( $cities as $c) { ?>
    <option value="<?php echo $c->ville_id; ?>"><?php echo $c->ville_nom; ?></option>
    <?php } ?>
</select>