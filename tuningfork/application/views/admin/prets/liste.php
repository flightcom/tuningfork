<div class="pdl20 pdr20" ng-controller="AdminListPretsCtrl">

    <div class="btn-group pull-right">
        <div class="btn-group">
            <button type="button" class="btn dropdown-toggle"
                ng-class="{'btn-default': (tiParams.filter().instru_dispo | isEmpty), 'btn-primary': !(tiParams.filter().instru_dispo | isEmpty)}" 
                data-toggle="dropdown">{{statusSelected ? statusSelected : 'Status'}} <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li ng-model="statusClosed[0]" ng-click="toggleClosed(0)" ng-class="{active : tpParams.filter().emprunt_is_closed.indexOf(0) > -1}"><a href="">En cours</a></li>
                <li ng-model="statusClosed[1]" ng-click="toggleClosed(1)" ng-class="{active : tpParams.filter().emprunt_is_closed.indexOf(1) > -1}"><a href="">Cloturé</a></li>
            </ul>
        </div>
        <button ng-click="toggleRetard()" ng-class="{active : tpParams.filter().emprunt_is_delayed}" class="btn btn-default">Retards</button>
        <button ng-click="tpParams.filter({}).sorting({})" class="btn btn-danger">RàZ</button>
    </div>

    <h3><?php echo $title; ?><br><small>{{tpParams.total()}} résultats</small></h3>

    <table ng-table="tpParams" show-filter="true" class="table table-hover col-xs-12 table-list-bordered">

        <thead>
            <tr>
                <th ng-repeat="column in columns" ng-show="column.visible"
                    class="text-center sortable {{column.classes}}" 
                    ng-class="{
                        'sort-asc': tpParams.isSortBy(column.field, 'asc'),
                        'sort-desc': tpParams.isSortBy(column.field, 'desc')
                      }"
                    ng-click="tpParams.sorting(column.field, tpParams.isSortBy(column.field, 'asc') ? 'desc' : 'asc')">
                    <div ng-if="!template" ng-show="!template" class="ng-scope ng-binding">{{column.title}}</div>
                </th>
            </tr>

            <tr class="ng-table-filters" ng-init="tiParams">
                <th ng-repeat="column in columns" ng-show="column.visible" class="filter">
                    <div ng-repeat="(name, filter) in column.filter">
                        <div ng-if="!column.filterTemplateURL" ng-show="!column.filterTemplateURL">
                            <div ng-include="'ng-table/filters/' + filter + '.html'"></div>
                        </div>
                    </div>
                </th>
            </tr>

        </thead>

        <tbody>

            <tr ng-repeat="pret in filteredPrets" ng-click="go('/admin/prets/' + pret.emp_id)" style="cursor:pointer;" class="" ng-class="pret.emprunt_is_closed == 1 ? 'border-left-closed' : (pret.emprunt_is_delayed == 1 ? 'border-left-delayed' : 'border-left-opened')">
            <!-- <tr ng-repeat="pret in filteredPrets" onclick="$(this).next().toggle();" style="cursor:pointer;" class="" ng-class="pret.emprunt_is_closed == 1 ? 'border-left-closed' : (pret.emprunt_is_delayed == 1 ? 'border-left-delayed' : 'border-left-opened')"> -->
                <td ng-repeat="column in columns" data-title="column.title" ng-show="column.visible" sortable="column.field" ng-class="column.classes">{{pret[column.field]}}</td>
            </tr>

        </tbody>

    </table>

</div>