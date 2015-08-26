<div class="pdl20 pdr20">

    <div class="btn-group pull-right">

        <button type="button" class="btn btn-default dropdown-toggle"
                 data-toggle="dropdown">Action <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li onclick="location.href='/admin/membres/<?php echo $pret->membre_id; ?>'"><a href="">Fiche membre</a></li>
                <li onclick="location.href='/admin/instruments/<?php echo $pret->instru_id; ?>'"><a href="">Fiche instrument</a></li>
                <li onclick="location.href='/admin/prets/<?php echo $pret->emp_id; ?>/close'"><a href="">Clôturer</a></li>
                <li onclick="location.href='/admin/prets/<?php echo $pret->emp_id; ?>/pdf'"><a href="">Télécharger contrat</a></li>
                <li onclick="location.href='/admin/prets/<?php echo $pret->emp_id; ?>/html'"><a href="">Voir contrat</a></li>
                <li><a href="">Supprimer</a></li>
            </ul>

    </div>

    <h3>Prêt <small>n°<?php echo $pret->emp_id; ?></small></h3>

    <br>

    <?php echo form_open('admin/prets/' . $pret->emp_id . '/edit', array( 'class' => 'form-horizontal')); ?>

        <section id="infos-pret" class="tab-pane fade in active">

            <div>
                <div class="form-group col-xs-2">
                    <h5>Détail sur le prêt</h5>
                </div>
                <div class="col-xs-10">
                    <div class="form-group">
                        <label for="emp_date_debut" class="control-label col-xs-2">Date d'emprunt</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" id="emp_date_debut" name="emp_date_debut" value="<?php echo $pret->emp_date_debut; ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emp_date_fin_prevue" class="control-label col-xs-2">Date de remise prévue</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" id="emp_date_debut" name="emp_date_fin_prevue" value="<?php echo $pret->emp_date_fin_prevue; ?>" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="emp_date_fin_effective" class="control-label col-xs-2">Date de remise effective</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" id="emp_date_fin_effective" name="emp_date_fin_effective" value="<?php echo $pret->emp_date_fin_effective; ?>" readonly />
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="infos-membre" class="tab-pane fade in">

            <div>
                <div class="form-group col-xs-2">
                    <h5>Emprunteur</h5>
                </div>
                <div class="col-xs-10">
                    <div class="form-group">
                        <label for="nom" class="control-label col-xs-2">Nom</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $pret->membre_nom; ?>" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prenom" class="control-label col-xs-2">Prénom</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $pret->membre_prenom; ?>" readonly />
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="infos-instrument" class="tab-pane fade in">

            <div>
                <div class="form-group col-xs-2">
                    <h5>Instrument</h5>
                </div>
                <div class="col-xs-10">
                </div>
            </div>

        </section>

    </form>

</div>
