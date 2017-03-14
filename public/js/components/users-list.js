(function () {

    let usersList = {
        templateUrl: 'public/dist/html/components/users-list.html',
        controller: UsersListController,
        controllerAs: '$usersListCtrl',
        bindings: {
            create: "&"
        }
    }

    // @ngInject
    function UsersListController ($q, $state, Utils, User, Toast) {

        var vm = this;

        vm.selected = [];
        vm.items = [];

        vm.limitOptions = [10, 20, 50, {
            label: 'Tous',
            value: () => {
                return vm.items.length;
            }
        }];

        vm.filter = {
            options: {},
            show: false
        };
        vm.query = {
            order: 'nom',
            limit: 10,
            page: 1
        };

        vm.getItems = () => {
            Utils.loading(true);
            vm.selected = [];
            let promises = [];
            promises.push(User.search(vm.query));
            promises.push(User.count(vm.query));

            vm.promise = $q.all(promises)
            .then(responses => {
                vm.items = responses[0].data;
                vm.count = responses[1].data;
            })
            .then( () => {
                Utils.loading(false);
            });
        };

        vm.delete = () => {
            let promises = vm.selected.map(item => {
                return Instrument.delete(item.id);
            });
            Utils.loading(true);
            // Utils.startWait();
            $q.all(promises).then(responses => {
                vm.getItems();
                Toast.success(responses.length+ ' éléments supprimés');
            }).catch(responses => {
                let message = _.reduce(responses, (memo, response) => {
                    return memo + '<br>' + response.error;
                }, '');
                Toast.success(message);
                vm.getItems();
            }).finally(() => {
                // Utils.endWait();
                Utils.loading(false);
            });
        };

        vm.select = (item) => {
            vm.selected.push(item);
            console.log('select', item);
        };

        vm.removeFilter = () => {
            vm.query.filter = {};
            vm.filter.show = false;
        };

        vm.view = user => {
            console.log('view', user);
            $state.go('admin.users.view', {
                id: user.id,
                user: user
            });
        };

        vm.getItems();

    }

    angular.module('app')
        .component('usersList', usersList);

})();
