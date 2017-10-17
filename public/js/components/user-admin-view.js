(function() {

  let userAdminView = {
    templateUrl: 'public/dist/html/components/user-admin-view.html',
    controller: UserAdminViewController,
    controllerAs: '$userAdminViewCtrl',
    bindings: {
      item: '<'
    }
  };

  // @ngInject
  function UserAdminViewController($scope, $q, $rootScope, User, Role, Utils, Toast, Form) {

    var vm = this;
    vm.formService = Form;
    vm.hasChanged = false;
    vm.item = vm.item || {id: null};

    $scope.$on('formUpdated', (event, data) => {
      vm.formUser = data.form;
      vm.hasChanged = vm.formUser.$valid && (vm.hasChanged || vm.formUser.$dirty);
    });

    vm.init = () => {
      Role.query().then(response => {
        vm.roles = response.data;
        setRoles();
      });
    };

    const setRoles = () => {
      _.each(vm.roles, role => {
        role.selected = vm.item.id ? vm.hasRole(role) : false;
      });
    };

    vm.hasRole = (role) => {
      return typeof _.findWhere(vm.item.roles, {
        name: role.name
      }) !== 'undefined';
    };

    vm.checkRoles = () => {
      vm.hasChanged = true;
      vm.item.roles = _.filter(vm.roles, role => {
        return role.selected === true;
      });
    };

    vm.save = () => {
      Utils.loading(true);
      let promise = null;
      if (vm.item.id)
        promise = User.update(vm.item);
      else
        promise = User.save(vm.item);

      promise.then(response => {
        vm.item = response.data;
        Toast.success('Mise à jour réussie');
        vm.hasChanged = false;
      }).catch(error => {
        Toast.error(error);
      }).finally(() => {
        Utils.loading(false);
      });
    };

    vm.init();

  }

  angular.module('app')
    .component('userAdminView', userAdminView);

})();
