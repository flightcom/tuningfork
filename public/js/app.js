(function () {

    angular.module('app',
        [
            'ui.bootstrap',
            'ngMaterial',
            'ngMessages',
            'ngTable',
            'ngResource',
            'ngTagsInput',
            'ui.router',
            'cgBusy',
            'osdForm',
            'ngSanitize',
            'ngStorage',
            'ngMap',
            'angular-parallax',
            'md.data.table',
            'ngMaterialSidemenu',
            'angular-barcode',
            'intlTelInput'
        ]);

    angular.module('app')
        .value('cgBusyDefaults', {
            templateUrl: '/dist/js/templates/angular-busy.html'
        });

})();
