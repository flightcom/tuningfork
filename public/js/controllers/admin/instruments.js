(function () {

    // @ngInject
    function AdminInstrumentsCtrl($mdDialog, Toast){

        this.filter = {
            show: false
        };

        this.showToast = () => {
            Toast.success('Oh yeah !?', 'ahah');
        }

        this.showCreateDialog = function(ev) {
            console.log('create');
            // Appending dialog to document.body to cover sidenav in docs app
            // Modal dialogs should fully cover application
            // to prevent interaction outside of dialog
            $mdDialog.show({
                controller: 'AdminInstrumentCreateCtrl',
                controllerAs: '$adminInstrumentCreateCtrl',
                templateUrl: '/public/dist/html/partials/admin/forms/instrument.html',
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
        .controller('AdminInstrumentsCtrl', AdminInstrumentsCtrl);

})();