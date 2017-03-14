(function () {

    let pretsList = {
        templateUrl: 'public/dist/html/components/prets-list.html',
        controller: PretsListController,
        controllerAs: '$pretsListCtrl',
        bindings: {
            items: "=?prets",
            instrument: "=?",
            user: "=?",
            create: "&?",
            embedded: '@?'
        }
    }

    // @ngInject
    function PretsListController ($q, $state, Pret, Utils, Toast) {

        var vm = this;

        vm.selected = [];
        vm.items = vm.items || [];

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
            order: 'dateDebut',
            limit: 10,
            page: 1
        };

        vm.getItems = () => {

            if (!vm.instrument && !vm.user) {
                vm.count = vm.items.length;
                return;
            }

            vm.selected = [];
            let promises = [];

            promises.push(Pret.search(vm.query));
            promises.push(Pret.count(vm.query));

            vm.promise = $q.all(promises).then(responses => {
                vm.items = responses[0].data;
                vm.count = responses[1].data;
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
            console.log('select', item);
        };

        vm.removeFilter = () => {
            vm.query.filter = {};
            vm.filter.show = false;
        };

        vm.view = pret => {
            $state.go('admin.prets.view', {
                id: pret.id,
                pret: pret
            });
        };

        // vm.$onChanges = changesObj => {
        //     console.log('changesObj', changesObj);
        //     vm.items = (changesObj.prets && changesObj.prets.currentValue != changesObj.prets.oldValue) ? changesObj.prets.currentValue : [];
        // }

        vm.getItems();

    }

    angular.module('app')
        .component('pretsList', pretsList);

})();
