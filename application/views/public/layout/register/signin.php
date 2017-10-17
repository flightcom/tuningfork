<div class="container" ng-controller="RegisterCtrl as vm">
    <h3>Connectez-vous ou <a href="/register/signup">Créez votre compte</a></h3>

    <div class="row">
        <form name="vm.signinForm" osd-submit="vm.signIn()" novalidate>
            <osd-field attr="email">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input ng-model="vm.user.email" type="text" class="form-control" name="email" placeholder="Adresse mail" required>
                    </div>
                    <osd-error msg="Adresse Email requise"></osd-error>
                </div>
            </osd-field>

            <osd-field attr="password">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input ng-model="vm.user.password" type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                    </div>
                    <osd-error msg="Mot de passe requis"></osd-error>
                </div>
            </osd-field>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
        </form>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <label class="checkbox">
                <input type="checkbox" value="remember-me">Se souvenir de moi
            </label>
        </div>
        <div class="col-xs-12 col-sm-6">
                <a href="/connexion/password">Mot de passe oublié ?</a>
        </div>
    </div>
</div>


<script src="<?php echo (JS.'fb.js'); ?>"></script>
