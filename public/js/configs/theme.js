(function () {

    // @ngInject
    function theme($mdThemingProvider){
        $mdThemingProvider.theme('default')
            .primaryPalette('blue');
            // .dark();
        $mdThemingProvider.alwaysWatchTheme(true);
    }

    angular.module('app')
        .config(theme);

})();
