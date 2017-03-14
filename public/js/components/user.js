(function () {

    let user = {
        templateUrl: 'public/dist/html/components/user.html',
        controller: UserController,
        controllerAs: '$userCtrl',
        bindings: {
            id: '<id'
        }
    }

    // @ngInject
    function UserController ($q, User, Role, Ville, Utils, Toast) {

        var vm = this;

        vm.previous = Utils.previous;

        vm.onChange = () => {
            Utils.loading(true);
            User.update(vm.item)
            .then(response => {
                vm.item = response.data;
                Toast.success('Mise à jour réussie');
            }).catch(error => {
                Toast.error(error);
            }).finally( () => {
               Utils.loading(false);
            });
        }

        vm.load = () => {
            Utils.loading(true);
            let promises = [];

            promises.push(User.get(vm.id));
            promises.push(Role.query());

            $q.all(promises).then(responses => {
                vm.item = responses[0].data;
                vm.roles = responses[1].data;
                setRoles();
                Utils.loading(false);
                console.log(vm.item);
            });
        };

        // Ville
        const searchVille = query => {
            if (query.length < 3) return;
            console.log('search ville');
            // console.log('Looking for : ' + query, 'promise status', vm.searchVillePromise.$$state.status);
            return Ville.filter({nom: query}).then(response => {
                console.log(response);
                return response;
            });
        };

        vm.searchVille = _.throttle(searchVille, 500);

        const setRoles = () => {
            _.each(vm.roles, role => {
                role.selected = vm.hasRole(role);
            });
        }

        vm.hasRole = (role) => {
            return typeof _.findWhere(vm.item.roles, {name: role.name}) !== 'undefined';
        };

        vm.checkRoles = () => {
            vm.item.roles = _.filter(vm.roles, role => {
                return role.selected === true;
            });
            vm.onChange();
        };

        vm.selectedVilleChange = ville => {
            vm.item.adresse.ville = ville;
        };

        vm.load();

    }

    angular.module('app')
        .component('user', user);

})();
