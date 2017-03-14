(function () {

    'use strict';

    // @ngInject
    function run($rootScope, $templateCache, $cacheFactory, $location, $state, $anchorScroll, $timeout, FILES, PATHS, Utils) {

        // Affectations
        $rootScope.FILES = FILES;
        $rootScope.PATHS = PATHS;
        $rootScope.$state = $state;
        $rootScope.history = [];

        // Functions
        $rootScope.goto = location => {
            window.location.href = location;
        };

        $rootScope.getTemplate = template => {
            return PATHS.TEMPLATE + template;
        };

    }

    angular
        .module('app')
        .run(run);

})();
