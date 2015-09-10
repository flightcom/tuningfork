<ul class="nav navbar-nav submenu pull-right">
    <li>
    	<a href="" title="RàZ" ng-click="tmParams.filter({})" ng-class="{active : tmParams.filter() != {} }">
    		<span class="glyphicon glyphicon-filter"></span>
            <span class="badge bkg-danger" ng-show="tmParams.filter() != {}">{{tmParams.total()}}</span>
    	</a>
    </li>
</ul>
