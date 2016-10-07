(function() {

    // @ngInject
    function trusted($sce){
        return function (text) {
            return $sce.trustAsHtml(text);
        };
    }

    angular
        .module('app')
        .filter('trusted', trusted)

})();