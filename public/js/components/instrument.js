(function () {

    let instrument = {
        templateUrl: 'public/dist/html/components/instrument.html',
        controller: InstrumentController,
        controllerAs: '$instrumentCtrl',
        bindings: {
            id: '<id'
        }
    }

    // @ngInject
    function InstrumentController ($q, $rootScope, $state, Instrument, Utils, Toast) {

        var vm = this;

        vm.isLoading = false;
        vm.previous = Utils.previous;
        vm.bc = $rootScope.bc;

        vm.onChange = () => {
            Instrument.update(vm.item)
            .then(response => {
                Toast.success('Mise à jour réussie');
            });
        }

        vm.generateBarcode = () => {
            Instrument.barcode().then(response => {
                vm.item.barcode = response.data;
                vm.onChange();
            });
        };

        vm.load = () => {
            vm.isLoading = true;
            promise = Instrument.get(vm.id).then(response => {
                vm.isLoading = false;
                vm.item = response.data;
            });
        }

        vm.load();

    }

    angular.module('app')
        .component('instrument', instrument);

})();
