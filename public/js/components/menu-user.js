(function () {

    let menuUser = {
        templateUrl: 'public/dist/html/components/menu-user.html',
        controller: MenuUserController,
        controllerAs: '$menuUserCtrl'
    }

    // @ngInject
    function MenuUserController (Authentication, User) {

        Authentication.getUser().then(response => {
            // console.log('user ??', response);
            this.user = response;
        });

        this.$onChanges = function (changesObj) {
            if (changesObj.user) {
                console.log('User has changed in menu user', changesObj);
            }
        };

    }

    angular.module('app')
        .component('menuUser', menuUser);

})();
