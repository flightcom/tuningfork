(function () {

    // @ngInject
    function Toast($rootScope, $mdToast, PATHS) {

        var toastService = {};

        var config = {
            hideDelay   : 0,
            bindToController: true,
            position    : 'top right',
            controller  : 'ToastCtrl',
            controllerAs: '$toastCtrl',
            templateUrl : PATHS.TEMPLATE + 'toast.html'
        };

        toastService.success = (message, details, action) => {

            let customConfig = {
                hideDelay : 3000,
                locals: {
                    message   : message,
                    details   : details,
                    theme     : 'success',
                    showClose : false
                }
            };

            $mdToast.show(Object.assign(config, customConfig));
        };

        toastService.info = (message, details, action) => {

            config.locals = {
                message : message,
                details : details,
                theme   : 'blue'
            };

            $mdToast.show(config);
        };

        toastService.error = function(message, details) {

            let customConfig = {
                locals: {
                    message : message,
                    details : details,
                    theme   : 'error'
                }
            };

            $mdToast.show(Object.assign(config, customConfig));
        };

        return toastService;
    }

    angular
        .module('app')
        .service('Toast', Toast);

})();
