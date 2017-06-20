(function () {

    let toolbarAdmin = {
        templateUrl: 'public/dist/html/components/toolbar-admin.html',
        controller: ToolbarAdminController,
        controllerAs: '$toolbarAdminController'
    };

    // @ngInject
    function ToolbarAdminController ($mdSidenav, PATHS) {

        var vm = this;

        vm.PATHS = PATHS;

        vm.toggleLeft = () => {
            $mdSidenav('left').toggle();
        };

    }

    angular.module('app')
        .component('toolbarAdmin', toolbarAdmin);

})();
