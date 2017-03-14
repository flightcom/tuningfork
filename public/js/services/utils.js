(function () {

    // @ngInject
    function Utils($rootScope, $location, $mdDialog, $mdToast, PATHS) {

        function endWait () {
            $rootScope.$emit("endWait");
        }

        function startWait () {
            $mdDialog.show({
                controller: 'WaitCtrl',
                template: '<md-dialog id="plz_wait" style="background-color:transparent;box-shadow:none">' +
                    '<div layout="row" layout-sm="column" layout-align="center center" aria-label="wait">' +
                    '<md-progress-circular md-mode="indeterminate" ></md-progress-circular>' +
                    '</div>' +
                    '</md-dialog>',
                parent: angular.element(document.body),
                clickOutsideToClose:false,
                fullscreen: false
            });
        }

        function previous () {
            if (prev = $rootScope.history[$rootScope.history.length-1]) {
                window.location.href = prev;

            }
        }

        function loading (loading = false) {
            $rootScope.loading = loading;
        }

        return {
            previous  : previous,
            startWait : startWait,
            endWait   : endWait,
            loading   : loading,
        }

    }

    angular
        .module('app')
        .service('Utils', Utils)

})();

