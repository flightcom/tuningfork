(function () {

    // @ngInject
    function register($stateProvider, PATHS){

        let register = {
            name: 'register',
            url: '/register',
            templateUrl: PATHS.TEMPLATE + 'layouts/register/signin/form.html',
            controller: 'RegisterCtrl as $registerCtrl'
        }

        let registerSignup = {
            name: 'signup',
            url: '/register/signup',
            templateUrl: PATHS.TEMPLATE + 'layouts/register/signup/form.html',
            controller: 'RegisterCtrl as $registerCtrl'
        }

        $stateProvider.state(register);
        $stateProvider.state(registerSignup);

    }

    angular.module('app')
        .config(register);

})();
