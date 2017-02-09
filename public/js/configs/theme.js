(function () {

    // @ngInject
    function theme($mdThemingProvider){
        $mdThemingProvider.theme('default')
            .primaryPalette('blue');
        $mdThemingProvider.alwaysWatchTheme(true);
    }

    angular.module('app')
        .config(theme);

})();
