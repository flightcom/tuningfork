(function () {

    // @ngInject
    function AdminInstrumentViewCtrl($q, $stateParams, $rootScope, Instrument, Toast){

        var vm = this;

        vm.id = $stateParams.id;

    }

    angular
        .module('app')
        .controller('AdminInstrumentViewCtrl', AdminInstrumentViewCtrl);

})();
