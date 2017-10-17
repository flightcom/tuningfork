<div class="alert alert-dismissible alert-main" ng-show="mainAlert.show" role="alert" ng-cloak
     ng-class="mainAlert.class">

    <button type="button" class="close" ng-click="mainAlert.show = false">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Fermer</span>
    </button>

     <div class="row">
    	<div class="col-xs-2">
    		<img class="check">
    	</div>
    	<div class="col-xs-9 text-box">
    		<strong ng-bind="mainAlert.title"></strong><br/><span ng-bind-html="mainAlert.msg | trusted"></span>
    	</div>
    </div>
</div>