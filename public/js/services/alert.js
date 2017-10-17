(function () {

    // @ngInject
    function Alert($rootScope) {
        var alertService = {};

        function emitAlert(alert, cb) {
            $rootScope.$emit('alert', alert, cb);
        }

        alertService.success = function(msg, cb) {
            emitAlert({
                show: true,
                title: 'Succès !',
                msg: msg,
                class: 'alert-success'
            }, cb);
        };

        alertService.saved = function(type) {
            emitAlert({
                show: true,
                title: 'Succès !',
                msg: 'Your ' + type + ' has been saved!',
                class: 'alert-success'
            });
        };

        alertService.updated = function(type, plural) {
            var message = plural ? 'Your ' + type + ' have been updated!' : 'Your ' + type + ' has been updated!';
            emitAlert({
                show: true,
                title: 'Succès !',
                msg: message,
                class: 'alert-success'
            });
        };

        alertService.removed = function(type) {
            emitAlert({
                show: true,
                title: 'Succès !',
                msg: 'Your ' + type + ' has been removed.',
                class: 'alert-success'
            });
        };

        alertService.error = function(message) {
            emitAlert({
                show: true,
                msg: message,
                class: 'alert-danger'
            });
        };

        alertService.generalError = function() {
            emitAlert({
                show: true,
                msg: 'Unfortunately we could not process your request.  Please try again later.',
                class: 'alert-danger'
            });
        };

        return alertService;
    }

    angular
        .module('app')
        .service('Alert', Alert)

})();

