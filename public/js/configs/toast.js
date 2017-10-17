(function () {

    // @ngInject
    function toastConfig($mdToastProvider, PATHS){

        var config = {
            hideDelay   : 0,
            bindToController: true,
            position    : 'top right',
            controller  : 'ToastCtrl',
            controllerAs: '$toastCtrl',
            templateUrl : PATHS.TEMPLATE + 'toast.html'
        };

        $mdToastProvider.addPreset('standardPreset', {
            options: function() {

                let extendedConfig = {
                    hideDelay : 3000
                }
                return Object.assign(config, extendedConfig);
            }
        });

    }

    angular.module('app')
        .config(toastConfig);

})();
