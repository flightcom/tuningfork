(function () {

    // @ngInject
    function User($resource, HTTPCreator) {
        var resource = $resource('/api/users/:id/:action', {id: '@id', action: '@action'}, {
            update: {method: 'PUT'},
            search: {method: 'GET'},
            count : {method: 'GET'},
            signup: {method: 'POST', url: '/api/users/signup/'},
            signin: {method: 'POST', url: '/api/users/signin/'},
        });

        return {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get({id: id}).$promise
                .then(response => {
                    return this.format(response);
                });
            },
            update: function(data) {
                return resource.update({id: data.id}, data).$promise
                .then(response => {
                    return this.format(response);
                });
            },
            search: function(data = null, callback = null) {
                data.action = 'search';
                return resource.search(data, callback).$promise;
            },
            signup: function(data) {
                return resource.signup(data).$promise;
            },
            signin: function(data) {
                return resource.signin(data).$promise;
            },
            count: function(data) {
                return resource.count(data).$promise;
            },
            prets: function (id) {
                return resource.get({id: id, action: 'prets'}).$promise;
            },
            format: function(response) {
                response.data.dateNaissance = response.data.dateNaissance ? new Date(response.data.dateNaissance) : null;
                return response;
            }
        };
    }

    angular
        .module('app')
        .factory('User', User)

})();

