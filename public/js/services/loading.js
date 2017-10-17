(function () {

    // @ngInject
    function Loading($rootScope) {

        const start = () => {
            $rootScope.loading = true;
        };

        const stop = () => {
            $rootScope.loading = false;
        };

        return {
            start : start,
            stop  : stop
        };

    }

    angular
        .module('app')
        .service('Loading', Loading);

})();
