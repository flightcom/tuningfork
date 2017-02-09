(function () {

    // @ngInject
    function Utils($rootScope, $state, $mdDialog, $mdToast, PATHS) {

        function endWait(){
            $rootScope.$emit("endWait");
        }

        function startWait(){
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
            console.log('previous', $rootScope.from);
            $state.go(!$rootScope.from.abstract ? $rootScope.from : $state.$current.parent);
        }

        return {
            previous : previous,
            startWait : startWait,
            endWait   : endWait
        }

    }

    angular
        .module('app')
        .service('Utils', Utils)

})();

