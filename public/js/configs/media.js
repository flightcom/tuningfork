(function () {

    // @ngInject
    function media($rootScope){

        var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        var breakpoints = {
            'handheld': 500,
            'extra-small': 768,
            'small': 992,
            'medium': 1200,
            'large': 1800
        };

        for (var key in breakpoints) {
            if (width < breakpoints[key]) {
                var media = key;
                break;
            }
        }            

        $rootScope.media = media;

    }

    angular.module('app')
        .run(media);

})();
