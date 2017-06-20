(function () {

    let createMarque = {
        templateUrl: 'public/dist/html/components/create-marque.html',
        controller: createMarqueController,
        controllerAs: '$createMarqueCtrl'
    }

    // @ngInject
    function createMarqueController ($mdDialog, Toast, Utils, Marque) {

        var vm = this;

        vm.closeDialog = function() {
            console.log('CANCEL');
            $mdDialog.cancel();
        };

        vm.add = function() {
            Utils.startWait();
            Marque.save(vm.marque)
            .then(response => {
                $mdDialog.hide(response);
                Toast.success('Marque ajoutée');
            }).catch(error => {
                $mdDialog.cancel(error);
                Toast.error('Une erreur est survenue lors de l\'ajout de la marque ' + vm.marque.nom);
            }).finally(() => {
                Utils.endWait();
            });
        };

    }

    angular.module('app')
        .component('createMarque', createMarque);

})();
