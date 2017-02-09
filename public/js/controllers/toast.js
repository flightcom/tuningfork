(function () {

    // @ngInject
    function ToastController ($mdToast, $mdDialog) {

        this.isDialogOpen = false;

        this.closeToast = function() {
            if (this.isDialogOpen) return;

            $mdToast
            .hide()
            .then(function() {
                this.isDialogOpen = false;
            });
        };

        this.openMoreInfo = function(e) {
            if ( this.isDialogOpen ) return;
            this.isDialogOpen = true;

            $mdDialog.show($mdDialog
                .alert()
                .title('Informations')
                .textContent(this.moreText)
                .ariaLabel('More info')
                .ok('OK')
                .targetEvent(e)
            ).then(function() {
                this.isDialogOpen = false;
            });
        };

    }

    angular
        .module('app')
        .controller('ToastCtrl', ToastController);

})();










