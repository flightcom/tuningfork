(function () {

    let instrument = {
        templateUrl: 'public/dist/html/components/instrument.html',
        controller: InstrumentController,
        controllerAs: '$instrumentCtrl',
        bindings: {
            item: '=instru',
            onChange: '&'
        }
    }

    // @ngInject
    function InstrumentController ($q, $rootScope, $state, Instrument, Utils, Toast) {

        var vm = this;

        vm.previous = Utils.previous;
        vm.bc = $rootScope.bc;

        vm.generateBarcode = () => {
            Instrument.barcode().then(response => {
                vm.item.barcode = response.data;
                vm.onChange();
            });
        };

    }

    angular.module('app')
        .component('instrument', instrument);

})();
