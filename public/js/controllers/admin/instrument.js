(function () {

    // @ngInject
    function AdminInstrumentViewCtrl($stateParams, $rootScope, Instrument, Toast){

        var vm = this;

        vm.id = $stateParams.id;
        vm.instrument = $stateParams.instrument;

        if (!vm.instrument) {
            Instrument.get(vm.id).then(response => {
                vm.instrument = response.data;
            });
        }

        vm.update = () => {
            Instrument.update(vm.instrument)
            .then(response => {
                Toast.success('Mise à jour réussie');
            });
        }

    }

    angular
        .module('app')
        .controller('AdminInstrumentViewCtrl', AdminInstrumentViewCtrl);

})();
