(function () {

    angular.module('app',
        [
            'ui.bootstrap',
            'ngTable',
            'ngResource',
            'ngTagsInput',
            'ngRoute',
            'cgBusy',
            'osdForm',
            'ngSanitize',
            'ngStorage',
            'ngMap',
            'angular-parallax'
        ]);

    // @ngInject
    function tiny(){
        // Configure TinyMCE
        if (tinyMCE) {
            tinyMCE.baseURL = '/node_modules/tinymce';
        }
    }

    angular.module('app')
        .value('cgBusyDefaults', {
            templateUrl: '/dist/js/templates/angular-busy.html'
        })
        // .config(tiny)

})();
