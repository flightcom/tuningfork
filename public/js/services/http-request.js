(function () {

    // @ngInject
    function HTTPCreator($http, $q){
        return {
            createCustomGetRequest: function(route, params) {
                var defer = $q.defer();

                $http.get('/api/' + route, {params: params, cache: false}).success(function(res) {
                    defer.resolve(res);
                }).error(function(er) {
                    defer.reject(er);
                });

                return defer.promise;
            },
            createCustomPostRequest: function(route, data) {
                var defer = $q.defer();

                $http.post('/api/' + route, data).success(function(res) {
                    defer.resolve(res);
                }).error(function(er) {
                    defer.reject(er);
                });

                return defer.promise;
            },
            createCustomPutRequest: function(route, data) {
                var defer = $q.defer();

                $http.put('/api/' + route, data).success(function(res) {
                    defer.resolve(res);
                }).error(function(er) {
                    defer.reject(er);
                });

                return defer.promise;
            },
            createCustomGetRawRequest: function(route, params) {
                var defer = $q.defer();

                $http({
                    url:'/api/' + route,
                    method: 'GET',
                    responseType: 'arraybuffer',
                    params: params,
                    cache: false
                }).success(function(res) {
                    defer.resolve(res);
                }).error(function(er) {
                    defer.reject(er);
                });

                return defer.promise;
            }
        };
    }

    angular
        .module('app')
        .factory('HTTPCreator', HTTPCreator)

})();

