(function () {

    // @ngInject
    function AdminInstrumentCreateCtrl($mdDialog, Instrument, Marque, Utils, Alert){

        var vm = this;

        vm.marques = null;

        vm.loadMarques = () => {
            return Marque.query().then(function(response){
                vm.marques = response.data;
            });
        }

        vm.closeDialog = function() {
            $mdDialog.hide();
        };

        vm.add = function() {
            console.log('Add instrument');
            console.log(vm.instrument);
            Utils.startWait();
            Instrument.save(this.instrument)
            .then(response => {
                console.log(response);
            }).catch(error => {
                Alert.error('Une erreur est survenue lors de l\'ajout de l\'instrument');
            }).finally(() => {
                Utils.endWait();
            });
        }

        vm.showMarqueCreateDialog = function(ev) {
            // Appending dialog to document.body to cover sidenav in docs app
            // Modal dialogs should fully cover application
            // to prevent interaction outside of dialog
            $mdDialog.show({
                controller: 'AdminMarqueCreateCtrl',
                controllerAs: '$adminMarqueCreateCtrl',
                templateUrl: '/public/dist/html/partials/admin/forms/marque.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                skipHide: true,
                clickOutsideToClose:true,
                fullscreen: this.customFullscreen // Only for -xs, -sm breakpoints.
            }).then(function(answer) {
              this.status = 'You said the information was "' + answer + '".';
            }, function() {
              this.status = 'You cancelled the dialog.';
            });

        }

    }

    angular
        .module('app')
        .controller('AdminInstrumentCreateCtrl', AdminInstrumentCreateCtrl);

})();
