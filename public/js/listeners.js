(function () {

    'use strict';

    // @ngInject
    function listen($rootScope, $templateCache, $cacheFactory, $location, $anchorScroll, $timeout, Navigation, Loading) {

        $rootScope.$on('alert', function (event, alert, callback = null) {
            $rootScope.mainAlert = alert;
            $timeout(function () {
                $rootScope.mainAlert.show = false;
                if (callback) callback();
            }, alert.timeout ? alert.timeout : 3000);
        });

        $rootScope.$on('destroyCache', function () {
            console.log('destroying cache');
            $cacheFactory.get("$http").removeAll();
        });

        $rootScope.$on('setTitle', function (title) {
            $rootScope.title = title;
            $rootScope.$broadcast('title', title);
        });

        $rootScope.$on('userLogin', function (event, user) {
            $rootScope.user = user;
        });

        $rootScope.$on('$viewContentLoaded', function() {
            console.log('removing cache');
            $templateCache.removeAll();
        });

        $rootScope.$on('$routeChangeSuccess', function(newRoute, oldRoute) {
            if($location.hash()) $anchorScroll();
        });

        // When State starts changing
        $rootScope.$on('$stateChangeStart', function (ev, to, toParams, from, fromParams) {
            Loading.start();
        });

        // When State change is over
        $rootScope.$on('$stateChangeSuccess', function (ev, toState, toParams, fromState, fromParams) {
            Navigation.process(ev, toState, toParams, fromState, fromParams);
            if (!toState.resolve) {
                Loading.stop();
            }
        });

        $rootScope.$emit('destroyCache');

    }

    angular
        .module('app')
        .run(listen);

})();
