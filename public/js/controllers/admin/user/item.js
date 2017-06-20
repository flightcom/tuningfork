(function () {

    // @ngInject
    function AdminUserViewCtrl($q, $stateParams, $rootScope, User, Role, Utils, Toast){

        var vm = this;

        vm.id = $stateParams.id;

        vm.load = () => {
            Utils.loading(true);
            let promises = [];

            promises.push(User.get(vm.id));
            promises.push(Role.query());

            $q.all(promises).then(responses => {
                vm.item = responses[0].data;
                vm.roles = responses[1].data;
                setRoles();
                Utils.loading(false);
                console.log(vm.item);
            });
        };

        const setRoles = () => {
            _.each(vm.roles, role => {
                role.selected = vm.hasRole(role);
            });
        };

        vm.hasRole = (role) => {
            return typeof _.findWhere(vm.item.roles, {name: role.name}) !== 'undefined';
        };

        vm.checkRoles = () => {
            vm.item.roles = _.filter(vm.roles, role => {
                return role.selected === true;
            });
            vm.onChange();
        };

        vm.load();

    }

    angular
        .module('app')
        .controller('AdminUserViewCtrl', AdminUserViewCtrl);

})();
