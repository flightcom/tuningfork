<div class="col-xs-12">

    <div class="tab-content">

        <section id="infos" class="tab-pane fade in active" ng-init="editMembre=false">

            <?php echo form_open('admin/membres/' . $membre->membre_id . '/edit', array('id' => $formid, 'class' => 'form-horizontal')); ?>

            	<br>

                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $membre->membre_id; ?>" ng-readonly="editMembre" />

            	<div class="form-group">
                    <label for="categorie" class="control-label col-xs-1">Nom</label>
                    <div class="col-xs-11">
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $membre->membre_nom; ?>" ng-readonly="editMembre" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="categorie" class="control-label col-xs-1">Prénom</label>
                    <div class="col-xs-11">
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $membre->membre_prenom; ?>" ng-readonly="editMembre" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="tel" class="control-label col-xs-1">Téléphone</label>
                    <div class="col-xs-11">
                        <input type="text" class="form-control editable" id="tel" name="tel" value="<?php echo $membre->membre_tel; ?>" ng-readonly="editMembre" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="control-label col-xs-1">Email</label>
                    <div class="col-xs-11">
                        <input type="text" class="form-control editable" id="email" name="email" value="<?php echo $membre->membre_email; ?>" ng-readonly="editMembre" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="adresse" class="control-label col-xs-1">Adresse</label>
                    <div class="col-xs-11">
                        <input type="text" class="form-control editable" id="adresse" name="adresse" value="<?php echo $membre->adr_voie; ?>" ng-readonly="editMembre" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="cp" class="control-label col-xs-1">Code Postal</label>
                    <div class="col-xs-11">
                        <input type="text" class="form-control editable" id="cp" name="cp" pattern="^\d{5}$" ng-model="membre.ville_code_postal" ng-init="membre.ville_code_postal='<?php echo $membre->ville_code_postal; ?>'" readonly />
                    </div>
                </div>

<!--                 <div class="form-group">
                    <label for="ville" class="control-label col-xs-1">Ville</label>
                    <div class="col-xs-11">
                        <input type="text" class="form-control " id="ville" name="ville" value="<?php echo $membre->ville_nom; ?>" readonly />
                    </div>
                </div>
 -->
                <div class="form-group">
                    <label for="ville" class="control-label col-xs-1">Ville</label>
                    <div class="col-xs-11">
                        <select class="form-control editable" name="selectville" placeholder="Ville" ng-options="ville.ville_id as ville.ville_nom for ville in villes" ng-init="membre.ville_id='<?php echo $membre->ville_id; ?>'" required ng-model="membre.ville_id" readonly></select>
                        <input type="hidden" name="ville" value="{{membre.ville_id}}" required>
                    </div>
                </div>

            	<div class="form-group">
                    <label for="date-entree" class="control-label col-xs-1"></label>
                    <div class="col-xs-11">
            			<button type="button" ng-click="editMembre=true" class="btn btn-warning">Modifier</button>
            			<button type="submit" class="btn btn-success edition hidden">Valider</button>
            			<button onclick="uneditForm('<?php echo $formid; ?>');return false;" class="btn btn-default edition hidden">Annuler</button>
            			<button onclick="document.location.href='/admin/membres/<?php echo $membre->membre_id; ?>/delete';return false;" class="btn btn-danger pull-right">Supprimer</button>
                    </div>
                </div>

            </form>

        </section>

        <section id="emprunts" class="tab-pane fade in ">

        <br>

        <?php if ( count($emprunts) > 0 ) : ?>

            <table class="table table-bordered table-hover tablesorter">

                <thead>

                    <tr class="">
                        <th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Catégorie</th>
                        <th class="filter-select filter-exact filter-onlyAvail" data-placeholder="Sélectionner">Marque</th>
                        <th class="hidden-xs hidden-sm">Modèle</th>
                        <th class="hidden-xs">Numéro de série</th>
                        <th class="col-xs-1 visible-lg">Date de prêt</th>
                        <th class="col-xs-1 visible-lg">Date de remise prévue</th>
                    </tr>

                </thead>
                <tbody>
                <?php foreach ($emprunts as $e){ ?>
                    <tr onclick="location.href='/admin/instruments/<?php echo $e->instru_id; ?>'" style="cursor:pointer;">
                        <td><?php echo $e->categ_nom; ?></td>
                        <td><?php echo $e->marque_nom; ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $e->instru_modele; ?></td>
                        <td class="hidden-xs"><?php echo $e->instru_numero_serie; ?></td>
                        <td class="visible-lg"><?php echo $e->emp_date_debut; ?></td>
                        <td class="visible-lg"><?php echo $e->emp_date_fin_prevue; ?></td>
                    </tr>
                <?php } ?>
                </tbody>

                <tfoot>

                    <tr>
                        <th colspan="10" class="ts-pager form-horizontal">
                            <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i>
                            </button>
                            <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i>
                            </button>   <span class="pagedisplay"></span> 
                            <!-- this can be any element, including an input -->
                            <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i>
                            </button>
                            <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i>
                            </button>
                            <select class="pagesize input-mini" title="Select page size">
                                <option selected="selected" value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                            </select>
                            <select class="pagenum input-mini" title="Select page number"></select>
                        </th>
                    </tr>

                </tfoot>

            </table>

        <?php else : ?>

            <p>Aucun emprunt</p>

        <?php endif; ?>

        <?php if ( (int)$en_cours->nb == 0 ) : ?>

            <p>Aucun emprunt en cours</p>
            <button onclick="$(this).next().removeClass('hidden');" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"> Emprunter</span></button>

            <?php echo form_open('admin/membres/' . $membre->membre_id . '/emprunter', array('id' =>'emprunt-membre', 'class' => 'hidden form-horizontal')); ?>

                <div class="form-group has-feedback">
                    <label for="instru_id" class="control-label col-xs-1">Code instrument</label>
                    <div class="col-xs-11">
                        <input type="text" class="form-control" id="instru_id" name="instru_id" value="">
                        <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                </div>

            </form>

        <?php endif; ?>

        </section>

    </div>

</div>

<script>

$(function(){

    $('#membre-actions-list a').click(function (e) {
        if($(this).parent('li').hasClass('active')){
            $( $(this).attr('href') ).hide();
        }
        else {
            e.preventDefault();
            $(this).tab('show');
        }
    });

    $("#instru_id").keyup(function(){

        $.ajax({
            url: 'admin/check_instru_code/'+$(this).val(),
            type: 'get',
            // async:false,
            success: function(data){
                if ( data == 1 ) { // ok
                    $(this).closest('.form-group').addClass('has-sucess');
                } else {
                    $(this).closest('.form-group').addClass('has-error');                    
                }
            }
        });

    });

});

</script>