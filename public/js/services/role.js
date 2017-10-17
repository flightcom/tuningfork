(function () {

    // @ngInject
    function Role($resource, HTTPCreator) {
        var resource = $resource('/api/roles/:id', {id: '@id'}, {
            query: {isArray: false}
        });

        return {
            query: function() {
                return resource.query().$promise;
            },
            get: function(id) {
                return resource.get({id: id}).$promise;
            }
        };
    }

    angular
        .module('app')
        .factory('Role', Role)

})();

