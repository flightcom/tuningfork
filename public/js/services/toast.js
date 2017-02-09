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

        toastService.success = (text, moreText, action) => {

            let customConfig = {
                hideDelay : 3000,
                // toastClass: 'toast-success',
                locals: {
                    text     : text,
                    moreText : moreText,
                }
            }

            $mdToast.show(Object.assign(config, customConfig));
        }

        toastService.info = (text, moreText, action) => {

            config.locals = {
                text     : text,
                moreText : moreText,
                theme: 'blue'
            };

            $mdToast.show(config);
        }

        toastService.error = function(message) {
            emitToast({
                show: true,
                msg: message,
                class: 'toast-danger'
            });
        };

        return toastService;
    }

    angular
        .module('app')
        .service('Toast', Toast)

})();
