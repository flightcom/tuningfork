(function () {

    // @ngInject
    function AdminUserViewCtrl($q, $stateParams, $rootScope, User, Toast){

        var vm = this;

        vm.id = $stateParams.id;

    }

    angular
        .module('app')
        .controller('AdminUserViewCtrl', AdminUserViewCtrl);

})();
