(function () {

    let pretsList = {
        templateUrl: 'public/dist/html/components/prets-list.html',
        controller: PretsListController,
        controllerAs: '$pretsListCtrl',
        bindings: {
            items: "<?prets",
            instrument: "<?",
            user: "<?",
            embedded: '@?'
        }
    };

    // @ngInject
    function PretsListController ($q, $state, Pret, Utils, Toast, TRANSLATE) {

        var vm = this;

        vm.TRANSLATE = TRANSLATE.PRET;

        vm.selected = [];
        vm.items = vm.items || [];
        vm.filter = {
            show: false,
            options: {}
        };

        vm.limitOptions = [10, 20, 50, {
            label: 'Tous',
            value: () => {
                return vm.items.length;
            }
        }];

        vm.query = {
            order: {dateDebut: 'asc'},
            limit: 10,
            page: 1,
            filters: {}
        };

        if (vm.user) {
            vm.query.filters.user = vm.user.id;
        } else if (vm.instrument) {
            vm.query.filters.instrument = vm.instrument.id;
        }

        vm.getItems = () => {
            vm.selected = [];
            console.log('Get items');
            Utils.loading(true);
            vm.promise = Pret.search(vm.query).then(response => {
                vm.count = response.count;
                vm.items = response.data;
            }).finally( () => {
                Utils.loading(false);
            });
        };

        vm.delete = () => {
            let promises = vm.selected.map(item => {
                return Pret.delete(item.id);
            });
            Utils.startWait();
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
                Utils.endWait();
            });
        };

        vm.select = (item) => {
            vm.selected.push(item);
        };

        vm.removeFilter = () => {
            delete vm.query.filters.search;
            vm.filter.show = false;
        };

        vm.view = pret => {
            $state.go('admin.prets.view', {
                id: pret.id,
                pret: pret
            });
        };

        if (!vm.items.length) {
            vm.getItems();
        }

    }

    angular.module('app')
        .component('pretsList', pretsList);

})();
