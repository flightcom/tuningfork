(function () {

    'use strict';

    // @ngInject
    function run($rootScope, $templateCache, $cacheFactory, $location, $state, $anchorScroll, $timeout, FILES, PATHS, Utils) {

        // Affectations
        $rootScope.FILES = FILES;
        $rootScope.PATHS = PATHS;
        $rootScope.$state = $state;

        // Functions
        $rootScope.goto = location => {
            window.location.href = location;
        };

        $rootScope.getTemplate = template => {
            return PATHS.TEMPLATE + template;
        };

        // Events
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
            console.log('user logged in !', 'rootscope', user);
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
            $rootScope.from = from;
        });

        $rootScope.$emit('destroyCache');

    }

    angular
        .module('app')
        .run(run);

})();
