(function () {

    let instrumentsListAdminView = {
        templateUrl: 'public/dist/html/components/instruments-list-admin-view.html',
        controller: InstrumentsListAdminViewController,
        controllerAs: '$instrumentsListAdminViewCtrl',
        bindings: {}
    };

    // @ngInject
    function InstrumentsListAdminViewController ($q, $state, $mdDialog, Instrument, Utils, Toast) {

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

        vm.params = {
            order: {model: 'asc'},
            limit: 10,
            page: 1,
            filters: {}
        };

        vm.getItems = () => {
            vm.selected = [];

            Utils.loading();
            vm.promise = Instrument.search(vm.params).then(response => {
                vm.count = response.count;
                vm.items = response.data;
                Utils.loading(false);
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

        vm.showCreateDialog = function(ev) {
            console.log('create');
            // Appending dialog to document.body to cover sidenav in docs app
            // Modal dialogs should fully cover application
            // to prevent interaction outside of dialog
            $mdDialog.show({
                controller: 'AdminInstrumentCreateCtrl',
                controllerAs: '$adminInstrumentCreateCtrl',
                templateUrl: '/public/dist/html/partials/admin/forms/instrument.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                skipHide: true,
                clickOutsideToClose:true,
                fullscreen: vm.customFullscreen // Only for -xs, -sm breakpoints.
            }).then(function(answer) {
              vm.status = 'You said the information was "' + answer + '".';
            }, function() {
              vm.status = 'You cancelled the dialog.';
            });

        };

        vm.getItems();

    }

    angular.module('app')
        .component('instrumentsListAdminView', instrumentsListAdminView);

})();
