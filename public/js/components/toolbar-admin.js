(function () {

    let toolbarAdmin = {
        templateUrl: 'public/dist/html/components/toolbar-admin.html',
        controller: ToolbarAdminController,
        controllerAs: '$toolbarAdminController'
    }

    // @ngInject
    function ToolbarAdminController (PATHS) {

        this.PATHS = PATHS;

    }

    angular.module('app')
        .component('toolbarAdmin', toolbarAdmin);

})();
