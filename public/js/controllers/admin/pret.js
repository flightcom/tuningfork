(function () {

    // @ngInject
    function AdminPretViewCtrl($q, $stateParams, $rootScope, Pret, Toast){

        var vm = this;

        vm.id = $stateParams.id;


    }

    angular
        .module('app')
        .controller('AdminPretViewCtrl', AdminPretViewCtrl);

})();
