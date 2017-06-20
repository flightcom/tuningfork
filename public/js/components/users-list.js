(function () {

    let usersList = {
        templateUrl: 'public/dist/html/components/users-list.html',
        controller: UsersListController,
        controllerAs: '$usersListCtrl',
        bindings: {
            onSelect: "&?"
        }
    };

    // @ngInject
    function UsersListController ($attrs, $q, $state, Utils, User, Toast) {

        var vm = this;

        vm.embedded = 'embedded' in $attrs;

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
        vm.params = {
            order: {'nom': 'asc'},
            limit: 10,
            page: 1,
            filters: {}
        };

        vm.getItems = () => {
            vm.selected = [];
            vm.promise = User.search(vm.params).then(response => {
                vm.count = response.count;
                vm.items = response.data;
            });
        };

        vm.delete = () => {
            let promises = vm.selected.map(item => {
                return Instrument.delete(item.id);
            });
            $q.all(promises).then(responses => {
                vm.getItems();
                Toast.success(responses.length+ ' éléments supprimés');
            }).catch(responses => {
                let message = _.reduce(responses, (memo, response) => {
                    return memo + '<br>' + response.error;
                }, '');
                Toast.success(message);
                vm.getItems();
            });
        };

        vm.select = (item) => {
            vm.selected.push(item);
        };

        vm.resetFilters = () => {
            vm.query.filter = {};
            vm.filter.show = false;
        };

        vm.selectItem = user => {
            if (vm.onSelect) {
                vm.onSelect({user: user});
            } else {
                $state.go("admin.users.view", {id: user.id, user: user});
            }
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
