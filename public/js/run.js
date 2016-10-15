(function () {

    'use strict';

    // @ngInject
    function run($rootScope, $cacheFactory, $timeout) {
        $rootScope.goto = function (location) {
            window.location.href = location;
        };

        $rootScope.$on('alert', function (event, alert) {
            $rootScope.mainAlert = alert;

            $timeout(function () {
                $rootScope.mainAlert.show = false;
            }, alert.timeout ? alert.timeout : 3000);
        });

        $rootScope.$on('destroyCache', function () {
            $cacheFactory.get("$http").removeAll();
        });
    }

    angular
        .module('app')
        .run(run);

})();
