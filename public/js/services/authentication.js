(function () {

    // @ngInject
    function Authentication($resource, $q, $http, Storage, User) {

        var resource = $resource('/api/authentication/:action', {action: '@action'}, {
            login: {method: 'POST', url: '/api/authentication/login/'},
            logout: {method: 'POST', url: '/api/authentication/logout/'},
        });

        let AuthenticationService = {};

        AuthenticationService.login = data => {
          return resource.login(data).$promise.then(response => {
            Storage.set('user', response.user);
            Storage.set('token', response.token);
            // Put token in HTTP headers so it is sent with every request
            $http.defaults.headers.common.Authorization = 'Bearer ' + response.token;
          });
        };

        AuthenticationService.logout = () => {
          console.log('logout');
          return resource.logout().$promise.then(response => {
            console.log('deleting local storage');
            Storage.delete('user');
            Storage.delete('token');
          });
        };

        AuthenticationService.check = () => {
          if (token = Storage.get('token')) {
            let defer = $q.defer();
            defer.resolve(token);
            return defer.promise;
          } else {
            return resource.get({action: 'check'}).$promise.then(response => {
                return response.data;
            });
          }
        };

        AuthenticationService.getUser = () => {
          return User.get();
        };

        AuthenticationService.getToken = () => {
          return AuthenticationService.check().then(response => {
            return response;
          });
        };

        AuthenticationService.allowed = () => {
          return resource.get({action: 'allowed'}).$promise.then(response => {
            return $q.resolve("Authorized");
          }).catch(error => {
            Storage.delete('user');
            Storage.delete('token');
            return $q.reject("Not Authorized");
          });
        };

        return AuthenticationService;
    }

    angular
        .module('app')
        .factory('Authentication', Authentication);

})();
