(function () {

    // @ngInject
    function home($stateProvider, PATHS){

        let home = {
            name: 'public.home',
            // abstract: true,
            templateUrl: PATHS.TEMPLATE + 'layouts/home.html',
            // controller: 'HomeCtrl as vm'
        };

        $stateProvider.state(home);

    }

    angular.module('app')
        .config(home);

})();
