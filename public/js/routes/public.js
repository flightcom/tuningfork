(function () {

    // @ngInject
    function publiq($stateProvider, PATHS){

        let publiq = {
            name: 'public',
            abstract: true,
            templateUrl: PATHS.TEMPLATE + 'layouts/public.html',
        };

        $stateProvider.state(publiq);

    }

    angular.module('app')
        .config(publiq);

})();
