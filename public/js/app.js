(function () {

    angular.module('app',
        [
            'ui.bootstrap',
            'ngMaterial',
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

    // @ngInject
    function tiny(){
        // Configure TinyMCE
        if (tinyMCE) {
            tinyMCE.baseURL = '/node_modules/tinymce';
        }
    }

    // @ngInject
    function locationProviderConfig($locationProvider) {
        // $locationProvider.html5Mode(true);
    };

    angular.module('app')
        // .config(locationProviderConfig)
        .value('cgBusyDefaults', {
            templateUrl: '/dist/js/templates/angular-busy.html'
        })
        // .config(tiny)

})();
