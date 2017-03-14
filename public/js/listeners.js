(function () {

    'use strict';

    // @ngInject
    function listen($rootScope, $templateCache, $cacheFactory, $location, $state, $anchorScroll, $timeout) {

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

        $rootScope.$on('$stateChangeSuccess', function (ev, to, toParams, from, fromParams) {
            let fromURL = $state.href(from.name, fromParams, {absolute: false});
            let toURL   = $state.href(to.name, toParams, {absolute: false});
            let prevURL = $rootScope.history[$rootScope.history.length - 1];
            console.log(prevURL, fromURL, toURL);
            if (toURL !== prevURL) {
                $rootScope.history.push(fromURL);
            } else {
                $rootScope.history.pop();
            }
            console.log($rootScope.history);
        });

        $rootScope.$emit('destroyCache');

    }

    angular
        .module('app')
        .run(listen);

})();
