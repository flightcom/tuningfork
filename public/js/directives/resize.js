(function() {

    // @ngInject
    function resize($window) {
        return {
            link: function (scope, element) {
                console.log('resize');
                var w = angular.element($window);
                scope.getWindowDimensions = function () {
                    return {
                        'h': w.height(),
                        'w': w.width()
                    };
                };
                scope.$watch(scope.getWindowDimensions, function (newValue, oldValue) {
                    scope.windowHeight = newValue.h;
                    scope.windowWidth = newValue.w;

                    scope.style = function () {
                        var menusHeight = $('[role=navigation]').map(function(index, element){ return $(this).outerHeight(); }).get().sum();
                        var menusWidth = $('#sidebar-left').map(function(index, element){ return $(this).outerWidth(); }).get().sum();
                        return {
                            'height': (newValue.h - menusHeight) + 'px',
                            'width': (newValue.w - menusWidth) + 'px'
                        };
                    };

                }, true);

                w.bind('resize', function () {
                    scope.$apply();
                });
            }
        }
    }

    angular.module('app')
        .directive('resize', resize);
})();
