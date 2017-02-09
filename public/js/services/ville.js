(function () {

    // @ngInject
    function Ville($resource, HTTPCreator) {
        var resource = $resource('/api/villes/:id', {id: '@id'}, {
            filter: {method: 'GET', url: '/api/villes/filter', isArray: true},
        });

        return {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get({id: id}).$promise;
            },
            filter: function(data) {
                return resource.filter(data).$promise;
            }
        };
    }

    angular
        .module('app')
        .factory('Ville', Ville)

})();

