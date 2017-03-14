(function () {

    let toolbarAdmin = {
        templateUrl: 'public/dist/html/components/toolbar-admin.html',
        controller: ToolbarAdminController,
        controllerAs: '$toolbarAdminController'
    }

    // @ngInject
    function ToolbarAdminController ($mdSidenav, $mdMenu, PATHS) {

        var vm = this;

        vm.PATHS = PATHS;

        vm.toggleLeft = buildToggler('left');

        function buildToggler(componentId) {
            return function() {
                console.log('toggle');
                $mdSidenav(componentId).toggle();
            };
        }

        vm.openMenu = ($mdMenu, ev) => {
            originatorEv = ev;
            $mdMenu.open(ev);
        };

    }

    angular.module('app')
        .component('toolbarAdmin', toolbarAdmin);

})();
