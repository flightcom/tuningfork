(() => {

    let userForm = {
        templateUrl: 'public/dist/html/components/user-form.html',
        controller: UserController,
        controllerAs: '$userCtrl',
        bindings: {
            id: '<?id',
            item: '<?user',
            pays: '<?pays'
        }
    };

    // @ngInject
    function UserController ($scope, $q, $timeout, User, Role, Ville, Pays, Utils, Toast, Form) {

        var vm = this;

        console.log(vm.item);

        vm.formService = Form;

        // Ville
        const searchVille = query => {
            if (query.length < 3) return;
            console.log('search ville');
            return Ville.filter({nom: query}).then(response => {
                return response;
            });
        };

        vm.searchVille = _.throttle(searchVille, 500);

        vm.selectedVilleChange = ville => {
            if (typeof vm.item.adresse == 'undefined')
                vm.item.adresse = {};
            vm.item.adresse.ville = ville;
            vm.onChange();
        };

        vm.init = () => {
            Pays.query().then(response => {
                vm.pays = response.data;
            });
        };

        // Be careful : form is undefined without using the timeout
        $timeout(() => {
            vm.formService.set(vm.userForm, $scope);
        });

        vm.$onChanges = changesObj => {
            if (typeof vm.userForm == 'undefined') return;
            vm.userForm.$setPristine();
            vm.formService.set(vm.userForm, $scope);
        };

        vm.onChange = () => {
            vm.formService.set(vm.userForm, $scope);
        };

        // INIT
        vm.init();

    }

    angular.module('app')
        .component('userForm', userForm);

})();
