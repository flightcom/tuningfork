(function () {

    // @ngInject
    function AdminPretCreateCtrl($mdDialog, Pret, Utils, Toast){

        var vm = this;

        vm.closeDialog = function() {
            $mdDialog.hide();
        };

        vm.add = function() {
            console.log('Add pret');
            console.log(vm.pret);
            Utils.startWait();
            Pret.save(vm.pret)
            .then(response => {
                console.log(response);
            }).catch(error => {
                Toast.error('Une erreur est survenue lors de l\'ajout de l\'instrument');
            }).finally(() => {
                Utils.endWait();
            });
        }

    }

    angular
        .module('app')
        .controller('AdminPretCreateCtrl', AdminPretCreateCtrl);

})();
