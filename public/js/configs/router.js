(function () {

    // @ngInject
    function router($urlRouterProvider){
        $urlRouterProvider.otherwise('/');
    }

    angular.module('app')
        .config(router);

})();
