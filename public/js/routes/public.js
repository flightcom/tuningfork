(function () {

    // @ngInject
    function publiq($stateProvider, PATHS){

        let publiq = {
            name: 'public',
            abstract: true,
            templateUrl: PATHS.TEMPLATE + 'layouts/public.html',
        };

        let home = {
            name: 'public.home',
            templateUrl: PATHS.TEMPLATE + 'layouts/home.html'
        };

        let splash = {
            name: 'public.splash',
            abstract: true,
            views: {
                public: {
                    templateUrl: PATHS.TEMPLATE + 'layouts/splash.html',
                    controller: 'SplashCtrl as vm'
                }
            }
        };

        let splashChildren = {
            name: 'public.splash.child',
            url: '/',
            views: {
                'top': {
                    templateUrl: PATHS.TEMPLATE + 'partials/splash/top.html',
                },
                'association': {
                    templateUrl: PATHS.TEMPLATE + 'partials/splash/association.html',
                },
                'stations': {
                    templateUrl: PATHS.TEMPLATE + 'partials/splash/stations.html',
                },
                'contact': {
                    templateUrl: PATHS.TEMPLATE + 'partials/splash/contact.html',
                }
            }
        };

        let login = {
            name: 'login',
            url: '/login',
            templateUrl: PATHS.TEMPLATE + 'layouts/login.html',
            controller: 'RegisterCtrl as $registerCtrl'
        };

        let signup = {
            name: 'public.signup',
            url: '/signup',
            views: {
                public: {
                    templateUrl: PATHS.TEMPLATE + 'layouts/register/signup.html',
                    controller: 'RegisterCtrl as $registerCtrl'
                }
            }
        };

        let signupSuccess = {
            name: 'public.signup.success',
            url: '/success',
            views: {
                '@': {
                    templateUrl: PATHS.TEMPLATE + 'layouts/register/success.html'
                }
            }
        };

        $stateProvider.state(publiq);
        $stateProvider.state(home);
        $stateProvider.state(splash);
        $stateProvider.state(splashChildren);
        $stateProvider.state(login);
        $stateProvider.state(signup);
        $stateProvider.state(signupSuccess);

    }

    angular.module('app')
        .config(publiq);

})();
