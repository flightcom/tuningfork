(function () {

    let navMain = {
        templateUrl: 'public/dist/html/components/nav-main.html',
        controller: NavMainController,
        controllerAs: '$navMainCtrl'
    }

    // @ngInject
    function NavMainController (Authentication, PATHS) {

        this.PATHS = PATHS;

        Authentication.getUser().then(response => {
            this.user = response;
        });

    }


    angular.module('app')
        .component('navMain', navMain);

})();
