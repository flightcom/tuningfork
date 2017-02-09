(function () {

    // @ngInject
    function Marque($resource, HTTPCreator) {
        var resource = $resource('/api/marques/:id', {id: '@id'}, {
            query: { isArray: false },
            update: {method: 'PUT'}
        });

        return {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get({id: id}).$promise;
            },
            save: function(data) {
                return resource.save(data).$promise;
            },
            update: function(data) {
                return resource.update(data).$promise;
            },
            delete: function(id) {
                return resource.$delete({id: id}).$promise;
            },
        };
    }

    angular
        .module('app')
        .factory('Marque', Marque)

})();

