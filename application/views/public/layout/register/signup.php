<div ng-controller="RegisterCtrl as vm">

    <div class="container">

        <h3 class="center">Création de mon compte</h3>

        <br>

        <form role="form" name="vm.signupForm" osd-submit="vm.signUp()" novalidate>

            <osd-field attr="nom">
                <label class="control-label">Nom</label>
                <input type="text" class="form-control" name="nom"
                       ng-model="vm.user.nom" required="required">
                <osd-error msg="Nom requis"></osd-error>
            </osd-field>

            <osd-field attr="prenom">
                <label class="control-label">Prénom</label>
                <input type="text" class="form-control" name="prenom"
                       ng-model="vm.user.prenom" required="required">
                <osd-error msg="Prénom requis"></osd-error>
            </osd-field>

            <osd-field attr="address_street">
                <label class="control-label">Adresse</label>
                <input type="text" class="form-control" name="address_street"
                       ng-model="vm.user.adresse.voie" required="required">
                <osd-error msg="Adresse requise"></osd-error>
            </osd-field>

            <osd-field attr="address_code_postal">
                <label class="control-label">Code Postal</label>
                <input type="text" class="form-control" name="address_code_postal" readonly
                       ng-model="vm.user.adresse.ville.codePostal" required="required">
                <osd-error msg="Sélectionnez une ville"></osd-error>
            </osd-field>

            <osd-field attr="address_ville">
                <label class="control-label">Ville</label>
                <input type="text" class="form-control" name="address_ville"
                    autocomplete="off"
                    ng-model="vm.user.adresse.ville.nomReel"
                    uib-typeahead="ville as ville.nomReel for ville in vm.getVilles($viewValue)"
                    typeahead-min-length="3"
                    typeahead-no-results="noResults"
                    typeahead-select-on-exact="true"
                    typeahead-on-select="vm.user.adresse.ville=$item"
                    typeahead-template-url="/public/dist/html/partials/typeahead/ville-match.html"
                    typeahead-popup-template-url="/public/dist/html/partials/typeahead/ville-popup.html"
                    required="required">
                <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> Aucun résultat
                </div>
                <osd-error msg="Ville requise"></osd-error>
            </osd-field>

            <osd-field attr="pays">
                <label class="control-label">Pays</label>
                <select class="form-control" name="pays"
                        ng-model="vm.user.adresse.pays"
                        ng-options="pays as pays.nom for pays in vm.countries track by pays.id"
                        required="required"></select>
                <osd-error msg="Pays requis"></osd-error>
                <osd-error error-type="email" msg="Email invalide"></osd-error>
            </osd-field>

            <osd-field attr="email">
                <label class="control-label">Email</label>
                <input type="email" class="form-control" name="email"
                       ng-model="vm.user.email" required="required">
                <osd-error msg="Email requis"></osd-error>
                <osd-error error-type="email" msg="Email invalide"></osd-error>
            </osd-field>

            <osd-field attr="tel">
                <label class="control-label">Téléphone</label>
                <input type="tel" class="form-control" name="tel"
                       ng-model="vm.user.telephone" required="required">
                <osd-error msg="Téléphone requis"></osd-error>
            </osd-field>

            <osd-field attr="naissance">
                <label class="control-label">Date de naissance</label>
                <input type="date" class="form-control" name="naissance"
                       ng-model="vm.user.dateNaissance" required="required">
                <osd-error msg="Date de naissance requise"></osd-error>
            </osd-field>

            <osd-field attr="password">
                <label class="control-label">Mot de passe</label>
                <input type="password" class="form-control" name="password"
                       ng-model="vm.user.password" required="required">
                <osd-error msg="Mot de passe invalide"></osd-error>
            </osd-field>

            <osd-field attr="check-password">
                <label class="control-label">Confirmation Mot de passe</label>
                <input type="password" class="form-control" name="check-password"
                       ng-model="vm.user.passwordConf" required="required">
                <osd-error validator="strictMatchValidator()" attrs="['password', 'check-password']" msg="Les mots de passe ne correspondent pas"></osd-error>
            </osd-field>

            <button type="submit" class="btn btn-primary col-xs-12">Envoyer</button>

        </form>

    </div>

</div>
