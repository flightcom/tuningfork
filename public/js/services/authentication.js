(function () {

    // @ngInject
    function Authentication($resource, HTTPCreator, $q, $sessionStorage) {
        var resource = $resource('/api/authentication/', {}, {
            check: {url: '/api/authentication/check/'},
            login: {method: 'POST', url: '/api/authentication/login/'},
            logout: {method: 'POST', url: '/api/authentication/logout/'},
        });

        return {
            login: function(data) {
                return resource.login(data).$promise;
            },
            logout: function(data) {
                return resource.logout().$promise;
            },
            check: function() {
                if ($sessionStorage.user) {
                    let defer = $q.defer();
                    defer.resolve($sessionStorage.user);
                    return defer.promise;
                } else {
                    return resource.check().$promise.then(response => {
                        return response.data;
                    });
                }
            },
            getUser : function() {
                return this.check().then(response => {
                    return response;
                });
            }
        };
    }

    angular
        .module('app')
        .factory('Authentication', Authentication)

})();

