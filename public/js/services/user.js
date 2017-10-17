(function () {

    // @ngInject
    function User($resource, $q, Loading, Storage) {
        var resource = $resource('/api/users/:id/:action', {id: '@id', action: '@action'}, {
          create: {method: 'POST'},
          update: {method: 'PUT'},
          search: {method: 'GET'},
          count : {method: 'GET'},
          signup: {method: 'POST', url: '/api/users/signup/'},
          signin: {method: 'POST', url: '/api/users/signin/'},
        });

        const format = response => {
          response.data.dateNaissance = response.data.dateNaissance ? new Date(response.data.dateNaissance) : null;
          return response;
        };

        return {
          query: function() {
            return resource.query().$promise;
          },
          get: function(id) {
            Loading.start();
            return resource.get({
              id: id
            }).$promise.then(response => {
              return format(response).data;
            }).finally( () => {
                Loading.stop();
            });
          },
          getCurrent: () => {
            if (Storage.get('user')) {
              var defer = $q.defer();
              defer.resolve(Storage.get('user'));
              return defer.promise;
            } else {
              return resource.get({action: 'current'}).$promise
              .then(response => {
                console.log('current', response);
                return format(response).data;
              });
            }
          },
          save: function(data) {
            return resource.create(data).$promise
              .then(response => {
                return format(response);
              });
          },
          update: function(data) {
            return resource.update({
                id: data.id
              }, data).$promise
              .then(response => {
                return format(response);
              });
          },
          search: function(data = null, callback = null) {
            data.action = 'search';
            return resource.search(data, callback).$promise;
          },
          signup: function(data) {
            return resource.signup(data).$promise;
          },
          count: function(data) {
            return resource.count(data).$promise;
          },
          prets: function(id) {
            return resource.get({
              id: id,
              action: 'prets'
            }).$promise;
          }
        };

    }

    angular
      .module('app')
      .factory('User', User);

})();
