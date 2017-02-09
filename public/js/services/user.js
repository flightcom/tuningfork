(function () {

    // @ngInject
    function User($resource, HTTPCreator) {
        var resource = $resource('/api/users/', {}, {
            signup: {method: 'POST', url: '/api/users/signup/'},
            signin: {method: 'POST', url: '/api/users/signin/'},
            search: {method: 'GET'}
        });

        return {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get(id).$promise;
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
            }
        };
    }

    angular
        .module('app')
        .factory('User', User)

})();

