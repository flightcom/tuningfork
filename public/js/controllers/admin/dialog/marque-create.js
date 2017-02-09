(function () {

    // @ngInject
    function AdminMarqueCreateCtrl($mdDialog, Marque, Utils, Alert){

        this.closeDialog = function() {
            $mdDialog.hide();
        };

        this.add = function() {
            Utils.startWait();
            Marque.save(this.marque)
            .then(response => {
                console.log('success', response);
            }).catch(error => {
                Alert.error('Une erreur est survenue lors de l\'ajout de la marque ' + this.marque.nom);
            }).finally(() => {
                Utils.endWait();
            });
        }

    }

    angular
        .module('app')
        .controller('AdminMarqueCreateCtrl', AdminMarqueCreateCtrl);

})();
