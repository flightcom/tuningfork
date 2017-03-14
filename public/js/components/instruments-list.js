(function () {

    let instrumentsList = {
        templateUrl: 'public/dist/html/components/instruments-list.html',
        controller: InstrumentsListController,
        controllerAs: '$instrumentsListCtrl',
        bindings: {
            create: "&"
        }
    }

    // @ngInject
    function InstrumentsListController ($q, $state, Instrument, Utils, Toast) {

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
            order: 'model',
            limit: 10,
            page: 1
        };

        vm.getItems = () => {
            vm.selected = [];
            let promises = [];
            promises.push(Instrument.search(vm.query));
            promises.push(Instrument.count(vm.query));

            vm.promise = $q.all(promises).then(responses => {
                vm.items = responses[0].data;
                vm.count = responses[1].data;
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
            vm.query.filter = {};
            vm.filter.show = false;
        };

        vm.viewInstrument = instrument => {
            console.log('view', instrument);
            $state.go('admin.instruments.view', {
                id: instrument.id,
                instrument: instrument
            });
        };

        vm.getItems();

    }

    angular.module('app')
        .component('instrumentsList', instrumentsList);

})();
