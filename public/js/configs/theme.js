(function () {

    // @ngInject
    function theme($mdThemingProvider){

        var customBlueMap = $mdThemingProvider.extendPalette('blue', {
            'contrastDefaultColor': 'light',
            'contrastDarkColors': ['50'],
            '50': 'ffffff'
        });

        $mdThemingProvider.definePalette('customBlue', customBlueMap);

        $mdThemingProvider.theme('default')
            .primaryPalette('customBlue', {
                'hue-1': 'A200',
                'hue-2': '50'
            })
            .accentPalette('red', {
                default: '400'
            })
            .backgroundPalette('grey', {
                default: '100'
            });

        $mdThemingProvider.theme('success')
            .primaryPalette('green');

        $mdThemingProvider.theme('error')
            .primaryPalette('red', {
                default: '900'
            });

        $mdThemingProvider.theme('sidenav')
            .primaryPalette('grey', {
                default: '300'
            });

        $mdThemingProvider.theme('input', 'default')
            .primaryPalette('grey');

        $mdThemingProvider.alwaysWatchTheme(true);
    }

    angular.module('app')
        .config(theme);

})();
