(function () {

    // @ngInject
    function ToastController ($mdToast, $mdDialog) {

        this.isDialogOpen = false;

        this.openMoreInfo = function(e, text) {
            if ( this.isDialogOpen ) return;
            this.isDialogOpen = true;

            $mdDialog.show($mdDialog
                .alert()
                .title('Informations')
                .textContent(text)
                .ariaLabel('More info')
                .ok('OK')
                .targetEvent(e)
            ).then(function() {
                $mdToast
                .hide()
                .then(function() {
                    this.isDialogOpen = false;
                });
            });
        };

        this.close = () => {
            if ( this.isDialogOpen ) return;
            $mdToast
            .hide()
            .then(function() {
                this.isDialogOpen = false;
            });
        };

    }

    angular
        .module('app')
        .controller('ToastCtrl', ToastController);

})();










