(function() {

  // @ngInject
  const logoutButton = (Authentication) => {
    return {
      link: function(scope, element, attributes) {

        const logout = () => {
          Authentication.logout().then(response => {
            window.location.href = '/';
          });
        };

        element.bind('click', logout);

      }
    };
  };

  angular.module('app')
    .directive('logoutButton', logoutButton);

})();
