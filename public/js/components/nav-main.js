(function() {

  let navMain = {
    templateUrl: 'public/dist/html/components/nav-main.html',
    controller: NavMainController,
    controllerAs: '$navMainCtrl'
  };

  // @ngInject
  function NavMainController(Authentication, User, PATHS) {

    var vm = this;

    vm.PATHS = PATHS;

    User.getCurrent().then(response => {
      console.log(response);
      vm.user = response;
    });

    vm.logout = () => {
      console.log('Logout');
      Authentication.logout().then(response => {
        console.log(response);
        window.location.href = '/';
      });
    };

  }

  angular.module('app')
    .component('navMain', navMain);

})();
