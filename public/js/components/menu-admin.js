(function () {

    let menuAdmin = {
        templateUrl: 'public/dist/html/components/menu-admin.html',
        controller: MenuAdminController,
        controllerAs: '$menuAdminController'
    }

    // @ngInject
    function MenuAdminController (PATHS) {

        this.PATHS = PATHS;

    }

    angular.module('app')
        .component('menuAdmin', menuAdmin);

})();
