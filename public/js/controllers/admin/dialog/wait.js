(function () {

    // @ngInject
    function WaitCtrl($mdDialog, $rootScope){

        $rootScope.$on("endWait", function (event, args) {
            $mdDialog.cancel();
        });

    }

    angular
        .module('app')
        .controller('WaitCtrl', WaitCtrl);

})();
