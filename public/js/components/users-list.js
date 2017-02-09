(function () {

    let usersList = {
        templateUrl: 'public/dist/html/components/users-list.html',
        controller: UsersListController,
        controllerAs: '$usersListCtrl'
    }

    // @ngInject
    function UsersListController (User) {

        this.selected = [];

        this.query = {
            order: 'nom',
            limit: 5,
            page: 1
        }

        this.promise = User.search(this.query).then(response => {
            this.items = response.data;
        });

        function success(response) {
            this.items = response.data;
        }

    }

    angular.module('app')
        .component('usersList', usersList);

})();
