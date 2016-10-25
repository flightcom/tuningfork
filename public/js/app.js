(function () {

    angular.module('app',
        [
            'ui.bootstrap',
            'ngTable',
            'ngResource',
            'ngTagsInput',
            'ngRoute',
            'angularFileUpload',
            'cgBusy',
            'ui.tinymce',
            'ui.sortable',
            'bootstrapLightbox',
            'osdForm',
            'ngSanitize',
            'angularUtils.directives.dirPagination',
            'ngFileSaver',
            'ngStorage',
            'ngMap',
            'ngParallax'
        ]);

    // @ngInject
    function tiny(){
        // Configure TinyMCE
        if (tinyMCE) {
            tinyMCE.baseURL = '/dist/js/vendor/tinymce';
        }
    }

    // @ngInject
    function lightbox(LightboxProvider){
        LightboxProvider.getImageUrl = function (image) {
            if (image.Proposal) {
                return '/files/proposals/' + image.Proposal + '/' + image.local_filename;
            }
            else if (image.Supplier) {
                return '/files/suppliers/' + image.Supplier + '/' + image.local_filename;
            }
        };

        LightboxProvider.getImageCaption = function (image) {
            return;
        };

        LightboxProvider.templateUrl = '/dist/js/templates/lightbox.html';
    }

    angular.module('app')
        .value('cgBusyDefaults', {
            templateUrl: '/dist/js/templates/angular-busy.html'
        })
        .config(tiny)
        .config(lightbox);

})();
