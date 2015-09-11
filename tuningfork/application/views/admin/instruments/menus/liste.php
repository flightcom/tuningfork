<ul class="nav navbar-nav submenu pull-right">
    <li>
    	<a href="" title="État" class="dropdown-toggle" data-toggle="dropdown" ng-class="{active : tiParams.filter().instru_etat.length > 0}">
    		<span class="glyphicon glyphicon-thumbs-up"></span>
			<ul class="dropdown-menu" role="menu">
				<li ng-click="toggleEtat(0)" ng-class="{active : tiParams.filter().instru_etat.indexOf(0) > -1}"><a href="">Très mauvais</a></li>
				<li ng-click="toggleEtat(1)" ng-class="{active : tiParams.filter().instru_etat.indexOf(1) > -1}"><a href="">Mauvais</a></li>
				<li ng-click="toggleEtat(2)" ng-class="{active : tiParams.filter().instru_etat.indexOf(2) > -1}"><a href="">Moyen</a></li>
				<li ng-click="toggleEtat(3)" ng-class="{active : tiParams.filter().instru_etat.indexOf(3) > -1}"><a href="">Bon</a></li>
				<li ng-click="toggleEtat(4)" ng-class="{active : tiParams.filter().instru_etat.indexOf(4) > -1}"><a href="">Très bon</a></li>
				<li ng-click="toggleEtat(5)" ng-class="{active : tiParams.filter().instru_etat.indexOf(5) > -1}"><a href="">Comme neuf</a></li>
			</ul>    		
    	</a>
    </li>
    <li>
    	<a href="" title="Disponibilité" class="dropdown-toggle" data-toggle="dropdown" ng-class="{active : tiParams.filter().instru_dispo.length > 0}">
    		<span class="glyphicon glyphicon-retweet"></span>
			<ul class="dropdown-menu" role="menu">
				<li ng-click="toggleDispo(1)" ng-class="{active : tiParams.filter().instru_dispo.indexOf(1) > -1}"><a href="">Oui</a></li>
				<li ng-click="toggleDispo(0)" ng-class="{active : tiParams.filter().instru_dispo.indexOf(0) > -1}"><a href="">Non</a></li>
			</ul>
    	</a>
    </li>
    <li>
    	<a href="" title="RàZ" ng-click="tiParams.filter({})" ng-class="{active: utils.keys(tiParams.filter()).length}">
            <span class="badge">{{tiParams.total()}}</span>
    	</a>
    </li>
</ul>
