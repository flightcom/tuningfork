(function () {

    // @ngInject
    function splash($stateProvider, PATHS){

        // Abstract state (needed to have a template
        // that will contain the children)
        let splash = {
            name: 'public.splash',
            abstract: true,
            templateUrl: PATHS.TEMPLATE + 'layouts/splash.html',
            controller: 'SplashCtrl as vm'
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

        $stateProvider.state(splash);
        $stateProvider.state(splashChildren);

    }

    angular.module('app')
        .config(splash);

})();
