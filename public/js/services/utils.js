(function () {

    // @ngInject
    function Utils($rootScope, $location, $mdDialog, $mdToast, PATHS) {

        const endWait = () => {
            wait(false);
        };

        const startWait = () => {
            wait(true);
        };

        const wait = (start = true) => {
            if (!start) {
                $rootScope.$emit("endWait");
                return;
            }

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
        };

        const previous = () => {
            if (prev = $rootScope.history[$rootScope.history.length-1]) {
                window.location.href = prev;

            }
        };

        const loading = (loading = true) => {
            $rootScope.loading = loading;
        };

        return {
            previous  : previous,
            startWait : startWait,
            endWait   : endWait,
            wait      : wait,
            loading   : loading
        };

    }

    angular
        .module('app')
        .service('Utils', Utils);

})();
