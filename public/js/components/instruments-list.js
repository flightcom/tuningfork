(function () {

    let instrumentsList = {
        templateUrl: 'public/dist/html/components/instruments-list.html',
        controller: InstrumentsListController,
        controllerAs: '$instrumentsListCtrl',
        bindings: {
            items: "<",
            onSelect: "&?"
        }
    };

    // @ngInject
    function InstrumentsListController ($attrs, $q, $state, $mdDialog, Instrument, Utils, Toast) {

        var vm = this;

        vm.selected = [];
        vm.embedded = 'embedded' in $attrs;
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
            order: {model: 'asc'},
            limit: 10,
            page: 1,
            filters: {}
        };

        vm.getItems = () => {
            vm.selected = [];

            // Utils.loading();
            vm.promise = Instrument.search(vm.params).then(response => {
                vm.count = response.count;
                vm.items = response.data;
                // Utils.loading(false);
            });
        };

        vm.delete = () => {
            let promises = vm.selected.map(item => {
                return Instrument.delete(item.id);
            });
            Utils.loading();
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
                Utils.loading(false);
            });
        };

        vm.select = (item) => {
            vm.selected.push(item);
            console.log('select', item);
        };

        vm.removeFilter = () => {
            vm.params.filtes = {};
            vm.filter.show = false;
        };

        vm.selectItem = instrument => {
            if (vm.onSelect) {
                vm.onSelect({instrument: instrument});
            } else {
                $state.go("admin.instruments.view", {id: instrument.id, instrument: instrument});
            }
        };

        vm.getItems();
    }

    angular.module('app')
        .component('instrumentsList', instrumentsList);

})();
